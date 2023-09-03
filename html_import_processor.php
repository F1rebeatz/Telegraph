<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML Import Processor</title>
</head>

<body>
    <h1>HTML Import Processor</h1>
    <form method="post" action="html_import_processor.php">
        <label for="url">URL:</label>
        <input type="text" name="url" id="url" placeholder="URL"><br>
        <button type="submit">Import</button>
    </form>
</body>

</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url = $_POST['url'];

    if (empty($url)) {
        http_response_code(400);
        exit();
    }

    $links = getLinks($url);
    $result = sendRequest("http://localhost/module_18/HtmlProcessor.php", $links);

    if ($result === false) {
        $error = curl_error($ch);
        echo '<h2>CURL Error:</h2>';
        echo '<p>' . $error . '</p>';
        exit();
    }

    $responseData = json_decode($result, true);

    if (isset($responseData['formatted_text'])) {
        $formattedText = $responseData['formatted_text'];
        $formattedText = explode(" ", $formattedText);
        echo '<h2>Formatted Text:</h2>';
        echo '<ul>';
        foreach ($formattedText as $link) {
            echo '<li>' . $link . '</li>';
        }
        echo '</ul>';
    } else {
        echo '<h2>Error:</h2>';
        echo '<p>' . $responseData['message'] . '</p>';
    }
}

/**
 * @param string 
 * @return array
 */
function getLinks(string $url): array
{
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        http_response_code(400);
        exit();
    }

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $html = curl_exec($ch);
    curl_close($ch);

    $links = [];

    if ($html !== false) {
        $dom = new DOMDocument();
        @$dom->loadHTML($html);

        $anchorTags = $dom->getElementsByTagName('a');

        foreach ($anchorTags as $tag) {
            $link = $tag->getAttribute('href');
            if (!empty($link)) {
                $links[] = $link;
            }
        }
    }

    return $links;
}
/**
 * @param string 
 * @param array 
 * @throws
 * @return string 
 */
function sendRequest(string $url, array $links): string
{
    $requestData = ['html' => implode(" ", $links)];
    $json = json_encode($requestData, JSON_UNESCAPED_UNICODE);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}

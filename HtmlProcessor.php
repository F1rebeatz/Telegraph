<?php
$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestMethod === 'POST') {
    $requestData = json_decode(file_get_contents('php://input'), true);

    if (isset($requestData['html'])) {
        $html = $requestData['html'];
        if (!empty($html)) {
            $formattedText = processText($html);

            $response = ["formatted_text" => $formattedText];

            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            http_response_code(200);
            header('Content-Type: application/json');
            exit();
        } else {
            http_response_code(500);
            exit();
        }
    }
}

/**
 * @param string 
 * @return string
 */
function processText(string $html): string
{
    $pattern = '/\bhttps?:\/\/\S+\b/i';
    preg_match_all($pattern, $html, $matches);

    $links = $matches[0];
    $links = array_unique($links);

    return implode(" ", $links);
}

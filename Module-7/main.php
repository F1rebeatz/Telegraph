<?php

$searchRoot = "./test_search";;
$searchName = "test.txt";
$searchResult = [];


/**
 * @param string $directory
 * @param string $searchName
 * @param array $searchResult
 * @return void
 */
function search(string $directory, string $searchName, array &$searchResult): void
{
    $files = scandir($directory);

    foreach ($files as $file) {
        if (in_array($file, ['.', '..'])) {
            continue;
        }

        $filePath = $directory . '/' . $file;

        if (is_dir($filePath)) {
            search($filePath, $searchName, $searchResult);
        } elseif ($file == $searchName) {
            $searchResult[] = $filePath;
        }
    }
}
search($searchRoot, $searchName, $searchResult);

print_r($searchResult) . PHP_EOL;
// Фильтрация результатов по размеру файла
$searchResult = array_filter($searchResult, function (string $filePath) {
    return filesize($filePath) > 0;
});

if (empty($searchResult)) {
    echo "Поиск не дал результатов";
} else {
    echo "Результаты:\n" . PHP_EOL;
    foreach ($searchResult as $result) {
        echo $result . "\n" . PHP_EOL;
    }
}

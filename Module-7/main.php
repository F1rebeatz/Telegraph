<?php

$searchRoot = "./test_search";;
$searchName = "test.txt";
$searchResult = [];

function search($dir, $searchName, &$searchResult)
{
    $files = scandir($dir);

    foreach ($files as $file) {
        if ($file == '.' || $file == '..') {
            continue;
        }

        $filePath = $dir . '/' . $file;

        if (is_dir($filePath)) {
            search($filePath, $searchName, $searchResult);
        } else {
            if ($file == $searchName) {
                $searchResult[] = $filePath;
            }
        }
    }
}
search($searchRoot, $searchName, $searchResult);

print_r($searchResult) . PHP_EOL;
// Фильтрация результатов по размеру файла
$searchResult = array_filter($searchResult, function ($filePath) {
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

<?php


$textStorage = [];


function addText(array &$textStorage,  string $title,  string $text)
{

    $textStorage[] = [
        'title' => $title,
        'text' => $text
    ];
};


addText($textStorage, "Заголовок первого текста", "Текст первого текста");
addText($textStorage, "Заголовок второго текста", "Текст второго текста");


print_r($textStorage);


function remove(int $index, array &$textStorage)
{
    if (array_key_exists($index, $textStorage)) {
        unset($textStorage[$index]);
        return true;
    } else {
        return false;
    }
};
print_r(remove(0, $textStorage));
print_r(remove(5, $textStorage));

print_r($textStorage);


function edit(int $index, string $title, string $text, array &$textStorage): bool
{
    if (array_key_exists($index, $textStorage)) {
        $textStorage[$index]['title'] = $title;
        $textStorage[$index]['text'] = $text;
        return true;
    } else {
        return false;
    }
}

edit(1, 'Новый заголовок 2', 'Новый текст 2', $textStorage);
print_r($textStorage);

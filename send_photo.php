<html>

<head>
    <title>Upload</title>
</head>

<body>
    <h1>Upload</h1>

    <form method="post" action="send_photo.php" enctype="multipart/form-data">
        <input type="file" name="file" accept="image/jpeg, image/png" required />
        <input type="submit" />
    </form>
</body>

</html>

<?php
session_start();

if (isset($_SESSION['uploaded'])) {
    echo "You have already uploaded a photo";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['file'];

    $allowedExtensions = ['jpg', 'png'];
    $fileName = $file['name'];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if (!in_array($fileExtension, $allowedExtensions)) {
        echo "Invalid file type";
        exit;
    }

    $maxFileSize = 2 * 1024 * 1024;
    if ($file['size'] > $maxFileSize) {
        echo "File too large";
        exit;
    }

    $uploadDir = "images/";
    $uploadPath = $uploadDir . $file['name'];

    try {
        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            if (!isset($_SESSION['uploadCount'])) {
                $_SESSION['uploadCount'] = 0;
            };
            $_SESSION['uploadCount']++;

            $_SESSION['uploaded'] = true;

            echo "Файл успешно загружен.";

            header('Location: ' . $uploadPath);
            exit;
        } else {
            echo "Ошибка при загрузке файла.";
        }
    } catch (Exception $e) {
        echo "Ошибка при перемещении файла";
        exit;
    }
} else {
    echo "Ошибка при загрузке файла.";
}


?>

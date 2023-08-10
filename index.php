<?php
define('APP_ENTRY_POINT', true);
header('Content-Type: text/html; charset=UTF-8');
require_once 'User.php';
$config = require_once 'configDB.php';
$user = new User($config['host'], $config['db'], $config['dbuser'], $config['pass']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'create') {
        $age = filter_var($_POST['age'], FILTER_VALIDATE_INT);
        if ($age === false) {
            exit();
        }
        $newDataUser = [
            'email' => $_POST['email'],
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'age' => $_POST['age'],
            'date_created' => date('Y-m-d H:i:s'),
        ];
        $user->create($newDataUser);
    }
}

if (isset($_GET['action']) && $_GET['action'] === 'edit') {
    if (isset($_POST['id']) && isset($_POST['action']) && $_POST['action'] === 'update') {
        $age = filter_var($_POST['age'], FILTER_VALIDATE_INT);
        if ($age === false) {
            exit();
        }
        $updatedUser = [
            'email' => $_POST['email'],
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'age' => $_POST['age'],
            'date_created' => date('Y-m-d H:i:s'),
        ];
        $user->update($_POST['id'], $updatedUser);
    }
}

if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    if (isset($_GET['id'])) {
        $user->delete($_GET['id']);
    }
}

$userList = $user->list();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
</head>
<body>
<h1>User Management</h1>
<table>
    <tr>
        <th>Email</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Age</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($userList as $userData): ?>
        <form action="index.php?action=edit" method="post">
            <tr>
                <td><input type="hidden" name="id" value="<?= htmlspecialchars($userData['id']); ?>"></td>
                <td><input type="text" name="email" value="<?= htmlspecialchars($userData['email']); ?>"></td>
                <td><input type="text" name="first_name" value="<?= htmlspecialchars($userData['first_name']); ?>"></td>
                <td><input type="text" name="last_name" value="<?= htmlspecialchars($userData['last_name']); ?>"></td>
                <td><input type="text" name="age" value="<?= htmlspecialchars($userData['age']); ?>"></td>
                <td>
                    <button type="submit" name="action" value="update">Edit</button>
                    <a href="index.php?action=delete&id=<?= htmlspecialchars($userData['id']); ?>"
                       onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                </td>
            </tr>
        </form>
    <?php endforeach; ?>
</table>
<form action="index.php" method="post">
    <input type="hidden" name="action" value="create">
    <label>Email: <input type="text" name="email"></label><br>
    <label>First Name: <input type="text" name="first_name"></label><br>
    <label>Last Name: <input type="text" name="last_name"></label><br>
    <label>Age: <input type="text" name="age"></label><br>
    <button type="submit">Добавить пользователя</button>
</form>
</body>
</html>

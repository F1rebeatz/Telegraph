<?php
if (!defined('APP_ENTRY_POINT')) {
    exit('Do not access this file directly.');
}
$host = 'localhost';
$db   = 'module_20';
$dbuser = 'root';
$pass = '1478';

class User
{
    protected PDO $connection;

    public function __construct($host, $db, $dbuser, $pass)
    {$dsn = "mysql:host=$host;dbname=$db;charset=utf8";
        try {
            $this->connection = new PDO($dsn, $dbuser, $pass);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Соединение не удалось" . $e->getMessage());
        }


    }

    public function create($data):void
    {
        $fields = implode(', ', array_keys($data));
        $placeholders = ":" . implode(', :', array_keys($data));
        $sql = "INSERT INTO `users` ($fields) VALUES ($placeholders)";


        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($data);
        } catch (PDOException $e) {
            die("Ошибка при создании пользователя " . $e->getMessage());
        }
    }
    public function update($id, $data):void
    {
        $fields = [];
        foreach ($data as $key => $value) {
            $fields[] = "$key = :$key";
        }

        $fieldsString = implode(', ', $fields);
        $sql = "UPDATE `users` SET $fieldsString WHERE `id` = :id";

        $data['id'] = $id;

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($data);
        } catch (PDOException $e) {
            die("Ошибка при обновлении пользователя " . $e->getMessage());
        }
    }
        public  function delete($id):void
        {
            $sql = "DELETE FROM `users` WHERE `id` = ?";
            try {
                $stmt = $this->connection->prepare($sql);
                $stmt->execute([$id]);
            } catch (PDOException $e) {
                die("Ошибка при удалении пользователя " . $e->getMessage());
        }
        }
        public function list():array {
            $data = $this->connection->query("SELECT * FROM `users`")->fetchAll(PDO::FETCH_ASSOC);

            return $data;
    }
}


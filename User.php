<?php
if (!defined('APP_ENTRY_POINT')) {
    exit('Do not access this file directly.');
}

class User
{
    protected PDO $connection;

    /**
     * @param $host
     * @param $db
     * @param $dbuser
     * @param $pass
     */
    public function __construct(string $host, string $db, string $dbuser, string $pass)
    {
        $dsn = "mysql:host=$host;dbname=$db;charset=utf8";
        try {
            $this->connection = new PDO($dsn, $dbuser, $pass);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Соединение не удалось" . $e->getMessage());
        }
    }

    /**
     * @param array $data
     * @return void
     */
    public function create(array $data): void
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

    /**
     * @param int $id
     * @param array $data
     * @return void
     */
    public function update(int $id, array $data): void
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

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $sql = "DELETE FROM `users` WHERE `id` = ?";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$id]);
        } catch (PDOException $e) {
            die("Ошибка при удалении пользователя " . $e->getMessage());
        }
    }

    /**
     * @return array
     */
    public function list(): array
    {
        $data = $this->connection->query("SELECT * FROM `users`")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}

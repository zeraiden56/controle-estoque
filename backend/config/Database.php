<?php
require_once __DIR__ . '/../utils/DotEnv.php';

class Database {
    private $conn;

    public function getConnection() {
        (new DotEnv(__DIR__ . '/../.env'))->load();

        $host = getenv('DB_HOST');
        $db   = getenv('DB_NAME');
        $user = getenv('DB_USER');
        $pass = getenv('DB_PASS');

        try {
            $this->conn = new PDO("pgsql:host=$host;dbname=$db", $user, $pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]);
            exit;
        }

        return $this->conn;
    }
}

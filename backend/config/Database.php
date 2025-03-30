<?php
namespace Config;

require_once __DIR__ . '/../cors.php';
require_once __DIR__ . '/../vendor/autoload.php'; // Isso importa o Dotenv

use PDO;
use Dotenv\Dotenv;

class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        // Carrega variáveis do .env
        $dotenv = Dotenv::createImmutable(__DIR__ . '/..');
        $dotenv->load();

        $host = $_ENV['DB_HOST'] ?? 'localhost';
        $port = $_ENV['DB_PORT'] ?? '5432';
        $dbname = $_ENV['DB_NAME'] ?? 'controle_estoque';
        $user = $_ENV['DB_USER'] ?? 'postgres';
        $pass = $_ENV['DB_PASS'] ?? 'postgres';

        $dsn = "pgsql:host={$host};port={$port};dbname={$dbname};";
        $this->pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }

    public static function getInstance(): PDO {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance->pdo;
    }
}

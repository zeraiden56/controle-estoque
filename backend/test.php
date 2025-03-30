<?php
require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

try {
    $dbHost = trim(getenv('DB_HOST'));
    $dbPort = trim(getenv('DB_PORT'));
    $dbName = trim(getenv('DB_NAME'));

    $dsn = "pgsql:host={$dbHost};port={$dbPort};dbname={$dbName};";
    // Para debug, você pode descomentar a linha abaixo temporariamente:
    // echo "DSN: $dsn\n";

    $pdo = new PDO($dsn, getenv('DB_USER'), getenv('DB_PASS'), [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    $stmt = $pdo->query("SELECT * FROM produtos");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
?>

<?php
require_once __DIR__ . '/vendor/autoload.php';

$envPath = __DIR__ . '/.env';
if (file_exists($envPath)) {
    $envContents = file_get_contents($envPath);
    echo "Conteúdo do .env:\n" . $envContents . "\n\n";
} else {
    echo "Arquivo .env não encontrado em: $envPath\n";
}

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

var_dump($_ENV);
?>

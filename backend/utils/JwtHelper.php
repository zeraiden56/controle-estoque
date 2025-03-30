<?php
// Arquivo: backend/api/usuarios/index.php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../cors.php';
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../utils/JwtHelper.php'; // Aqui!

use Config\Database;

$pdo = Database::getInstance();

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $user = $input['user'] ?? '';
    $password = $input['password'] ?? '';

    try {
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE nome = :user LIMIT 1");
        $stmt->bindValue(':user', $user);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && $usuario['senha'] === $password) {
            $payload = [
                'id' => $usuario['id'],
                'nome' => $usuario['nome'],
                'perfil' => $usuario['perfil']
            ];

            $token = JwtHelper::gerarToken($payload);

            echo json_encode([
                'token' => $token,
                'usuario' => $payload,
                'status' => 'success'
            ]);
            exit;
        }

        http_response_code(401);
        echo json_encode(['error' => 'Credenciais inválidas.']);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Método não permitido.']);
}

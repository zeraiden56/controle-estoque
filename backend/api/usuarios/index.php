<?php
// Arquivo: backend/api/usuarios/index.php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1); // adicionado
error_reporting(E_ALL);

header('Content-Type: application/json'); // adicionado para garantir JSON sempre

require_once __DIR__ . '/../../cors.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Conexão com o banco
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../config/Database.php';

use Config\Database;

$pdo = Database::getInstance();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $user = $input['user'] ?? '';
    $password = $input['password'] ?? '';

    try {
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE nome = :nome LIMIT 1");
        $stmt->bindValue(':nome', $user);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && $usuario['senha'] === $password) {
            // ⚠️ Em produção, troque isso por JWT
            $token = base64_encode("usuario:{$user}");

            echo json_encode([
                'token' => $token,
                'status' => 'success',
                'usuario' => [
                    'id' => $usuario['id'],
                    'nome' => $usuario['nome'],
                    'perfil' => $usuario['perfil']
                ]
            ]);
            exit;
        }

        http_response_code(401);
        echo json_encode([
            'error' => 'Credenciais inválidas.'
        ]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Erro no servidor: ' . $e->getMessage()]);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Método não permitido.']);
}

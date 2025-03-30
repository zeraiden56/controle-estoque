<?php
require_once __DIR__ . '/../../cors.php';
require_once __DIR__ . '/../utils/JwtHelper.php';

function verificarAutenticacao() {
    $headers = getallheaders();
    $authHeader = $headers['Authorization'] ?? '';

    if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
        $token = $matches[1];
        $payload = JwtHelper::verificarToken($token);

        if ($payload) {
            return $payload; // retorna os dados do usuário
        }
    }

    http_response_code(401);
    echo json_encode(['error' => 'Não autorizado.']);
    exit;
}

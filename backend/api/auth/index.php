<?php
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../models/Usuario.php';
require_once __DIR__ . '/../../utils/JwtHelper.php';
require_once __DIR__ . '/../cors.php';

header('Content-Type: application/json');

$dados = json_decode(file_get_contents("php://input"), true);

if (!isset($dados['email'], $dados['senha'])) {
    http_response_code(400);
    echo json_encode(['erro' => 'Email e senha são obrigatórios']);
    exit;
}

$db = new Database();
$conn = $db->getConnection();

$usuarioModel = new Usuario($conn);
$usuario = $usuarioModel->buscarPorEmail($dados['email']);

if (!$usuario || !password_verify($dados['senha'], $usuario['senha'])) {
    http_response_code(401);
    echo json_encode(['erro' => 'Credenciais inválidas']);
    exit;
}

$token = JwtHelper::gerarToken([
    'id' => $usuario['id'],
    'email' => $usuario['email']
]);

echo json_encode(['token' => $token]);

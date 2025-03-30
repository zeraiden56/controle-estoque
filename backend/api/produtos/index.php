<?php

require_once __DIR__ . '/../../cors.php';
require_once '../../config/Database.php';
require_once '../../models/Produto.php';

$db = new Database();
$conn = $db->getConnection();

$produto = new Produto($conn);

// Detecta o método HTTP
$method = $_SERVER['REQUEST_METHOD'];

// Se tiver ID passado na URL tipo /produtos/1
$request = explode('/', trim($_SERVER['PATH_INFO'] ?? '', '/'));
$id = $request[0] ?? null;

header('Content-Type: application/json');

switch ($method) {
    case 'GET':
        if ($id) {
            echo json_encode($produto->buscarPorId($id));
        } else {
            echo json_encode($produto->listarTodos());
        }
        break;

    case 'POST':
        $dados = json_decode(file_get_contents("php://input"), true);
        echo json_encode($produto->criar($dados));
        break;

    case 'PUT':
        if (!$id) {
            http_response_code(400);
            echo json_encode(['erro' => 'ID é obrigatório para atualizar']);
            break;
        }
        $dados = json_decode(file_get_contents("php://input"), true);
        echo json_encode($produto->atualizar($id, $dados));
        break;

    case 'DELETE':
        if (!$id) {
            http_response_code(400);
            echo json_encode(['erro' => 'ID é obrigatório para deletar']);
            break;
        }
        echo json_encode($produto->deletar($id));
        break;

    default:
        http_response_code(405);
        echo json_encode(['erro' => 'Método não permitido']);
        break;
}

<?php

require_once __DIR__ . '/../cors.php';

// Se for uma requisição OPTIONS, finalize aqui:
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Debug: exibe as variáveis usando $_ENV
error_log("DB_HOST: [" . ($_ENV['DB_HOST'] ?? '') . "]");
error_log("DB_PORT: [" . ($_ENV['DB_PORT'] ?? '') . "]");
error_log("DB_NAME: [" . ($_ENV['DB_NAME'] ?? '') . "]");


// Roteamento simples:
$method = $_SERVER['REQUEST_METHOD'];
$path   = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Remove a parte do caminho que não seja a rota da API, se necessário
// Exemplo: se a URL for https://seusite.com/api/produtos, a rota será "/api/produtos"
$route = $path; // Você pode fazer ajustes aqui se tiver subdiretórios

switch ($route) {
    case '/api/produtos':
        require_once __DIR__ . '/../models/Produto.php';
        $produtoModel = new \Models\Produto();
        if ($method === 'GET') {
            echo json_encode($produtoModel->getAll());
        } elseif ($method === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            // Validação dos dados deve ser feita aqui
            $id = $produtoModel->create($data['nome'], $data['descricao'], (float)$data['preco'], (int)$data['quantidade']);
            echo json_encode(['id' => $id]);
        } else {
            http_response_code(405);
            echo json_encode(['error' => 'Método não permitido']);
        }
        break;

    case '/api/vendas':
        require_once __DIR__ . '/../models/Venda.php';
        $vendaModel = new \Models\Venda();
        if ($method === 'GET') {
            echo json_encode($vendaModel->getAll());
        } elseif ($method === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            // Exemplo: cria venda e adiciona itens
            $vendaId = $vendaModel->create($data['usuario_id'], 0);
            foreach ($data['itens'] as $item) {
                $vendaModel->addItem($vendaId, $item['produto_id'], $item['quantidade'], $item['valor_unitario']);
            }
            echo json_encode(['venda_id' => $vendaId]);
        } else {
            http_response_code(405);
            echo json_encode(['error' => 'Método não permitido']);
        }
        break;
    
    // Outras rotas, como para lucros ou relatórios:
    case '/api/lucros':
        require_once __DIR__ . '/../models/Lucro.php';
        $lucroModel = new \Models\Lucro();
        if ($method === 'GET') {
            echo json_encode($lucroModel->getAll());
        } elseif ($method === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $id = $lucroModel->create($data['venda_id'], $data['produto_id'], (int)$data['quantidade'], (float)$data['valor_unitario'], (float)$data['custo_unitario']);
            echo json_encode(['id' => $id]);
        } else {
            http_response_code(405);
            echo json_encode(['error' => 'Método não permitido']);
        }
        break;
    
    // Se não encontrou a rota, você pode optar por um comportamento padrão:
    default:
        // Se nenhuma rota for especificada, por exemplo, vamos apenas testar a conexão
        try {
            $dbHost = trim($_ENV['DB_HOST'] ?? '');
            $dbPort = trim($_ENV['DB_PORT'] ?? '');
            $dbName = trim($_ENV['DB_NAME'] ?? '');
            $dbUser = trim($_ENV['DB_USER'] ?? '');
            $dbPass = trim($_ENV['DB_PASS'] ?? '');
    
            $dsn = "pgsql:host={$dbHost};port={$dbPort};dbname={$dbName};";
            error_log("DSN: " . $dsn);
    
            $pdo = new PDO($dsn, $dbUser, $dbPass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
    
            $stmt = $pdo->query("SELECT * FROM produtos");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            echo json_encode($result);
    
        } catch (\PDOException $e) {
            http_response_code(500);
            echo json_encode(["error" => $e->getMessage()]);
        }
        break;
}

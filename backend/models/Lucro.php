<?php
namespace Models;

require_once __DIR__ . '/../cors.php';

use Config\Database;
use PDO;

class Lucro {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    // Cria um registro de lucro com base no custo e valor de venda
    public function create(int $vendaId, int $produtoId, int $quantidade, float $valorUnitario, float $custoUnitario): int {
        $sql = "INSERT INTO lucros (venda_id, produto_id, quantidade, valor_unitario, custo_unitario)
                VALUES (:venda_id, :produto_id, :quantidade, :valor_unitario, :custo_unitario)
                RETURNING id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':venda_id', $vendaId, PDO::PARAM_INT);
        $stmt->bindValue(':produto_id', $produtoId, PDO::PARAM_INT);
        $stmt->bindValue(':quantidade', $quantidade, PDO::PARAM_INT);
        $stmt->bindValue(':valor_unitario', $valorUnitario);
        $stmt->bindValue(':custo_unitario', $custoUnitario);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    public function getAll(): array {
        $stmt = $this->pdo->query("SELECT * FROM lucros ORDER BY criado_em DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

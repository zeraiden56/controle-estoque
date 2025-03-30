<?php
namespace Models;

require_once __DIR__ . '/../cors.php';

use Config\Database;
use PDO;

class Venda {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    // Cria uma venda (cabeçalho)
    public function create(int $usuarioId, float $valorTotal = 0): int {
        $sql = "INSERT INTO vendas (usuario_id, valor_total)
                VALUES (:usuario_id, :valor_total)
                RETURNING id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':usuario_id', $usuarioId, PDO::PARAM_INT);
        $stmt->bindValue(':valor_total', $valorTotal);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    // Adiciona item na venda
    public function addItem(int $vendaId, int $produtoId, int $quantidade, float $valorUnitario): int {
        $valorTotal = $quantidade * $valorUnitario;
        $sql = "INSERT INTO venda_itens (venda_id, produto_id, quantidade, valor_unitario, valor_total)
                VALUES (:venda_id, :produto_id, :quantidade, :valor_unitario, :valor_total)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':venda_id', $vendaId, PDO::PARAM_INT);
        $stmt->bindValue(':produto_id', $produtoId, PDO::PARAM_INT);
        $stmt->bindValue(':quantidade', $quantidade, PDO::PARAM_INT);
        $stmt->bindValue(':valor_unitario', $valorUnitario);
        $stmt->bindValue(':valor_total', $valorTotal);
        $stmt->execute();
        return $stmt->rowCount();
    }

    // Retorna a venda com itens
    public function getById(int $id): ?array {
        // Cabeçalho
        $stmt = $this->pdo->prepare("SELECT * FROM vendas WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $venda = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$venda) return null;

        // Itens
        $stmtItens = $this->pdo->prepare("SELECT * FROM venda_itens WHERE venda_id = :venda_id");
        $stmtItens->bindValue(':venda_id', $id, PDO::PARAM_INT);
        $stmtItens->execute();
        $venda['itens'] = $stmtItens->fetchAll(PDO::FETCH_ASSOC);

        return $venda;
    }

    // Lista todas as vendas com itens
    public function getAll(): array {
        $stmt = $this->pdo->query("SELECT * FROM vendas ORDER BY id DESC");
        $vendas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($vendas as &$venda) {
            $stmtItens = $this->pdo->prepare("SELECT * FROM venda_itens WHERE venda_id = :venda_id");
            $stmtItens->bindValue(':venda_id', $venda['id'], PDO::PARAM_INT);
            $stmtItens->execute();
            $venda['itens'] = $stmtItens->fetchAll(PDO::FETCH_ASSOC);
        }

        return $vendas;
    }
}

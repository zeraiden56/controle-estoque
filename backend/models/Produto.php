<?php
namespace Models;

require_once __DIR__ . '/../cors.php';  // Ajuste o caminho conforme sua estrutura

use Config\Database;
use PDO;

class Produto {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function getAll(): array {
        $stmt = $this->pdo->query("SELECT * FROM produtos ORDER BY id ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM produtos WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $produto = $stmt->fetch(PDO::FETCH_ASSOC);
        return $produto ?: null;
    }

    public function create(string $nome, string $descricao, float $preco, int $quantidade): int {
        $sql = "INSERT INTO produtos (nome, descricao, preco, quantidade)
                VALUES (:nome, :descricao, :preco, :quantidade)
                RETURNING id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':descricao', $descricao);
        $stmt->bindValue(':preco', $preco);
        $stmt->bindValue(':quantidade', $quantidade, PDO::PARAM_INT);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    public function update(int $id, string $nome, string $descricao, float $preco, int $quantidade): int {
        $sql = "UPDATE produtos
                SET nome = :nome, descricao = :descricao, preco = :preco, quantidade = :quantidade
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':descricao', $descricao);
        $stmt->bindValue(':preco', $preco);
        $stmt->bindValue(':quantidade', $quantidade, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function delete(int $id): int {
        $stmt = $this->pdo->prepare("DELETE FROM produtos WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }
}

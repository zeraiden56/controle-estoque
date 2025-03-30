<?php
class Produto {
    private $conn;
    private $tabela = 'produtos';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function listarTodos() {
        $query = "SELECT * FROM {$this->tabela} ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $query = "SELECT * FROM {$this->tabela} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function criar($dados) {
        $query = "INSERT INTO {$this->tabela} (nome, preco, estoque) VALUES (:nome, :preco, :estoque)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ':nome' => $dados['nome'],
            ':preco' => $dados['preco'],
            ':estoque' => $dados['estoque']
        ]);
        return ['mensagem' => 'Produto criado com sucesso'];
    }

    public function atualizar($id, $dados) {
        $query = "UPDATE {$this->tabela} SET nome = :nome, preco = :preco, estoque = :estoque WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ':id' => $id,
            ':nome' => $dados['nome'],
            ':preco' => $dados['preco'],
            ':estoque' => $dados['estoque']
        ]);
        return ['mensagem' => 'Produto atualizado com sucesso'];
    }

    public function deletar($id) {
        $query = "DELETE FROM {$this->tabela} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':id' => $id]);
        return ['mensagem' => 'Produto excluído com sucesso'];
    }
}

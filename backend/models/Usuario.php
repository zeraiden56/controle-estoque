<?php
class Usuario {
    private $conn;
    private $tabela = "usuarios";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function buscarPorEmail($email) {
        $query = "SELECT * FROM {$this->tabela} WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

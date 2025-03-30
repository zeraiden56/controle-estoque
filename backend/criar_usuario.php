<?php
require_once __DIR__ . '/config/Database.php';

try {
    $db = new Database();
    $conn = $db->getConnection();

    $email = 'admin@teste.com';
    $senhaPura = '123456';
    $senhaHash = password_hash($senhaPura, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (email, senha) VALUES (:email, :senha)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senhaHash);

    if ($stmt->execute()) {
        echo "✅ Usuário criado com sucesso!\n";
    } else {
        echo "❌ Falha ao criar usuário.\n";
    }

} catch (PDOException $e) {
    echo "Erro ao conectar ou inserir: " . $e->getMessage() . "\n";
}

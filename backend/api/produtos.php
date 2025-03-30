<?php
require_once('../config/database.php');

header("Content-Type: application/json; charset=UTF-8");

$db = new Database();
$conn = $db->getConnection();

$query = "SELECT * FROM produtos";
$stmt = $conn->prepare($query);
$stmt->execute();

$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($produtos);
?>

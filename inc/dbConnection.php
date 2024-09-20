<?php
$host = 'localhost';
$dbname = 'agenda';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erro ao conectar-se ao banco de dados: ' . $e->getMessage();
    die(); // Adiciona uma parada na execução do script caso haja erro
}
?>

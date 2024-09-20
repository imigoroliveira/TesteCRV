<?php
include '../inc/dbConnection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare('DELETE FROM eventos WHERE id = ?');
    $stmt->execute([$id]);
    header('Location: ../index.php');
    exit(); 
} else {
    header('Location: index.php');
    exit();
}

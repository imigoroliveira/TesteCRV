<?php
include '../inc/dbConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = isset($_POST['title']) ? trim($_POST['title']) : null;
    $description = isset($_POST['description']) ? trim($_POST['description']) : null;
    $date = isset($_POST['date']) ? trim($_POST['date']) : null;
    $location = isset($_POST['location']) ? trim($_POST['location']) : null;

    if ($title && $date) {

        $stmt = $pdo->prepare('INSERT INTO eventos (title, description, date, location) VALUES (?, ?, ?, ?)');

        if ($stmt->execute([$title, $description, $date, $location])) {
            header('Location: ../index.php?message=Evento criado com sucesso');
            exit;
        } else {
            echo 'Erro ao criar o evento.';
        }

    } else {
        echo 'Por favor, preencha todos os campos obrigatórios (Título e Data).';
    }

} else {
    header('Location: ../index.php');
    exit;
}

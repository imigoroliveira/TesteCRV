<?php
include '../inc/dbConnection.php';

die($_GET['id']);

if (isset($_GET['id']) && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['date']) && isset($_POST['location'])) {

    $id = $_GET['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $location = $_POST['location'];

    try {
        $stmt = $pdo->prepare('UPDATE eventos SET title = ?, description = ?, date = ?, location = ? WHERE id = ?');
        echo "<pre>Query: UPDATE eventos SET title = '$title', description = '$description', date = '$date', location = '$location' WHERE id = $id</pre>";
        
        $stmt->execute([$title, $description, $date, $location, $id]);
        if ($stmt->rowCount()) {
            header('Location: ../index.php?message=Evento atualizado com sucesso!');
        } else {
            header('Location: ../error.php?message=Nenhuma alteração foi feita no evento.');
        }

    } catch (PDOException $e) {
        header('Location: ../error.php?message=' . urlencode($e->getMessage()));
    }
} else {
    header('Location: ../error.php?message=Dados do formulário incompletos.');
}

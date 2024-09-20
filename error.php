<?php
// Verifica se a mensagem de erro foi passada via URL
if (isset($_GET['message'])) {
    $errorMessage = htmlspecialchars($_GET['message']);
} else {
    $errorMessage = 'Ocorreu um erro desconhecido.';
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-danger">
            <h4 class="alert-heading">Erro</h4>
            <p><?= $errorMessage ?></p>
            <hr>
            <a href="index.php" class="btn btn-primary">Voltar à Página Inicial</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

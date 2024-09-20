<?php
include 'inc/dbConnection.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Agenda</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container mt-4">
        <h1>Agenda</h1>

        <div class="d-flex justify-content-end mb-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createEventModal">
                Adicionar Novo Evento
            </button>
        </div>

        <?php
        $stmt = $pdo->query('SELECT * FROM eventos');
        $eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Data</th>
                    <th>Localização</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($eventos as $evento): ?>
                <tr>
                    <td><?= htmlspecialchars($evento['id']) ?></td>
                    <td><?= htmlspecialchars($evento['title']) ?></td>
                    <td><?= htmlspecialchars($evento['description']) ?></td>
                    <td><?= htmlspecialchars(date('d/m/Y', strtotime($evento['date']))) ?></td>
                    <td><?= htmlspecialchars($evento['location']) ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editEventModal-<?= $evento['id'] ?>" data-id="<?= $evento['id'] ?>">Editar</button>
                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmDeleteModal-<?= $evento['id'] ?>">Excluir</button>
                    </td>
                </tr>

                <div class="modal fade" id="editEventModal-<?= $evento['id'] ?>" tabindex="-1" aria-labelledby="editEventModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <?php
                            include 'editEventModal.php';
                            ?>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="confirmDeleteModal-<?= $evento['id'] ?>" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Exclusão</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Você tem certeza que deseja excluir o evento "<?= htmlspecialchars($evento['title']) ?>"?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <a href="actions/delete.php?id=<?= $evento['id'] ?>" class="btn btn-danger">Excluir</a>
                            </div>
                        </div>
                    </div>
                </div>

                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="createEventModal" tabindex="-1" aria-labelledby="createEventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <?php include 'createEventModal.php'; ?>
            </div>
        </div>
    </div>
</body>
</html>

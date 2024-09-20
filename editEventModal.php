<?php
include 'inc/dbConnection.php';

$id = $evento['id'];

$stmt = $pdo->prepare('SELECT * FROM eventos WHERE id = ?');
$stmt->execute([$id]);
$event = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div class="modal-header">
    <h5 class="modal-title">Edição de Evento</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form id="editForm" action="actions/edit.php" method="post">
        <input type="hidden" id="event_id" name="id" value="<?= $event['id'] ?>">
        
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" id="title" name="title" class="form-control" value="<?= htmlspecialchars($event['title']) ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Descrição</label>
            <textarea id="description" name="description" class="form-control"><?= htmlspecialchars($event['description']) ?></textarea>
        </div>
        <div class="form-group">
            <label for="date">Data</label>
            <input type="date" id="date" name="date" class="form-control" value="<?= htmlspecialchars($event['date']) ?>" required>
        </div>
        <div class="form-group">
            <label for="location">Localização</label>
            <input type="text" id="location" name="location" class="form-control" value="<?= htmlspecialchars($event['location']) ?>">
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
    <button type="submit" form="editForm" class="btn btn-primary">Salvar</button>
</div>

<script>
    document.getElementById('editForm').addEventListener('submit', function(e) {
        e.preventDefault();
        var eventId = document.getElementById('event_id').value;
        this.action = 'actions/edit.php?id=' + eventId;
        this.submit();
    });
</script>

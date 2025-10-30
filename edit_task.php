<?php
include 'db.php';

// Buscar todas as tarefas
$tarefas = $conn->query("SELECT t.id, t.titulo, t.status, u.nome AS usuario 
                         FROM tarefas t 
                         LEFT JOIN usuarios u ON t.usuario_id = u.id
                         ORDER BY t.data_criacao DESC");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];
    $novo_status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE tarefas SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $novo_status, $id);
    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        $erro = "Erro ao atualizar tarefa: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Tarefa - Kanban</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="top-bar">
    <button onclick="window.location.href='index.php'">Voltar</button>
</div>

<div class="form-container">
    <h1>Atualizar Status da Tarefa</h1>

    <?php if (!empty($erro)): ?>
        <p style="color:red; text-align:center;"><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <form method="post" class="task-form">
        <label for="id">Selecione a Tarefa:</label>
        <select name="id" id="id" required>
            <option value="">-- Escolha uma tarefa --</option>
            <?php while ($t = $tarefas->fetch_assoc()): ?>
                <option value="<?= $t['id'] ?>">
                    <?= htmlspecialchars($t['titulo']) ?> (<?= htmlspecialchars($t['usuario'] ?? 'Sem responsável') ?>)
                </option>
            <?php endwhile; ?>
        </select>

        <label for="status">Novo Status:</label>
        <select name="status" id="status" required>
            <option value="a_fazer">A Fazer</option>
            <option value="fazendo">Fazendo</option>
            <option value="pronto">Pronto</option>
        </select>

        <button type="submit" class="btn-submit">Atualizar</button>
    </form>
</div>

</body>
</html>

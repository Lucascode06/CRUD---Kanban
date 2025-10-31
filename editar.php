<?php
include 'db.php';
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
    <title>Editar Tarefa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="top-bar">
    <button onclick="window.location.href='index.php'">Voltar</button>
</div>

<div class="form-container">
    <form method="post" class="task-form">
        <label for="id">Selecione a Tarefa:</label>
        <select name="id" id="id" required>
            <option value="">-- Escolha uma tarefa --</option>
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

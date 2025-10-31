<?php
include 'db.php';

$usuarios = $conn->query("SELECT * FROM usuarios");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];  
    $status = $_POST['status'];
    $prioridade = (int)$_POST['prioridade'];
    $usuario_id = (int)$_POST['usuario_id'];

    $stmt = $conn->prepare("INSERT INTO tarefas (titulo, descricao, status, prioridade, usuario_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssii", $titulo, $descricao, $status, $prioridade, $usuario_id);
    if($stmt->execute()) header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Adicionar Tarefa</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div id="conte">
    <form method="post">
    <label>Título:
        <input type="text" name="titulo" required>
    </label>

    <label>Descrição:
        <textarea name="descricao"></textarea>
    </label>

    <label>Status:
        <select name="status">
            <option value="a_fazer">A Fazer</option>
            <option value="fazendo">Fazendo</option>
            <option value="pronto">Pronto</option>
        </select>
    </label>

    <label>Prioridade:
        <input type="number" name="prioridade" value="1" min="1" max="5">
    </label>

    <label>Responsável:
        <select name="usuario_id">
        </select>
    </label>

    <button type="submit">Adicionar</button>
        </form>
</div>
<a href="index.php">Voltar</a>

</body>
</html>

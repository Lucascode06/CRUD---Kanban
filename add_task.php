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
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #366a8e;
        color: #fff;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        height: 100vh;
        margin: 0;
        padding-top: 50px;
    }

    h1 {
        background-color: #0a1f33;
        padding: 15px 40px;
        border-radius: 25px;
        text-align: center;
        margin-bottom: 30px;
    }

    form {
        background-color: #f9f9f9;
        color: #000;
        padding: 30px;
        border-radius: 20px;
        width: 400px;
        box-shadow: 0 0 10px rgba(0,0,0,0.3);
    }

    label {
        display: block;
        margin-bottom: 15px;
        font-weight: bold;
    }

    input[type="text"],
    input[type="number"],
    textarea,
    select {
        width: 100%;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 14px;
        margin-top: 5px;
    }

    textarea {
        resize: none;
        height: 80px;
    }

    button {
        background-color: #0a1f33;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 25px;
        cursor: pointer;
        font-size: 16px;
        width: 100%;
        margin-top: 10px;
        transition: 0.2s;
    }

    button:hover {
        background-color: #102d4a;
    }

    a {
        margin-top: 20px;
        display: inline-block;
        background-color: #0a1f33;
        color: white;
        text-decoration: none;
        padding: 10px 20px;
        border-radius: 25px;
        transition: 0.2s;
    }

    a:hover {
        background-color: #102d4a;
    }

</style>
</head>
<body>

<h1>Adicionar Tarefa</h1>

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
            <?php while($u = $usuarios->fetch_assoc()): ?>
                <option value="<?= $u['id'] ?>"><?= htmlspecialchars($u['nome']) ?></option>
            <?php endwhile; ?>
        </select>
    </label>

    <button type="submit">Adicionar</button>
</form>

<a href="index.php">Voltar</a>

</body>
</html>

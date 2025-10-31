<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO usuarios (nome, senha) VALUES (?, ?)");
    $stmt->bind_param("ss", $nome, $senha);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        $erro = "Erro ao registrar usuário: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Registrar Usuário - Kanban</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="top-bar">
    <button onclick="window.location.href='index.php'">Voltar</button>
</div>

<div class="form-container">
    <form method="post" class="task-form">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" placeholder="Digite o nome" required>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" placeholder="Digite a senha" required>

        <button type="submit" class="btn-submit">Registrar</button>
    </form>
</div>

</body>
</html>

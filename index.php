<?php
include 'db.php';

// Buscar tarefas
$sql = "SELECT t.*, u.nome AS usuario_nome FROM tarefas t 
        LEFT JOIN usuarios u ON t.usuario_id = u.id 
        ORDER BY prioridade DESC, data_criacao DESC";
$result = $conn->query($sql);

$a_fazer = [];
$fazendo = [];
$pronto = [];

while ($row = $result->fetch_assoc()) {
    switch($row['status']) {
        case 'a_fazer': $a_fazer[] = $row; break;
        case 'fazendo': $fazendo[] = $row; break;
        case 'pronto': $pronto[] = $row; break;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Kanban - To Do List</title>
<style>
    body { font-family: Arial; background: #366a8e; color: #fff; margin: 20px; }
    .top-bar { margin-bottom: 20px; }
    .top-bar button { margin-right: 10px; padding: 10px; border-radius: 20px; border: none; background: #0a1f33; color: #fff; cursor: pointer; }
    table { width: 100%; border-collapse: collapse; background: #fff; color: #000; }
    th, td { border: 1px solid #ccc; padding: 10px; vertical-align: top; }
    .task { background: #f0f0f0; padding: 8px; margin-bottom: 5px; border-radius: 5px; }
    .doing { background: #fff3cd; }
    .done { background: #d4edda; }
</style>
</head>
<body>
<div class="top-bar">
    <button onclick="window.location.href='register_user.php'">Registrar User</button>
    <button onclick="window.location.href='add_task.php'">Nova Task</button>
    <button onclick="window.location.href='edit_task.php'">Editar Task</button>
</div>

<h1>Kanban</h1>
<table>
<thead>
<tr>
<th>A Fazer (To Do)</th>
<th>Fazendo (Doing)</th>
<th>Pronto (Done)</th>
</tr>
</thead>
<tbody>
<tr>
<td>
<?php foreach($a_fazer as $t): ?>
<div class="task">
<strong><?= htmlspecialchars($t['titulo']) ?></strong><br>
<?= htmlspecialchars($t['descricao']) ?><br>
<small>Prioridade: <?= $t['prioridade'] ?> | <?= htmlspecialchars($t['usuario_nome']) ?></small>
</div>
<?php endforeach; ?>
</td>
<td>
<?php foreach($fazendo as $t): ?>
<div class="task doing">
<strong><?= htmlspecialchars($t['titulo']) ?></strong><br>
<?= htmlspecialchars($t['descricao']) ?><br>
<small>Prioridade: <?= $t['prioridade'] ?> | <?= htmlspecialchars($t['usuario_nome']) ?></small>
</div>
<?php endforeach; ?>
</td>
<td>
<?php foreach($pronto as $t): ?>
<div class="task done">
<strong><?= htmlspecialchars($t['titulo']) ?></strong><br>
<?= htmlspecialchars($t['descricao']) ?><br>
<small>Prioridade: <?= $t['prioridade'] ?> | <?= htmlspecialchars($t['usuario_nome']) ?></small>
</div>
<?php endforeach; ?>
</td>
</tr>
</tbody>
</table>
</body>
</html>

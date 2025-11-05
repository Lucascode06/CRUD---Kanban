<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kanban</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Kanban</h1> 
    <?php
    include 'db.php';

    function exibirTarefas($conn, $status) {
        $result = $conn->query("SELECT titulo, descricao FROM tarefas WHERE status='$status'");
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='tarefa'>
                        <strong>{$row['titulo']}</strong><br>{$row['descricao']}
                      </div>";
            }
        } else {
            echo "<p class='vazio'>Nenhuma tarefa encontrada.</p>";
        }
    }
    ?>


    <div class="top-bar">
        <button onclick="window.location.href='cadastro_usuarios.php'">Registrar Usuário</button>
        <button onclick="window.location.href='cadastro_tarefas.php'">Adicionar Tarefa</button>
        <button onclick="window.location.href='editar.php'">Editar Tarefa</button>
        <button onclick="window.location.href='?api=1'">Sugestão</button>
    </div>

    <?php
    if (isset($_GET['api'])) {
        $url = "https://www.boredapi.com/api/activity/";
        $response = @file_get_contents($url);

        if ($response) {
            $data = json_decode($response, true);
            echo "<p class='sugestao'>Atividade sugerida: </p>";
        } else {
            echo "<p class='erro'>Erro.</p>";
        }
    }
    ?>

    <div class="board">
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
                    <td><?php exibirTarefas($conn, 'a_fazer'); ?></td>
                    <td><?php exibirTarefas($conn, 'fazendo'); ?></td>
                    <td><?php exibirTarefas($conn, 'pronto'); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>

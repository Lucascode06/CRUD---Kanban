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
    <?php include 'db.php'; ?>

    <div class="top-bar">
        <button onclick="window.location.href='cadastro_usuarios.php'">Registrar Usuário</button>
        <button onclick="window.location.href='cadastro_tarefas.php'">Adicionar Tarefa</button>
        <button onclick="window.location.href='editar.php'">Editar Tarefa</button>
    </div>

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
                                        <td>
                        <?php
                        $sql = "SELECT * FROM tarefas WHERE status='a_fazer'";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            echo "<div class='tarefa'>
                                    <strong>".$row['titulo']."</strong><br>".$row['descricao']."
                                  </div>";
                        }
                        ?>
                    </td>

                    <td>
                        <?php
                        $sql = "SELECT * FROM tarefas WHERE status='fazendo'";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            echo "<div class='tarefa'>
                                    <strong>".$row['titulo']."</strong><br>".$row['descricao']."
                                  </div>";
                        }
                        ?>
                    </td>

                    <td>
                        <?php
                        $sql = "SELECT * FROM tarefas WHERE status='pronto'";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            echo "<div class='tarefa'>
                                    <strong>".$row['titulo']."</strong><br>".$row['descricao']."
                                  </div>";
                        }
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>

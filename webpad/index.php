<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <script src="js/bootstrap.min.js"></script>
    </head>
    
    <body>
        <div class="jumbotron">
        <div class="container">
            <div class="row">

            </div>
            </br>
            <div class="row">
                <p>
                    <a href="create.php" class="btn btn-success">Adicionar</a>
                </p>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>lembrete</th>
                            <th>descricao</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'banco.php';
                        $pdo = banco::conectar();
                        $sql = 'SELECT * FROM webpad ORDER BY id_lembrete DESC';
                        $pdo->query($sql);

                        foreach(!@$pdo->getResult() as $row)
                        {
                            echo '<tr>';
                            echo '<td>'. $row['tit_lembrete'] . '</td>';
                            echo '<td>'. $row['desc_lembrete'] . '</td>';
                            echo '<td width=250>';
                            echo '<a class="btn btn-primary" href="read.php?id='.$row['tit_lembrete'].'">Listar</a>';
                            echo ' ';
                            echo '<a class="btn btn-warning" href="update.php?id='.$row['tit_lembrete'].'">Atualizar</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="delete.php?id='.$row['tit_lembrete'].'">Excluir</a>';
                            echo '</td>';
                            echo '<tr>';
                        }
                        banco::desconectar();
                        ?>
                    </tbody>                   
                </table>               
            </div>
        </div>
        </div>
    </body>
</html>

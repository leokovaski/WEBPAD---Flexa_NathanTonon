<?php
require 'banco.php';

$id = 0;

if(!empty($_GET['id_lembrete']))
{
    $id_lembrete = $_REQUEST['id_lembrete'];
}

if(!empty($_POST))
{
    $id_lembrete = $_POST['tit_lembrete'];


    //Delete do banco:
    $pdo = banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM webpad where id_lembrete = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id_lembrete));
    banco::desconectar();
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="span10 offset1">
                <div class="row">
                    <h3 class="well">Excluir lembrete</h3>
                </div>
                <form class="form-horizontal" action="delete.php" method="post">
                    <input type="hidden" lembrete="tit_lembrete" value="<?php echo 'tit_lembrete';?>"/>
                    <div class="alert alert-danger"> Deseja excluir o lembrete?
                    </div>
                    <div class="form actions">
                        <button type="submit" class="btn btn-danger">Sim</button>
                        <a href="index.php" type="btn" class="btn btn-default">Não</a>
                    </div>
                </form>
            </div>           
        </div>
    </body>    
</html>


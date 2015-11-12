<?php
    require 'banco.php';
    $id_lembrete = null;
    if(!empty($_GET['id_lembrete']))
    {
        $id_lembrete = $_REQUEST['id_lembrete'];
    }
    
    if(null==$id_lembrete)
    {
        header("Location: index.php");
    }
    else 
    {
       $pdo = banco::conectar();
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $sql = "SELECT * FROM webpad where id_lembrete = ?";
       $q = $pdo->prepare($sql);
       $q->execute(array($id_lembrete));
       $data = $q->fetch(PDO::FETCH_ASSOC);
       banco::desconectar();
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
                    <h3 class="well"> Listar lembretes </h3>
                </div>
                
                <div class="form-horizontal">                   
                    <div class="control-group">
                        <label class="control-label">lembrete</label>
                        <div class="controls">
                            <label class="carousel-inner">
                                <?php echo $data['titulo'];?>
                            </label>
                        </div>
                    </div>
                    
                  
                    <div class="control-group">
                        <label class="control-label">descricao</label>
                        <div class="controls">
                            <label class="carousel-inner">
                                <?php echo $data['descricao'];?>
                            </label>
                        </div>
                    </div>
                   
                    <br/>
                    <div class="form-actions">
                        <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
                    </div>
                    
                </div>
            </div>
        </div>
    </body>
</html>


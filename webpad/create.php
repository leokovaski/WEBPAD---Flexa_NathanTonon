<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <script src="js/bootstrap.min.js"></script>
    </head>
    
    <body>
        <div class="container">
            <div clas="span10 offset1">
                <div class="row">
                    <h3 class="well"> Adicionar lembrete </h3>
                    <form class="form-horizontal" action="create.php" method="post">
                        
                        <div class="control-group <?php echo !empty($tit_lembreteErro)?'error ' : '';?>">
                            <label class="control-label">lembrete</label>
                            <div class="controls">
                                <input size= "50" name="tit_lembrete" type="text" placeholder="titulo" required="" value="<?php echo !empty($tit_lembrete)?$tit_lembrete: '';?>">
                                <?php if(!empty($tit_lembreteErro)): ?>
                                    <span class="help-inline"><?php echo $tit_lembreteErro;?></span>
                                <?php endif;?>
                            </div>
                        </div>
                        
                        <div class="control-group <?php echo !empty($desc_lembreteErro)?'error ': '';?>">
                            <label class="control-label">descricao</label>
                            <div class="controls">
                                <input size="80" name="desc_lembrete" type="text" placeholder="descrição" required="" value="<?php echo !empty($desc_lembrete)?$desc_lembrete: '';?>">
                                <?php if(!empty($desc_lembreteErro)): ?>
                                <span class="help-inline"><?php echo $desc_lembreteErro;?></span>
                                <?php endif;?>
                        </div>
                        </div>
                        
                        <div class="form-actions">
                            <br/>
                
                            <button type="submit" class="btn btn-success">Adicionar</button>
                            <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
                        
                        </div>
                    </form>
                </div>
        </div>
    </body>
</html>


<?php
    require 'banco.php';
    
    if(!empty($_POST))
    {
        //Acompanha os erros de validação
        $tit_lembreteErro = null;
        $desc_lembreteErro = null;
       
        
        $tit_lembrete = $_POST['tit_lembrete'];
        $desc_lembrete = $_POST['desc_lembrete'];
       
        
        //Validaçao dos campos:
        $validacao = true;
        if(empty($tit_lembrete))
        {
            $tit_lembreteErro = 'Por favor digite o seu titulo do lembrete!';
            $validacao = false;
        }
        
        if(empty($desc_lembrete))
        {
            $desc_lembreteErro = 'Por favor digite o seu lembrete!';
            $validacao = false;
        }
        
        //Inserindo no Banco:
        if($validacao)
        {
            $pdo = banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO webpad (tit_lembrete, desc_lembrete) VALUES(?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($tit_lembrete,$desc_lembrete));
            banco::desconectar();
            header("Location: index.php");
        }
    }
?>

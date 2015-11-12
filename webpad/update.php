<?php 
	
	require 'banco.php';

	$id_lembrete = null;
	if ( !empty($_GET['id_lembrete'])) 
            {
		$id_lembrete = $_REQUEST['id_lembrete'];
            }
	
	if ( null==$id_lembrete ) 
            {
		header("Location: index.php");
            }
	
	if ( !empty($_POST)) 
            {
		
		$tit_lembreteErro = null;
		$desc_lembreteErro = null;
				
		$tit_lembrete = $_POST['tit_lembrete'];
		$desc_lembrete = $_POST['desc_lembrete'];
		
		//Validação
		$validacao = true;
		if (empty($tit_lembrete)) 
                {
                    $tit_lembreteErro = 'Por favor digite o titulo do lembrete!';
                    $validacao = false;
                }
		
		if (empty($desc_lembrete)) 
                {
                    $desc_lembreteErro = 'Por favor digite o lembrete!';
                    $validacao = false;
		} 
               
		
		// update lembrete
		if ($validacao) 
                {
                    $pdo = banco::conectar();
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "UPDATE webpad  set tit_lembrete = ?, desc_lembrete = ?";
                    $q = $pdo->prepare($sql);
                    $q->execute(array($tit_lembrete,$desc_lembrete));
                    banco::desconectar();
                    header("Location: index.php");
		}
	} 
        else 
            {
                $pdo = banco::conectar();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM webpad where id_lembrete = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id_lembrete));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$tit_lembrete = $tit_lembrete['titulo do lembrete'];
                $desc_lembrete = $desc_lembrete['descrição do lembrete'];
               	banco::desconectar();
	}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3 class="well"> Atualizar lembrete </h3>
                    </div>
             
                    <form class="form-horizontal" action="update.php?id_lembrete=<?php echo $id_lembrete?>" method="post">
                        
                      <div class="control-group <?php echo !empty($tit_lembreteErro)?'error':'';?>">
                        <label class="control-label">lembrete</label>
                        <div class="controls">
                            <input name="tit_lembrete" size="50" type="text"  placeholder="titulo lembrete" value="<?php echo !empty($tit_lembrete)?$tit_lembrete:'';?>">
                            <?php if (!empty($tit_lembreteErro)): ?>
                                <span class="help-inline"><?php echo $tit_lembreteErro;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                        
                       <div class="control-group <?php echo !empty($desc_lembreteErro)?'error':'';?>">
                        <label class="control-label">desc_lembrete</label>
                        <div class="controls">
                            <input name="desc_lembrete" size="80" type="text"  placeholder="descrição do lembrete" value="<?php echo !empty($desc_lembrete)?$desc_lembrete:'';?>">
                            <?php if (!empty($desc_lembreteErro)): ?>
                                <span class="help-inline"><?php echo $desc_lembreteErro;?></span>
                            <?php endif; ?>
                        </div>
                       </div>
                                                                  
                        <br/>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Atualizar</button>
                          <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
                        </div>
                    </form>
                </div>                 
    </div> 
  </body>
</html>


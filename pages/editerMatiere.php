<?php
     require_once("identifier.php");
    require_once('connexiondb.php');
    $idM=isset($_GET['idM'])?$_GET['idM']:0;
    $requeteM="select * from matiere where idMatiere=$idM";
    $resultatM=$pdo->query($requeteM);
    $matiere=$resultatM->fetch();
    $nomf=$matiere['nomMatiere'];
    $credit=$matiere['creditMatiere'];

?>

<!DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="UTF-8"> 
        <title>Edition de la Matière</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include("menu.php"); ?>

            <div class="container">    
        

                <div class="panel panel-primary margetop60">
                    <div class="panel-heading">Edition de la Matière</div>
                <div class="panel-body">
                <form method="POST" action="updateMatieres.php" class="form">
                    
                <div class="form-group">
                        <label for="niveau">Id de la Matière: <?php echo $idM ?></label>
                        <input type="hidden" name="idM" class="form-control"
                                    value="<?php echo $idM ?>"></input>
                    </div>

                    <div class="form-group">
                        <label for="niveau">Nom de la Matière :</label>
                        <input type="text" name="nomM" placeholder="Entrer le nom de la matiere" class="form-control"
                                    value="<?php echo $nomf ?>"></input>
                    </div>

                    <div class="form-group">
                        <label for="credit">Crédit :</label>
                            <select name="credit" class="form-cntrol" id="credit">
                                <option value="1" <?php if($credit=="1") echo "selected" ?>>1</option>
                                <option value="2" <?php if($credit=="2") echo "selected" ?>>2</option>
                                <option value="3" <?php if($credit=="3") echo "selected" ?>>3</option>
                                <option value="4" <?php if($credit=="4") echo "selected" ?>>4</option>
                                <option value="5" <?php if($credit=="5") echo "selected" ?>>5</option>
                                <option value="6" <?php if($credit=="6") echo "selected" ?>>6</option>
                                <option value="7" <?php if($credit=="7") echo "selected" ?>>7</option>
                                <option value="8" <?php if($credit=="8") echo "selected" ?>>8</option>
                                <option value="9" <?php if($credit=="9") echo "selected" ?>>9</option>
                                <option value="10" <?php if($credit=="10") echo "selected" ?>>10</option>
                            </select>
                    </div>
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-save"></span>
                        Enregister
                    </button>
                </form>
                </div>
                </div>
            </div>
    </body>
</HTML>
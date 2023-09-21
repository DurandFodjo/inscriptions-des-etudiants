<?php
     require_once("identifier.php");
    require_once('connexiondb.php');
    $idf=isset($_GET['idF'])?$_GET['idF']:0;
    $requete="select * from filiere where idFiliere=$idf";
    $resultat=$pdo->query($requete);
    $filiere=$resultat->fetch();
    $nomf=$filiere['nonFiliere'];
    $niveau=$filiere['niveau'];

?>

<!DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="UTF-8"> 
        <title>Edition d'une Filiere</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include("menu.php"); ?>

            <div class="container">    
        

                <div class="panel panel-primary margetop60">
                    <div class="panel-heading">Edition de la Filiere</div>
                <div class="panel-body">
                <form method="POST" action="updateFilieres.php" class="form">
                    
                <div class="form-group">
                        <label for="niveau">Id de la filiere: <?php echo $idf ?></label>
                        <input type="hidden" name="idF" class="form-control"
                                    value="<?php echo $idf ?>"></input>
                    </div>

                    <div class="form-group">
                        <label for="niveau">Nom de la filiere :</label>
                        <input type="text" name="nomF" placeholder="Entrer le nom de la filiere" class="form-control"
                                    value="<?php echo $nomf ?>"></input>
                    </div>

                    <div class="form-group">
                        <label for="niveau">Niveaux :</label>
                            <select name="niveau" class="form-cntrol" id="niveau">
                                <option value="BTS" <?php if($niveau=="b") echo "selected" ?>>BTS</option>
                                <option value="Licence" <?php if($niveau=="l") echo "selected" ?>>Licence</option>
                                <option value="Master" <?php if($niveau=="m") echo "selected" ?>>Master</option>
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
<?php
    require_once("identifier.php");
    require_once('connexiondb.php');
    $idE=isset($_GET['idE'])?$_GET['idE']:0;
    $requeteE="select * from etudiant where idEtudiant=$idE";
    $resultatE=$pdo->query($requeteE);
    $etudiant=$resultatE->fetch();
    $nom=$etudiant['nom'];
    $prenom=$etudiant['prenom'];
    $idFiliere=$etudiant['idFiliere'];
    $genre=$etudiant['genre'];
    $nomPhoto=$etudiant['photo'];

    $requeteF="select * from filiere";
    $resultatF=$pdo->query($requeteF);
?>

<!DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="UTF-8"> 
        <title>Edition d'un Etudiant</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include("menu.php"); ?>

            <div class="container">    
        

                <div class="panel panel-primary margetop60">
                    <div class="panel-heading">Edition de l'étudiant</div>
                <div class="panel-body">
                <form method="POST" action="updateEtudiants.php" class="form" enctype="multipart/form-data">
                    
                <div class="form-group">
                        <label for="idS">Id de l'étudiant: <?php echo $idE ?></label>
                        <input type="hidden" name="idE" class="form-control"
                                    value="<?php echo $idE ?>"></input>
                    </div>

                    <div class="form-group">
                        <label for="nom">Nom de l'étudiant :</label>
                        <input type="text" name="nom" placeholder="Entrer le nom de l'étudiant" class="form-control"
                                    value="<?php echo $nom ?>"></input>
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prenom de l'étudiant :</label>
                        <input type="text" name="prenom" placeholder="Entrer le prenom de l'étudiant" class="form-control"
                                    value="<?php echo $prenom ?>"></input>
                    </div>
                    <div class="form-group">
                        <label for="genre">Genre :</label>
                        <div class="radio">
                            <label><input type="radio" name="genre" value="F"
                                <?php if($genre==="F") echo "checked" ?>/> F </label><br>
                            <label><input type="radio" name="genre" value="M"
                                <?php if($genre==="M") echo "checked" ?>/> M </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="idFiliere">Filiere :</label>
                            <select name="idFiliere" class="form-cntrol" id="idFiliere">
                                <?php while($filiere=$resultatF->fetch()) { ?>
                                    <option value="<?php echo $filiere['idFiliere'] ?>"
                                            <?php if($idFiliere===$filiere['idFiliere']) echo "selected" ?>>
                                        <?php echo $filiere['nonFiliere'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                    </div>
                    <div class="form-group">
                        <label for="photo">Photo :</label>
                        <input type="file" name="photo"></input>
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
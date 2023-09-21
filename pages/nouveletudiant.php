<?php
 require_once("identifier.php");
    require_once('connexiondb.php');

    $requeteF="select * from filiere";
    $resultatF=$pdo->query($requeteF);
?>

<!DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="UTF-8"> 
        <title>Nouvel Etudiant</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include("menu.php"); ?>

            <div class="container">    
        

                <div class="panel panel-primary margetop60">
                    <div class="panel-heading">Les infos du Nouvel Etudiant</div>
                <div class="panel-body">
                <form method="POST" action="insertEtudiants.php" class="form" enctype="multipart/form-data">
                    

                    <div class="form-group">
                        <label for="nom">Nom de l'Etudiant :</label>
                        <input type="text" name="nom" placeholder="Entrer le nom de l'etudiant" class="form-control"></input>
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prenom de l'Etudiant :</label>
                        <input type="text" name="prenom" placeholder="Entrer le prenom de l'etudiant" class="form-control"></input>
                    </div>
                    <div class="form-group">
                        <label for="genre">Genre :</label>
                        <div class="radio">
                            <label><input type="radio" name="genre" value="F" checked/> F </label><br>
                            <label><input type="radio" name="genre" value="M"/> M </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="idFiliere">Filiere :</label>
                            <select name="idFiliere" class="form-cntrol" id="idFiliere">
                                <?php while($filiere=$resultatF->fetch()) { ?>
                                    <option value="<?php echo $filiere['idFiliere'] ?>">
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
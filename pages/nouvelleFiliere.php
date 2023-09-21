<?php
    require_once("identifier.php");
?>
<!DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="UTF-8"> 
        <title>Nouvelle Filiere</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include("menu.php"); ?>

            <div class="container">    
        

                <div class="panel panel-primary margetop60">
                    <div class="panel-heading">Veuilez saisir les données de la nouvelle Filiere</div>
                <div class="panel-body">
                <form method="POST" action="insertFilieres.php" class="form">

                    <div class="form-group">
                        <label for="niveau">Nom de la filiere :</label>
                        <input type="text" name="nomF" placeholder="Entrer le nom de la filiere" class="form-control"></input>
                    </div>

                    <div class="form-group">
                        <label for="niveau">Niveaux :</label>
                            <select name="niveau" class="form-cntrol" id="niveau">
                                <option value="BTS" selected>BTS</option>
                                <option value="Licence">Licence</option>
                                <option value="Master">Master</option>
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
<?php
    require_once("identifier.php");
?>
<!DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="UTF-8"> 
        <title>Nouvelle Matière</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include("menu.php"); ?>

            <div class="container">    
        

                <div class="panel panel-primary margetop60">
                    <div class="panel-heading">Veuilez saisir les données de la nouvelle Matière</div>
                <div class="panel-body">
                <form method="POST" action="insertMatieres.php" class="form">

                    <div class="form-group">
                        <label for="niveau">Nom de la matiere :</label>
                        <input type="text" name="nomM" placeholder="Entrer le nom de la matiere" class="form-control"></input>
                    </div>

                    <div class="form-group">
                        <label for="niveau">Crédit :</label>
                            <select name="credit" class="form-cntrol" id="credit">
                                <option value="1" selected>1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
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
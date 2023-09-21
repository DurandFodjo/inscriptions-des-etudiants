<?php
    require_once("connexiondb.php");
    require_once("identifier.php");
?>

<!DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="UTF-8"> 
        <title>Modifier le mot de passe</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
        <link rel="stylesheet" type="text/css" href="../css/oeil.css">
        <script src="../js/monjs.js"></script>
        <style>
            body{
                background-color: rgb(202, 211, 196);
            }
        </style>
    </head>
    <body>
        <div class="container col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3">    
            <div class="text-center panel panel-danger margetop">
                <div class="panel-heading">Modification du Mot de Passe :<?php echo $_SESSION['user']['login'] ?> </div>
                    <form method="POST" action="updatepwd.php" class="form">
                        <div class="form-group">
                            <label for="pwd">Ancien mot de passe:</label>&nbsp;
                            <input type="password" name="lastpwd" placeholder="Entrer votre Ancien mot de passe" class="form-control lastpwd"></input>
                            
                        </div>
                        <div class="form-group">
                            <label for="pwd">Nouveau Mot de passe :</label>&nbsp;
                            <input type="password" name="newpwd" placeholder="Entrer votre Nouveau mot de passe" class="form-control newpwd"></input>
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
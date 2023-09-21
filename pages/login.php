<?php
    session_start();
     if(isset($_SESSION['erreurLogin']))
        $erreurLogin=$_SESSION['erreurLogin'];
     else{
            $erreurLogin="";
     }
    session_destroy();
?>

<!DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="UTF-8"> 
        <title>Se connecter</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
        <link rel="stylesheet" type="text/css" href="../css/login.css">
    </head>
    <body>
    <div class="un">Bienvenue dans la plate forme de Gestion des Inscriptions des Etudiants</div>
            <div class="container col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3">    

                <div class="panel panel-danger margetop60">
                    <div class="panel-heading">Se connecter</div>
                <div class="panel-body">
                <form method="POST" action="seConnecter.php" class="form">  
                    <?php if(!empty($erreurLogin)) {?>
                        <div class="alert alert-danger">
                            <?php echo $erreurLogin ?>
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <label for="login">Login:</label>
                        <input type="text" name="login" placeholder="Entrer votre login" class="form-control"></input>
                    </div>
                    <div class="form-group">
                        <label for="pwd">Mot de passe :</label> 
                        <input type="password" name="pwd" placeholder="Entrer votre mot de passe" class="form-control"></input>
                    </div>
                    
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-log-in"></span>
                        Se Connecter
                    </button>
                    &nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp; <a class="a1" href="NouvelUtilisateur.php">Créer un compte</a>
                </form>
            </div>

    </body>
</HTML>
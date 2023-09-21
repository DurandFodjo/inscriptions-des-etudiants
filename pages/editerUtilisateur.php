<?php
     require_once("identifier.php");
    require_once('connexiondb.php');
    $idUser=isset($_GET['idUser'])?$_GET['idUser']:0;
    $login=isset($_GET['login'])?$_GET['login']:"";
    $email=isset($_GET['email'])?$_GET['email']:"";
    $role=isset($_GET['role'])?$_GET['role']:"";

    $requeteUser="select * from utilisateurs where idUser=$idUser";
    $resultatUser=$pdo->query($requeteUser);
    $user=$resultatUser->fetch();
    $login=$user['login'];
    $email=$user['email'];
    $role=$user['role'];

?>

<!DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="UTF-8"> 
        <title>Edition d'un Utilisateur</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include("menu.php"); ?>

            <div class="container">    
        

                <div class="panel panel-primary margetop60">
                    <div class="panel-heading">Edition de l'Utilisateur</div>
                <div class="panel-body">
                <form method="POST" action="updateUtilisateur.php" class="form">
                    
                <div class="form-group">
                        <label for="idUser">Id de l'utilisateur: <?php echo $idUser ?></label>
                        <input type="hidden" name="idUser" class="form-control"
                                    value="<?php echo $idUser ?>"></input>
                    </div>

                    <div class="form-group">
                        <label for="login">Login :</label>
                        <input type="text" name="login" placeholder="login" class="form-control"
                                    value="<?php echo $login ?>"></input>
                    </div>
                    <div class="form-group">
                        <label for="email">Email :</label>
                        <input type="email" name="email" placeholder="email" class="form-control"
                                    value="<?php echo $email ?>"></input>
                    </div>
                    <div class="form-group">
                        <label for="role">Statut :</label>
                        <select name="role" class="form-control">
                            <option value="ADMIN" <?php if($role=="ADMIN") echo "selected" ?>>Administrateur</option>
                            <option value="CHEF DEPARTEMENT" <?php if($role=="CHEF DEPARTEMENT") echo "selected" ?>>Chef département</option>
                            <option value="AGENT" <?php if($role=="AGENT") echo "selected" ?>>Agent</option>
                            <option value="VISITEUR" <?php if($role=="VISITEUR") echo "selected" ?>>Visiteur</option>
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
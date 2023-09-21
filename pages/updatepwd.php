<?php
    require_once("identifier.php");
    require_once('connexiondb.php');

    $idUser=$_SESSION['user']['idUser'];

    $lastpwd=isset($_POST['lastpwd'])?$_POST['lastpwd']:"";

    $newpwd=isset($_POST['newpwd'])?$_POST['newpwd']:"";

    $requete="select * from utilisateurs where idUser=$idUser and pwd=MD5('$lastpwd')";
    $resultat=$pdo->prepare($requete);
    $resultat->execute();
    $msg="";
    $interval=5;
    $url="login.php";
    if($resultat->fetch()){
        $requete="update utilisateurs set pwd=MD5(?) where idUser=?";
        $params=array($newpwd,$idUser);
        $resultat=$pdo->prepare($requete);
        $resultat->execute($params);
        $msg="<div class='alert alert-success'>
                <strong>Felicitation!!!</strong> Votre mot de passe a été modifié avec succes
              </div>";                                       
       
    }else{
        $msg="<div class='alert alert-danger'>
                <strong>Erreur!!!</strong> L'ancien mot de passe est incorrecte
              </div>";
        $url=$_SERVER['HTTP_REFERER'];
    }
   
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            Changement du mot de passe
        </title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
         <br><br>
            <?php
                echo $msg;
                header("refresh:$interval;url=$url");
            ?>
        </div>
    </body>
</html>
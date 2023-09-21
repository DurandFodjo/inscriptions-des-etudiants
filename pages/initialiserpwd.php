<?php 
    require_once('connexiondb.php');
    require_once("../fonctions/fonctions.php");

    if(isset($_POST['email'])){
        $email=$_POST['email'];
    }
    else{
        $email="";
    }
    
    $user= rechercher_par_email($email);
    if($user != null){
        $id= $user['idUser'];
        $requete=$pdo->prepare("update utilisateurs set pwd=MD5('0000') where idUser=$id");
        $requete->execute();

        $to=$email;

        $objet="Initialisation de mot de passe";

        $content="Votre nouveau mot de passe est 0000, veuilez le modifier à la prochaine ouverture de session";

        $entes="From : App Gestion stagiaires". "/n" . "CC: fodjodurand97@gmail.com";

        $mail($to,$objet,$content,$entes);
    }else{
        echo 'Email incorrect';
    }
?>

<!DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="UTF-8"> 
        <title>Initialisation du mot de passe</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
    <div class="container col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3">    

        <div class="panel panel-primary margetop60">
            <h1 class="text-center"> Initialiser votre mot de passe </h1>
            <div class="panel panel-primary">
        </div>
            <div class="form-group">
                <label for="email">Veuiller saisir votre email de recuperation :</label>
                    <input type="email" name="email" placeholder="Entrer votre email" class="form-control"></input>
            </div>
            <input type="submit" class="btn btn-primary" value="Initialiser le mot de passe">
    </div>
    </body>
</html>
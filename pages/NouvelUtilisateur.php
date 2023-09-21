<?php 
    require_once("connexiondb.php");
    require_once("../fonctions/fonctions.php");

    $msg="";
    $interval=15;
    $url="login.php";
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $login=$_POST['login'];
        $pwd1=$_POST['pwd1'];
        $pwd2=$_POST['pwd2'];
        $email=$_POST['email'];

        $validationErrors=array();

        if(isset($login)){
            $filtredLogin=filter_var($login, FILTER_SANITIZE_STRING);

            if(strlen($filtredLogin)<4){
                $validationErrors[]="Erreur!!! Le login doit contenir au moins 4 caractères";
            }
        }
        if(isset($pwd1) && isset($pwd2)){
            
            if(empty($pwd1)){
                $validationErrors[]="Erreur!!! Le mot de passe ne doit pas etre vide";
            }

            if(md5($pwd1)!==md5($pwd2)){
                $validationErrors[]="Erreur!!! Les deux mots de passe ne sont pas identiques";
            }
        }
        if(isset($email)){
            $filtredEmail=filter_var($login, FILTER_SANITIZE_EMAIL);

            if($filtredEmail != true){
                $validationErrors[]="Erreur!!! Email non valide";
            }
        }

        if(empty($validationErrors)){
            if(rechercher_par_login($login)==0 && rechercher_par_email($email)==0){
                $requete=$pdo->prepare("INSERT INTO utilisateurs(login,email,role,etat,pwd)
                    VALUES(:plogin,:pemail,:prole,:petat,:ppwd)");

                $requete->execute(array('plogin'=>$login,
                                'pemail'=>$email,
                                'prole'=>'VISITEUR',
                                'petat'=>0,
                                'ppwd'=>md5($pwd1)));
                    $msg="<div class='alert alert-success'>
                            <strong>Felicitation,!!!</strong> votre compte est crée, mais temporairement inactif jusqu'à activation par l'administrateur.
                            vous serez dirigé vers la page d'Authentification.
                        </div>";
                        echo $msg;
                        header("refresh:$interval;url=$url");
                            
                $success_msg="";
            }else{
                if(rechercher_par_login($login)>0){
                    $validationErrors[]='Désolé, le login existe déjà';
                }
                if(rechercher_par_email($email)>0){
                    $validationErrors[]='Désolé, cet email existe déjà';
                }
            }
        }
    }

?>

<!DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="UTF-8"> 
        <title>Nouvel Utilisateur</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
        <style>
            body{
                background-color: rosybrown;
            }
        </style>
    </head>
    <body>
        <div class="container col-md-6 col-md-offset-3">
            <h1 class="text-center"> Création d'un nouveau compte Utilisateur </h1>

            <form class="form" method="POST">
            <div class="input-container">
                <input type="text" 
                        required="required" 
                        minlength="4" 
                        title="Le login doit contenir au moins 4 caracteres..." 
                        name="login" 
                        placeholder="Taper votre nom d'utilisateur"
                        autocomplete="off"
                    class="form-control">
                </input>
            </div>
            <div class="input-container">
                <input type="password" 
                        required="required" 
                        minlength="3" 
                        title="Le mot de passe doit contenir au moins 3 caracteres..." 
                        name="pwd1" 
                        placeholder="Taper votre mot de passe"
                        autocomplete="new-password"
                    class="form-control">
                </input>
            </div>
            <div class="input-container">
                <input type="password" 
                        required="required" 
                        minlength="3" 
                        name="pwd2" 
                        placeholder="Retaper votre mot de passe pour confirmer"
                        autocomplete="new-password"
                    class="form-control">
                </input>
            </div>
            <div class="input-container">
                <input type="email" 
                        required="required" 
                        name="email" 
                        placeholder="Taper votre email"
                        autocomplete="off"
                    class="form-control">
                </input>
            <input type="submit" class="btn btn-primary" value="Enregister">
            </form>

<br>
            <?php 
                if(isset($validationErrors) && !empty($validationErrors)){
                    foreach ($validationErrors as $error){
                        echo '<div class="alert alert-danger">' .$error .'</div>';
                    }
                }
            ?>
        </div>
    </body>
</html>

<?php
    session_start();
    if(isset($_SESSION['user'])){
        require_once('connexiondb.php');
        $idE=isset($_GET['idE'])?$_GET['idE']:0;
        
            $requete="delete from etudiant where idEtudiant=?";
            $params=array($idE);
            $resultat=$pdo->prepare($requete);
            $resultat->execute($params);    
            header('location:etudiants.php');
    }else{
        header('location:login.php');
    }
?>
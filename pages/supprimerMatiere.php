<?php
    session_start();
    if(isset($_SESSION['user'])){
        require_once('connexiondb.php');
        $idM=isset($_GET['idM'])?$_GET['idM']:0;
        
            $requete="delete from matiere where idMatiere=?";
            $params=array($idM);
            $resultat=$pdo->prepare($requete);
            $resultat->execute($params);    
            header('location:matieres.php');
    }else{
        header('location:login.php');
    }
?>
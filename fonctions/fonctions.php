<?php 
    function rechercher_par_login($login){
        global $pdo;
        $requete=$pdo->prepare("select * from utilisateurs where login=?");
        $requete->execute(array($login));
        return $requete->rowCount();
    }

    function rechercher_par_email($email){
        global $pdo;
        $requete=$pdo->prepare("select * from utilisateurs where email=?");
        $requete->execute(array($email));
        return $requete->rowCount();
    }
?>
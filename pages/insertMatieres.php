<?php
    require_once("identifier.php");
    require_once('connexiondb.php');

    $nomf=isset($_POST['nomM'])?$_POST['nomM']:"";
    $credit=isset($_POST['credit'])?$_POST['credit']:"";

    $requete="insert into matiere(nomMatiere,creditMatiere) values(?,?)";
    $params=array($nomf,$credit);
    $resultat=$pdo->prepare($requete);
    $resultat->execute($params);

    header('location:matieres.php');
?>
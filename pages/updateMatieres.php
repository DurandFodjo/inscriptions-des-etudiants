<?php
    require_once("identifier.php");
    require_once('connexiondb.php');
    $idM=isset($_POST['idM'])?$_POST['idM']:0;
    $nomf=isset($_POST['nomM'])?$_POST['nomM']:"";
    $credit=isset($_POST['credit'])?$_POST['credit']:"";

    $requete="update matiere set nomMatiere=?,creditMatiere=? where idMatiere=?";
    $params=array($nomf,$credit,$idM);
    $resultat=$pdo->prepare($requete);
    $resultat->execute($params);

    header('location:matieres.php');
?>
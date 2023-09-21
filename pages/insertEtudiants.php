<?php
     require_once("identifier.php");
    require_once('connexiondb.php');
    $nom=isset($_POST['nom'])?$_POST['nom']:"";
    $prenom=isset($_POST['prenom'])?$_POST['prenom']:"";
    $idFiliere=isset($_POST['idFiliere'])?$_POST['idFiliere']:"";
    $genre=isset($_POST['genre'])?$_POST['genre']:1;

    $nomPhoto=isset($_FILES['photo']['name'])?$_FILES['photo']['name']:"";
    $imageTemp=$_FILES['photo']['tmp_name'];
    move_uploaded_file($imageTemp,"../images/".$nomPhoto);

    $requete="insert into etudiant(nom,prenom,genre,idFiliere,photo) values(?,?,?,?,?)";
    $params=array($nom,$prenom,$genre,$idFiliere,$nomPhoto);

    $resultat=$pdo->prepare($requete);
    $resultat->execute($params);

    header('location:etudiants.php');
    
?>
<?php
    require_once("identifier.php");
    require_once("connexiondb.php");
       
    $nomPrenom=isset($_GET['nomPrenom'])?$_GET['nomPrenom']:"";
    $idfiliere=isset($_GET['idfiliere'])?$_GET['idfiliere']:"all";

    $size=isset($_GET['size'])?$_GET['size']:3;
    $page=isset($_GET['page'])?$_GET['page']:1;
    $offset=($page-1)*$size;

        $requeteFiliere="select * from filiere";

    if($idfiliere==="all"){
        $requeteEtudiant="select idEtudiant,nom,prenom,nonFiliere,genre,photo from filiere as f,etudiant as e
            where f.idFiliere=e.idFiliere
            and (nom like '%$nomPrenom%' or prenom like '%$nomPrenom%')
            order by idEtudiant
            limit $size
            offset $offset";

        $requeteCount="select count(*) countE from etudiant
            where nom like '%$nomPrenom%' or prenom like '%$nomPrenom%'"; 
    }else{
        $requeteEtudiant="select idEtudiant,nom,prenom,nonFiliere,genre,photo from filiere as f,etudiant as e
            where f.idFiliere=e.idFiliere
            and (nom like '%$nomPrenom%' or prenom like '%$nomPrenom%')
            and f.idFiliere=$idfiliere
            order by idEtudiant
            limit $size
            offset $offset";

        $requeteCount="select count(*) countE from etudiant
            where (nom like '%$nomPrenom%' or prenom like '%$nomPrenom%')
            and idFiliere=$idfiliere"; 
    }
    $resultatFiliere=$pdo->query($requeteFiliere);
    $resultatEtudiant=$pdo->query($requeteEtudiant);
    $resultatCount=$pdo->query($requeteCount);
    $tabCount=$resultatCount->fetch();
    $nbrEtudiant=$tabCount['countE'];

    $reste=$nbrEtudiant % $size; 
        if($reste===0)
            $nbrPage=$nbrEtudiant/$size;
        else
            $nbrPage=floor($nbrEtudiant/$size)+1;

?>
<!DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="UTF-8"> 
        <title>Gestion des Etudiants</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
        <style>
            body{
                background-color: khaki;
            }
        </style>
    </head>
    <body>
        <?php  include("menu.php"); ?>

    <div class="container">    
        <div class="panel panel-info margetop60">
            <div class="panel-heading">Liste des Etudiants</div>
            <div class="panel-body">
                <form method="get" action="etudiants.php" class="form-inline">
                    <div class="form-group">
                        <input type="text" name="nomPrenom" placeholder="Entrer le nom et le prenom" class="form-control" value="<?php echo $nomPrenom ?>"></input>
                    </div>
                    <label for="idfiliere">Filiere :</label>
                    <select name="idfiliere" class="form-control" id="idfiliere">
                            <option value="all">Toutes les filieres</option>
                        <?php while ($filiere=$resultatFiliere->fetch()){ ?>
                            <option value="<?php echo $filiere['idFiliere'] ?>"
                                <?php if($filiere['idFiliere']===$idfiliere) echo "selected" ?>>
                                <?php echo $filiere['nonFiliere'] ?> 
                            </option>
                        <?php }  ?>
                    </select>
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-search"></span>
                        Chercher...
                    </button>
                    &nbsp &nbsp;
                    <?php if($_SESSION['user']['role'] !== 'VISITEUR') {?>
                    <a href="nouveletudiant.php">
                        <span class="glyphicon glyphicon-plus"></span>
                    Nouvel Etudiant</a>
                    <?php } ?>
                </form>
            </div>
        </div>

        <div class="panel panel-warning">
            <div class="panel-heading">Liste des Etudiants (<?php echo $nbrEtudiant ?> Etudiants) </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Id Etudiant</th><th>Nom</th><th>Prénom</th><th>Filiere</th><th>Genre</th><th>Photo</th>
                            <?php if($_SESSION['user']['role'] != 'VISITEUR') {?>
                            <th>Actions</th>
                            <?php }?>
                        </tr>
                    </thead>

                    <body> 
                            <?php while($etudiant=$resultatEtudiant->fetch()){?>
                                <tr>
                                    <td><?php echo $etudiant['idEtudiant'] ?></td>
                                    <td><?php echo $etudiant['nom'] ?></td>
                                    <td><?php echo $etudiant['prenom'] ?></td>
                                    <td><?php echo $etudiant['nonFiliere'] ?></td>
                                    <td><?php echo $etudiant['genre'] ?></td>
                                    <td>
                                        <img src="../images/<?php echo $etudiant['photo'] ?>"
                                        width="70px" height="70px" class="img-circle">
                                    </td>
                                    <?php if($_SESSION['user']['role'] != 'VISITEUR') {?>
                                        <td>
                                            <a href="editerEtudiant.php?idE=<?php echo $etudiant['idEtudiant'] ?>">
                                                <span class="glyphicon glyphicon-edit"></span>
                                            </a>
                                            &nbsp;
                                            <a onclick="return confirm('Etes vous sure de vouloir supprimer l etudiant ?')" 
                                                href="supprimerEtudiant.php?idE=<?php echo $etudiant['idEtudiant'] ?>">
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </a>
                                        </td>
                                    <?php }?>
                                </tr>
                            <?php } ?>    
                    </body>
                </table>
                <div>
                    <ul class="pagination">
                        <?php for($i=1;$i<=$nbrPage;$i++){ ?>
                            <li class="<?php if($i==$page) echo 'active' ?>"><a href="etudiants.php?page=<?php echo $i;?>&nomPrenom=<?php echo $nomPrenom ?>&idfiliere=<?php echo $idfiliere ?>">
                                <?php echo $i; ?></a>
                            </li>
                        <?php } ?>
                    <ul>
                </div>
            </div>
        </div>
    </div>
    <?php include("pied.php"); ?>
    </body>
</HTML>
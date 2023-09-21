<?php
    require_once("identifier.php");
    require_once("connexiondb.php");

    /*
    if (isset($_GET['nomF']))
        $nomf=$_GET['nomF'];
    else
        $nomf="";
    */
       
    $nomf=isset($_GET['nomM'])?$_GET['nomM']:"";
    $credit=isset($_GET['credit'])?$_GET['credit']:"";

    $size=isset($_GET['size'])?$_GET['size']:5;
    $page=isset($_GET['page'])?$_GET['page']:1;
    $offset=($page-1)*$size;

        $requete="select * from matiere
            where nomMatiere like '%$nomf%'
            order by idMatiere
            limit $size
            offset $offset";
        $requeteCount="select count(*) countM from matiere
            where nomMatiere like '%$nomf%'"; 

    $resultatM=$pdo->query($requete);

    $resultatCount=$pdo->query($requeteCount);
    $tabCount=$resultatCount->fetch();
    $nbrMatieres=$tabCount['countM'];

    $reste=$nbrMatieres % $size;   // %: reste de la division entiere de nbrFiliere par size 
        if($reste===0)
            $nbrPage=$nbrMatieres/$size;
        else
            $nbrPage=floor($nbrMatieres/$size)+1;
?>
<!DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="UTF-8"> 
        <title>Liste des matières</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include("menu.php"); ?>

    <div class="container">    
        <div class="panel panel-success margetop60">
            <div class="panel-heading">Liste des Unités d'enseignement <?php echo $nomf ?></div>
            <div class="panel-body">
                <form method="get" action="matieres.php" class="form-inline">
                    <div class="form-group">
                        <input type="text" name="nomM" placeholder="Taper le nom de la matiere" class="form-control" value="<?php echo $nomf ?>"></input>
                    </div>
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-search"></span>
                        Chercher...
                    </button>
                    &nbsp &nbsp;
                        <a href="touteslesmatieres.php">
                            <span class="glyphicon glyphicon-plus"></span>
                        Ajouter une Unité</a>
                </form>
            </div>
        </div>

        <div class="panel panel-primary">
            <div class="panel-heading">Liste des Unités d'enseignement (<?php echo $nbrMatieres ?> Unités) </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Id Matière</th><th>Nom Matière</th><th>Crédit</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <body> 
                        <?php while($matiere=$resultatM->fetch()){?>
                                <tr>
                                    <td><?php echo $matiere['idMatiere'] ?></td>
                                    <td><?php echo $matiere['nomMatiere'] ?></td>
                                    <td><?php echo $matiere['creditMatiere'] ?></td>
                                        <td>
                                            &nbsp;
                                            <a onclick="return confirm('Etes vous sure de vouloir supprimer la matiere ?')" 
                                                href="supprimerMatiere2.php?idM=<?php echo $matiere['idMatiere'] ?>">
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </a>
                                        </td>
                                </tr>
                            <?php } ?>    
                    </body>
                </table>
                <div>
                    <ul class="pagination">
                        <?php for($i=1;$i<=$nbrPage;$i++){ ?>
                            <li class="<?php if($i==$page) echo 'active' ?>"><a href="matieres.php?page=<?php echo $i;?>&nomM=<?php echo $nomf ?>&credit=<?php echo $credit ?>">
                                <?php echo $i; ?></a>
                            </li>
                        <?php } ?>
                    <ul>
                </div>
            </div>
        </div>
    </div>
    </body>
</HTML>
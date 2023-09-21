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
        <title>Gestion des matières</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
        <style>
            body{
                background-color: rgb(5, 250, 209);
            }
        </style>
    </head>
    <body>
        <?php include("menu.php"); ?>

    <div class="container">    
        <div class="panel panel-info margetop60">
            <div class="panel-heading">Liste des matières</div>
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
                    <?php if($_SESSION['user']['role'] == 'ADMIN' or $_SESSION['user']['role'] == 'CHEF DEPARTEMENT') {?>
                        <a href="nouvelleMatiere.php">
                            <span class="glyphicon glyphicon-plus"></span>
                        Nouvelle Matière</a>
                    <?php } ?>
                </form>
            </div>
        </div>

        <div class="panel panel-warning">
            <div class="panel-heading">Liste des matières (<?php echo $nbrMatieres ?> Matières) </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Id Matière</th><th>Nom Matière</th><th>Crédit</th>
                            <?php if($_SESSION['user']['role'] == 'ADMIN' or $_SESSION['user']['role'] == 'CHEF DEPARTEMENT') {?>
                            <th>Actions</th>
                            <?php }?>
                        </tr>
                    </thead>

                    <body> 
                            <?php while($matiere=$resultatM->fetch()){?>
                                <tr>
                                    <td><?php echo $matiere['idMatiere'] ?></td>
                                    <td><?php echo $matiere['nomMatiere'] ?></td>
                                    <td><?php echo $matiere['creditMatiere'] ?></td>
                                    <?php if($_SESSION['user']['role'] == 'ADMIN' or $_SESSION['user']['role'] == 'CHEF DEPARTEMENT') {?>
                                        <td>
                                            <a href="editerMatiere.php?idM=<?php echo $matiere['idMatiere'] ?>">
                                                <span class="glyphicon glyphicon-edit"></span>
                                            </a>
                                            &nbsp;
                                            <a onclick="return confirm('Etes vous sure de vouloir supprimer la matiere ?')" 
                                                href="supprimerMatiere.php?idM=<?php echo $matiere['idMatiere'] ?>">
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
                            <li class="<?php if($i==$page) echo 'active' ?>"><a href="matieres.php?page=<?php echo $i;?>&nomM=<?php echo $nomf ?>&credit=<?php echo $credit ?>">
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
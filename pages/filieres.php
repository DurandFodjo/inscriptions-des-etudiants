<?php
    require_once("identifier.php");
    require_once("connexiondb.php");

    /*
    if (isset($_GET['nomF']))
        $nomf=$_GET['nomF'];
    else
        $nomf="";
    */
       
    $nomf=isset($_GET['nomF'])?$_GET['nomF']:"";
    $niveau=isset($_GET['niveau'])?$_GET['niveau']:"all";

    $size=isset($_GET['size'])?$_GET['size']:6;
    $page=isset($_GET['page'])?$_GET['page']:1;
    $offset=($page-1)*$size;

    if($niveau=="all"){
        $requete="select * from filiere
            where nonFiliere like '%$nomf%'
            order by idFiliere
            limit $size
            offset $offset";
        $requeteCount="select count(*) countF from filiere
            where nonFiliere like '%$nomf%'"; 
    }else{
        $requete="select * from filiere
            where nonFiliere like '%$nomf%'
            and niveau like '%$niveau%'
            order by idFiliere
            limit $size
            offset $offset";
        $requeteCount="select count(*) countF from filiere
            where nonFiliere like '%$nomf%'
            and niveau like '%$niveau%'";
    }
    $resultatF=$pdo->query($requete);

    $resultatCount=$pdo->query($requeteCount);
    $tabCount=$resultatCount->fetch();
    $nbrFiliere=$tabCount['countF'];

    $reste=$nbrFiliere % $size;   // %: reste de la division entiere de nbrFiliere par size 
        if($reste===0)
            $nbrPage=$nbrFiliere/$size;
        else
            $nbrPage=floor($nbrFiliere/$size)+1;
?>
<!DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="UTF-8"> 
        <title>Gestion des filieres</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
        <style>
            body{
                background-color: sandybrown;
            }
        </style>
    </head>
    <body>
        <?php include("menu.php"); ?>

    <div class="container">    
        <div class="panel panel-info margetop60">
            <div class="panel-heading">Liste des filieres</div>
            <div class="panel-body">
                <form method="get" action="filieres.php" class="form-inline">
                    <div class="form-group">
                        <input type="text" name="nomF" placeholder="Taper le nom de la filiere" class="form-control" value="<?php echo $nomf ?>"></input>
                    </div>
                    <label for="niveau">Niveaux :</label>
                    <select name="niveau" class="form-cntrol" id="niveau">
                        <option value="all" <?php if($niveau==="all") echo "selected" ?>>Tous les niveaux</option>
                        <option value="b"   <?php if($niveau==="b") echo "selected" ?>>BTS</option>
                        <option value="l"   <?php if($niveau==="l") echo "selected" ?>>Licence</option>
                        <option value="m"   <?php if($niveau==="m") echo "selected" ?>>Master</option>
                    </select>
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-search"></span>
                        Chercher...
                    </button>
                    &nbsp &nbsp;
                    <?php if($_SESSION['user']['role'] == 'ADMIN' or $_SESSION['user']['role'] == 'CHEF DEPARTEMENT') {?>
                        <a href="nouvelleFiliere.php">
                            <span class="glyphicon glyphicon-plus"></span>
                        Nouvelle Filiere</a>
                    <?php } ?>
                </form>
            </div>
        </div>

        <div class="panel panel-warning">
            <div class="panel-heading">Liste des filieres (<?php echo $nbrFiliere ?> Filieres) </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Id Filiere</th><th>Nom Filiere</th><th>Niveau</th>
                            <?php if($_SESSION['user']['role'] == 'ADMIN' or $_SESSION['user']['role'] == 'CHEF DEPARTEMENT') {?>
                            <th>Actions</th>
                            <?php }?>
                        </tr>
                    </thead>

                    <body> 
                            <?php while($filiere=$resultatF->fetch()){?>
                                <tr>
                                    <td><?php echo $filiere['idFiliere'] ?></td>
                                    <td><?php echo $filiere['nonFiliere'] ?></td>
                                    <td><?php echo $filiere['niveau'] ?></td>
                                    <?php if($_SESSION['user']['role'] == 'ADMIN' or $_SESSION['user']['role'] == 'CHEF DEPARTEMENT') {?>
                                        <td>
                                            <a href="editerFiliere.php?idF=<?php echo $filiere['idFiliere'] ?>">
                                                <span class="glyphicon glyphicon-edit"></span>
                                            </a>
                                            &nbsp;
                                            <a onclick="return confirm('Etes vous sure de vouloir supprimer la filiere ?')" 
                                                href="supprimerFiliere.php?idF=<?php echo $filiere['idFiliere'] ?>">
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
                            <li class="<?php if($i==$page) echo 'active' ?>"><a href="filieres.php?page=<?php echo $i;?>&nomF=<?php echo $nomf ?>&niveau=<?php echo $niveau ?>">
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
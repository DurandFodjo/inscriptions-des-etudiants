<?php
    require_once("identifier.php");
    require_once("connexiondb.php");
       
    $login=isset($_GET['login'])?$_GET['login']:"";

    $size=isset($_GET['size'])?$_GET['size']:4;
    $page=isset($_GET['page'])?$_GET['page']:1;
    $offset=($page-1)*$size;

        $requeteUser="select * from utilisateurs where login like '%$login%'";
        $requeteCount="select count(*) countUser from utilisateurs"; 

    $resultatUser=$pdo->query($requeteUser);
    $resultatCount=$pdo->query($requeteCount);
    $tabCount=$resultatCount->fetch();
    $nbrUser=$tabCount['countUser'];

    $reste=$nbrUser % $size; 
        if($reste===0)
            $nbrPage=$nbrUser/$size;
        else
            $nbrPage=floor($nbrUser/$size)+1;
?>
<!DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="UTF-8"> 
        <title>Gestion des Utilisateurs</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
        <style>
            body{
                background-color: sandybrown;
            }
        </style>
    </head>
    <body>
        <?php  include("menu.php"); ?>

    <div class="container">    
        <div class="panel panel-info margetop60">
            <div class="panel-heading">Liste des Utilisateurs</div>
            <div class="panel-body">
                <form method="get" action="utilisateurs.php" class="form-inline">
                    <div class="form-group">
                        <input type="text" name="login" placeholder="Entrer votre login" class="form-control" value="<?php echo $login ?>"></input>
                    </div>
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-search"></span>
                        Chercher...
                    </button>
                </form>
            </div>
        </div>

        <div class="panel panel-warning">
            <div class="panel-heading">Liste des Utilisateurs (<?php echo $nbrUser ?> Utilisateurs) </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Login</th><th>Email</th><th>Role</th><th>Actions</th>
                        </tr>
                    </thead>

                    <body> 
                            <?php while($user=$resultatUser->fetch()){?>
                                <tr class="<?php echo $user['etat']==1?'success':'danger' ?>">
                                    <td><?php echo $user['login'] ?></td>
                                    <td><?php echo $user['email'] ?></td>
                                    <td><?php echo $user['role'] ?></td>
                                    <td>
                                        <a href="editerUtilisateur.php?idUser=<?php echo $user['idUser'] ?>">
                                            <span class="glyphicon glyphicon-edit"></span>
                                        </a>
                                        &nbsp;&nbsp;
                                        <a onclick="return confirm('Etes vous sure de vouloir supprimer cet utilisateur ?')" 
                                            href="supprimerUtilisateur.php?idUser=<?php echo $user['idUser'] ?>">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </a>
                                        &nbsp;&nbsp;
                                        <a href="activerUtilisateur.php?idUser=<?php echo $user['idUser'] ?>&etat=<?php echo $user['etat'] ?>">
                                            <?php
                                                if($user['etat']==1)
                                                    echo '<span class="glyphicon glyphicon-ok"></span>';
                                                else
                                                    echo '<span class="glyphicon glyphicon-remove"></span>';
                                            ?>
                                        </a>        
                                    </td>
                                </tr>
                            <?php } ?>    
                    </body>
                </table>
            </div>
        </div>
    </div>
    <?php include("pied.php"); ?>
    </body>
</HTML>
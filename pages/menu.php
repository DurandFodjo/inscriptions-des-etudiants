<?php
    require_once("identifier.php");
?>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid"> 
        <div class="navbar-header">
            <a href="" class="navbar-brand"><i class="glyphicon glyphicon-home"></i>&nbsp Gestion des Inscriptions des Etudiants</a>
        </div>   
        &nbsp &nbsp &nbsp &nbsp &nbsp;
        <ul class="nav navbar-nav">
                <li><a href="etudiants.php"><i class="glyphicon glyphicon-education"></i>&nbsp Les Etudiants</a></li>
                <li><a href="filieres.php"><i class="glyphicon glyphicon-briefcase"></i>&nbsp Les Filieres</a></li>
                <li><a href="matieres.php"><i class="glyphicon glyphicon-folder-close"></i>&nbsp Les Matieres</a></li>
            <?php if($_SESSION['user']['role']=='ADMIN') {?>
                <li><a href="utilisateurs.php"><i class="glyphicon glyphicon-user"></i>&nbsp Les Utilisateurs</a></li>
            <?php }?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="modifierPwd.php"><i class="glyphicon glyphicon-user"></i><?php echo ' '.$_SESSION['user']['login'] ?></a></li>
            <li><a href="seDeconnecter.php"><i class="glyphicon glyphicon-log-out"></i>&nbsp Se deconnecter</a></li>
        </ul>
    </div>
</nav>


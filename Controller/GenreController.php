<?php 

$action=$_GET['action'];

switch($action) {

    case 'list' :
        $lesGenres=Genre::findAll();
        include("Template/listeGenres.php");
        break;
    
    case 'add' :
        $action="Ajouter";
        include("Template/formGenre.php");
        break;

    case 'update' :
        $action="Modifier";
        $leGenre= Genre::findId($_GET['num']);
        include("Template/formGenre.php");
        break;

    case 'delete' :
            $leGenre=Genre::findId($_GET['num']);
            $nb=Genre::delete($leGenre);
            if($nb == 1) {
                $_SESSION['message']=["success"=>"Le genre a bien été supprimé"];
            }else{
                $_SESSION['message']=["danger"=>"Le genre n'a pas été supprimé"];
            }
            echo '<script language="Javascript">
    //        <!--
    //              document.location.replace("index.php?uc=genres&action=list");
    //        // -->
    //  </script>';
            header('location: index.php?uc=genres&action=list');
            exit();
        break;
    
    case 'validerForm' :
        $genre=new Genre();

        if(empty($_POST['num'])){ // cas d'une création
            $genre->setLibelle($_POST['libelle']);
            $nb= Genre::add($genre);
            $message="ajouté";
        }else{ // cas d'une modification
            $genre->setNum($_POST['num']);
            $genre->setLibelle($_POST['libelle']);
            $nb=Genre::update($genre);
            $message="modifié";
        }

        if($nb == 1) {
            $_SESSION['message']=["success"=>"Le genre a bien été $message"];
        }else{
            $_SESSION['message']=["danger"=>"Le genre n'a pas été $message"];
        }
        header('location: index.php?uc=genres&action=list');
        exit();
        break;

}
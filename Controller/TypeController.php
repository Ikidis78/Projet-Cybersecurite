<?php 

$action=$_GET['action'];

switch($action) {

    case 'list' :
        $lesTypes=Type::findAll();
        include("Template/listeTypes.php");
        break;
    
    case 'add' :
        $action="Ajouter";
        include("Template/formType.php");
        break;

    case 'update' :
        $action="Modifier";
        $leType= Type::findId($_GET['num']);
        include("Template/formType.php");
        break;

    case 'delete' :
            $leType=Type::findId($_GET['num']);
            $nb=Type::delete($leType);
            if($nb == 1) {
                $_SESSION['message']=["success"=>"Le type a bien été supprimé"];
            }else{
                $_SESSION['message']=["danger"=>"Le type n'a pas été supprimé"];
            }
            echo '<script language="Javascript">
    //        <!--
    //              document.location.replace("index.php?uc=types&action=list");
    //        // -->
    //  </script>';
            header('location: index.php?uc=types&action=list');
            exit();
        break;
    
    case 'validerForm' :
        $type=new Type();

        if(empty($_POST['num'])){ // cas d'une création
            $type->setLibelle($_POST['libelle']);
            $nb= Type::add($type);
            $message="ajouté";
        }else{ // cas d'une modification
            $type->setNum($_POST['num']);
            $type->setLibelle($_POST['libelle']);
            $nb=Type::update($type);
            $message="modifié";
        }

        if($nb == 1) {
            $_SESSION['message']=["success"=>"Le type a bien été $message"];
        }else{
            $_SESSION['message']=["danger"=>"Le type n'a pas été $message"];
        }
        header('location: index.php?uc=types&action=list');
        exit();
        break;

}
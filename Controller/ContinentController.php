<?php 
$action=$_GET['action'];
switch($action) {

    case 'list' :
        $lesContinents=Continent::findAll();
        include("Template/listeContinents.php");
        break;
    
    case 'add' :
        $action="Ajouter";
        include("Template/formContinent.php");
        break;

    case 'update' :
        $action="Modifier";
        $leContinent= Continent::findId($_GET['num']);
        include("Template/formContinent.php");
        break;

    case 'delete' :
            $leContinent=Continent::findId($_GET['num']);
            $nb=Continent::delete($leContinent);
            if($nb == 1) {
                $_SESSION['message']=["success"=>"Le continent a bien été supprimé"];
            }else{
                $_SESSION['message']=["danger"=>"Le continent n'a pas été supprimé"];
            }
            header('location: index.php?uc=continents&action=list');
            exit();
        break;
    
    case 'validerForm' :
        $continent=new Continent();

        if(empty($_POST['num'])){ // cas d'une création
            $continent->setLibelle($_POST['libelle']);
            $nb= Continent::add($continent);
            $message="ajouté";
        }else{ // cas d'une modification
            $continent->setNum($_POST['num']);
            $continent->setLibelle($_POST['libelle']);
            $nb=Continent::update($continent);
            $message="modifié";
        }

        if($nb == 1) {
            $_SESSION['message']=["success"=>"Le continent a bien été $message"];
        }else{
            $_SESSION['message']=["danger"=>"Le continent n'a pas été $message"];
        }
        header('location: index.php?uc=continents&action=list');
        exit();
        break;

}
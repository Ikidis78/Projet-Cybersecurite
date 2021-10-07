<?php 

$action=$_GET['action'];

switch($action) {

    case 'list' :
        // traitement des données du formulaire de recherche
        $libelle="";
        $continentSel="Tous";
        // construction de la requête
        if(!empty($_POST['libelle']) || !empty($_POST['continent'] )){
            $libelle=$_POST['libelle'];
            $continentSel=$_POST['continent'];
        }
        // recherche la liste des continents pour la liste déroulante
        $lesContinents=Continent::findAll();
        // on recherche les nationalités
        $lesNationalites=Nationalite::findAll($libelle,$continentSel);
        include("Template/listeNationalites.php");
        break;
    
    case 'add' :
        $action="Ajouter";
        $lesContinents=Continent::findAll();// on prépare la liste des continents
        include("Template/formNationalite.php");
        break;

    case 'update' :
        $action="Modifier";
        $lesContinents=Continent::findAll();// on prépare la liste des continents
        $laNationalite= Nationalite::findId($_GET['num']);
        include("Template/formNationalite.php");
        break;

    case 'delete' :
            $laNationalite=Nationalite::findId($_GET['num']);
            $nb=Nationalite::delete($laNationalite);
            if($nb == 1) {
                $_SESSION['message']=["success"=>"La nationalité a bien été supprimé"];
            }else{
                $_SESSION['message']=["danger"=>"La nationalité n'a pas été supprimé"];
            }
            header('location: index.php?uc=nationalites&action=list');
            exit();
        break;
    
    case 'validerForm' :
        $nationalite=new Nationalite();
        $continent= Continent::findId($_POST['continent']); // on recupère l'objet continent

        if(empty($_POST['num'])){ // cas d'une création
            $nationalite->setLibelle($_POST['libelle']);
            $nationalite->setContinent($continent);
            $nb= Nationalite::add($nationalite);
            $message="ajouté";
        }else{ // cas d'une modification
            $nationalite->setNum($_POST['num']);
            $nationalite->setLibelle($_POST['libelle']);
            $nationalite->setContinent($continent);
            $nb=Nationalite::update($nationalite);
            $message="modifié";
        }

        if($nb == 1) {
            $_SESSION['message']=["success"=>"La nationalité a bien été $message"];
        }else{
            $_SESSION['message']=["danger"=>"La nationalité n'a pas été $message"];
        }
        header('location: index.php?uc=nationalites&action=list');
        exit();
        break;

}
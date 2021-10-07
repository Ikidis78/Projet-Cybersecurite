<?php 

$action=$_GET['action'];

switch($action) {

    case 'list' :
        // traitement des données du formulaire de recherche
        $nom="";
        $prenom="";
        $nationaliteSel="Toutes";
        // construction de la requête
        if(!empty($_POST['nom']) || !empty($_POST['prenom']) || !empty($_POST['nationalite'] )){
            $nom=$_POST['nom'];
            $prenom=$_POST['prenom'];
            $nationaliteSel=$_POST['nationalite'];
        }
        // recherche la liste des nationalités pour la liste déroulante
        $lesNationalites=Nationalite::findAll();
        // on recherche les nationalités
        $lesAuteurs=Auteur::findAll($nom,$prenom,$nationaliteSel);
        include("Template/listeAuteurs.php");
        break;
    
    case 'add' :
        $action="Ajouter";
        $lesNationalites=Nationalite::findAll();// on prépare la liste des nationalités
        include("Template/formAuteur.php");
        break;

    case 'update' :
        $action="Modifier";
        $lesNationalites=Nationalite::findAll();// on prépare la liste des nationalités
        $leAuteur= Auteur::findId($_GET['num']);
        include("Template/formAuteur.php");
        break;

    case 'delete' :
            $leAuteur=Auteur::findId($_GET['num']);
            $nb=Auteur::delete($leAuteur);
            if($nb == 1) {
                $_SESSION['message']=["success"=>"L'auteur a bien été supprimé"];
            }else{
                $_SESSION['message']=["danger"=>"L'auteur n'a pas été supprimé"];
            }
            header('location: index.php?uc=auteurs&action=list');
            exit();
        break;
    
    case 'validerForm' :
        $auteur=new Auteur();
        $nationalite= Nationalite::findId($_POST['nationalite']); // on recupère l'objet continent

        if(empty($_POST['num'])){ // cas d'une création
            $auteur->setNom($_POST['nom']);
            $auteur->setPrenom($_POST['prenom']);
            $auteur->setNationalite($nationalite);
            $nb= Auteur::add($auteur);
            $message="ajouté";
        }else{ // cas d'une modification
            $auteur->setNum($_POST['num']);
            $auteur->setNom($_POST['nom']);
            $auteur->setPrenom($_POST['prenom']);
            $auteur->setNationalite($nationalite);
            $nb=Auteur::update($auteur);
            $message="modifié";
        }

        if($nb == 1) {
            $_SESSION['message']=["success"=>"L'auteur a bien été $message"];
        }else{
            $_SESSION['message']=["danger"=>"L'auteur n'a pas été $message"];
        }
        header('location: index.php?uc=auteurs&action=list');
        exit();
        break;

}
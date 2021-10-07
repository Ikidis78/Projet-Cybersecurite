<?php 

$action=$_GET['action'];

switch($action) {

    case 'list' :
        // traitement des données du formulaire de recherche
        $titre="";
        $auteurSel="Tous";
        $genreSel="Tous";
        $typeSel="Tous";
        // construction de la requête
        if(!empty($_POST['titre']) || !empty($_POST['auteur']) || !empty($_POST['genre'] ) || !empty($_POST['type'] )){
            $titre=$_POST['titre'];
            $auteurSel=$_POST['auteur'];
            $genreSel=$_POST['genre'];
            $typeSel=$_POST['type'];
        }
        // recherche la liste des auteurs pour la liste déroulante
        $lesAuteurs=Auteur::findAll();
        // recherche la liste des genres pour la liste déroulante
        $lesGenres=Genre::findAll();
        // recherche la liste des types pour la liste déroulante
        $lesTypes=Type::findAll();
        
        // on recherche les livres
        $lesLivres=Livre::findAll($titre,$auteurSel,$genreSel,$typeSel);
        include("Template/listeLivres.php");
        break;
    
    case 'add' :
        $action="Ajouter";
        // recherche la liste des auteurs pour la liste déroulante
        $lesAuteurs=Auteur::findAll();
        // recherche la liste des genres pour la liste déroulante
        $lesGenres=Genre::findAll();
        // recherche la liste des types pour la liste déroulante
        $lesTypes=Type::findAll();
        include("Template/formLivre.php");
        break;

    case 'update' :
        $action="Modifier";
        // recherche la liste des auteurs pour la liste déroulante
        $lesAuteurs=Auteur::findAll();
        // recherche la liste des genres pour la liste déroulante
        $lesGenres=Genre::findAll();
        // recherche la liste des types pour la liste déroulante
        $lesTypes=Type::findAll();
        $leLivre= Livre::findId($_GET['num']);
        include("Template/formLivre.php");
        break;

    case 'delete' :
            $leLivre=Livre::findId($_GET['num']);
            $nb=Livre::delete($leLivre);
            if($nb == 1) {
                $_SESSION['message']=["success"=>"Le livre a bien été supprimé"];
            }else{
                $_SESSION['message']=["danger"=>"Le livre n'a pas été supprimé"];
            }
            header('location: index.php?uc=livres&action=list');
            exit();
        break;
    
    case 'validerForm' :
        $livre=new Livre();
        $auteur= Auteur::findId($_POST['auteur']); // on recupère l'objet auteur
        $genre= Genre::findId($_POST['genre']); // on recupère l'objet genre
        $type= Type::findId($_POST['type']); // on recupère l'objet type

        if(empty($_POST['num'])){ // cas d'une création
            $livre->setIsbn($_POST['isbn']);        
            $livre->setTitre($_POST['titre']);        
            $livre->setPrix($_POST['prix']);        
            $livre->setEditeur($_POST['editeur']);        
            $livre->setAnnee($_POST['annee']);        
            $livre->setLangue($_POST['langue']);  
            $livre->setAuteur($auteur);
            $livre->setGenre($genre);
            $livre->setType($type);

            $nb= Livre::add($livre);
            $message="ajouté";

        }else{ // cas d'une modification
            $livre->setNum($_POST['num']);        
            $livre->setIsbn($_POST['isbn']);        
            $livre->setTitre($_POST['titre']);        
            $livre->setPrix($_POST['prix']);        
            $livre->setEditeur($_POST['editeur']);        
            $livre->setAnnee($_POST['annee']);        
            $livre->setLangue($_POST['langue']);  
            $livre->setAuteur($auteur);
            $livre->setGenre($genre);
            $livre->setType($type);

            $nb=Livre::update($livre);
            $message="modifié";
        }

        if($nb == 1) {
            $_SESSION['message']=["success"=>"Le livre a bien été $message"];
        }else{
            $_SESSION['message']=["danger"=>"Le livre n'a pas été $message"];
        }
        header('location: index.php?uc=livres&action=list');
        exit();
        break;

}
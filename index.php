<?php ob_start();
session_start(); 
include("Entity/monPdo.php");
require_once("Entity/Continent.php");
require_once("Entity/Nationalite.php");
require_once("Entity/Genre.php");
require_once("Entity/Type.php");
require_once("Entity/Auteur.php");
require_once("Entity/Livre.php");
include("Template/header.php");
include("Template/messagesFlash.php");
$uc= empty($_GET['uc']) ? "accueil" : $_GET['uc'] ;
switch($uc) {
    case 'accueil' :
        include("Template/accueil.php");
        break;
    case 'genres' :
        include("Controller/GenreController.php");
        break;
    case 'nationalites' :
        include("Controller/NationnaliteController.php");
        break;
    case 'continents' :
        include("Controller/ContinentController.php");
        break;
    case 'auteurs' :
        include("Controller/AuteurController.php");
        break;
    case 'livres' :
        include("Controller/LivreController.php");
        break;
        case 'types' :
        include("Controller/TypeController.php");
        break;
}
include("Template/footer.php");
?>
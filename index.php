<?php
require_once __DIR__.'\controleur\GestionRestaurants.php';

// Instantiation du contrôleur
$gestionRestaurants = new GestionRestaurants(__DIR__ . '/data/xml/donnéesRestaurants.xml');

// Définir l'action à partir de la requête GET ou POST
$action = isset($_GET['action']) ? $_GET['action'] : (isset($_POST['action']) ? $_POST['action'] : 'list');

switch ($action) {
    case 'list':
        $gestionRestaurants->afficherTousLesRestaurants();
        break;

    case 'add':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $coordonnees = $_POST['coordonnees'];
            $nom = $_POST['nom'];
            $adresse = $_POST['adresse'];
            $restaurateur = $_POST['restaurateur'];
            $liste = $_POST['description_liste'];
            $paragraphe = $_POST['description_paragraphe'];
            $important = $_POST['description_important'];
            $imageUrl = $_POST['image_url'];
            $imagePosition = $_POST['image_position'];

            $image = new Image($imageUrl, $imagePosition);
            $descriptionRestaurant = new DescriptionRestaurant($liste, $paragraphe, $important, $image);
            $carte = [];
            $menus = [];

            $restaurant = new Restaurant($coordonnees, $nom, $adresse, $restaurateur, $descriptionRestaurant, $carte, $menus);
            $gestionRestaurants->ajouterRestaurant($restaurant);

            header('Location: gestionRestaurant.php?action=list');
        } else {
            require_once dirname(__DIR__) . '/vue/ajouterRestaurant.php';
        }
        break;

    case 'edit':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nomOriginal = $_POST['nomOriginal'];
            $coordonnees = $_POST['coordonnees'];
            $nom = $_POST['nom'];
            $adresse = $_POST['adresse'];
            $restaurateur = $_POST['restaurateur'];
            $liste = $_POST['description_liste'];
            $paragraphe = $_POST['description_paragraphe'];
            $important = $_POST['description_important'];
            $imageUrl = $_POST['image_url'];
            $imagePosition = $_POST['image_position'];

            $image = new Image($imageUrl, $imagePosition);
            $descriptionRestaurant = new DescriptionRestaurant($liste, $paragraphe, $important, $image);
            $carte = [];
            $menus = [];

            $restaurant = new Restaurant($coordonnees, $nom, $adresse, $restaurateur, $descriptionRestaurant, $carte, $menus);
            $gestionRestaurants->mettreAJourRestaurant($nomOriginal, $restaurant);

            header('Location: gestionRestaurant.php?action=list');
        } else {
            $nomRestaurant = $_GET['nom'];
            $restaurant = $restaurantDAO->getRestaurantByName($nomRestaurant); // Implementer cette méthode dans RestaurantDAO si nécessaire
            require_once dirname(__DIR__) . '/vue/modifierRestaurant.php';
        }
        break;

    case 'delete':
        if (isset($_GET['nom'])) {
            $nomRestaurant = $_GET['nom'];
            $gestionRestaurants->supprimerRestaurant($nomRestaurant);
            header('Location: gestionRestaurant.php?action=list');
        }
        break;

    default:
        $gestionRestaurants->afficherTousLesRestaurants();
        break;
}
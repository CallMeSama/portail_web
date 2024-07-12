<?php
require_once __DIR__ . '/../dao/RestaurantDAO.php';
require_once __DIR__ . '/../domaine/Restaurant.php';
require_once __DIR__ . '/../domaine/DescriptionRestaurant.php';
require_once __DIR__ . '/../domaine/Image.php';
require_once __DIR__ . '/../domaine/Plat.php';
require_once __DIR__ . '/../domaine/DescriptionPlat.php';
require_once __DIR__ . '/../domaine/Prix.php';
require_once __DIR__ . '/../domaine/Menu.php';

class GestionRestaurants {
    private $restaurantDAO;

    public function __construct($fichierXML) {
        $this->restaurantDAO = new RestaurantDAO($fichierXML);
    }

    public function afficherTousLesRestaurants() {
        $restaurants = $this->restaurantDAO->getRestaurants();
        require_once dirname(__DIR__) . '/vue/afficherRestaurants.php';
    }

    public function ajouterRestaurant($restaurant) {
        $this->restaurantDAO->addRestaurant($restaurant);
    }

    public function mettreAJourRestaurant($nomRestaurant, $restaurant) {
        $this->restaurantDAO->deleteRestaurant($nomRestaurant);
        $this->restaurantDAO->addRestaurant($restaurant);
    }

    public function supprimerRestaurant($nomRestaurant) {
        $this->restaurantDAO->deleteRestaurant($nomRestaurant);
    }
}
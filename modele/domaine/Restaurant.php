<?php
// model/domaine/Restaurant.php

class Restaurant {
    public $coordonnees;
    public $nom;
    public $adresse;
    public $restaurateur;
    public $descriptionRestaurant;
    public $carte;
    public $menus;

    public function __construct($coordonnees, $nom, $adresse, $restaurateur, $descriptionRestaurant, $carte, $menus) {
        $this->coordonnees = $coordonnees;
        $this->nom = $nom;
        $this->adresse = $adresse;
        $this->restaurateur = $restaurateur;
        $this->descriptionRestaurant = $descriptionRestaurant;
        $this->carte = $carte;
        $this->menus = $menus;
    }
}
?>

<?php
// domaine/Menu.php

class Menu {
    public $titre;
    public $plats;
    public $prix;

    public function __construct($titre, $plats, $prix) {
        $this->titre = $titre;
        $this->plats = $plats;
        $this->prix = $prix;
    }
}
?>

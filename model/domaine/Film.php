<?php
// domaine/film.php

class Film {
    public $titre;
    public $duree;
    public $genre;
    public $realisateur;
    public $acteurs = [];
    public $annee;
    public $langue;
    public $description;
    public $horaires = [];
    public $notes = ['presse' => '', 'spectateur' => ''];

    public function __construct($titre, $duree, $genre, $realisateur, $acteurs, $annee, $langue, $description, $horaires, $presse, $spectateur) {
        $this->titre = $titre;
        $this->duree = $duree;
        $this->genre = $genre;
        $this->realisateur = $realisateur;
        $this->acteurs = $acteurs;
        $this->annee = $annee;
        $this->langue = $langue;
        $this->description = $description;
        $this->horaires = $horaires;
        $this->notes['presse'] = $presse;
        $this->notes['spectateur'] = $spectateur;
    }
}
?>

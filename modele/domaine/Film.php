<?php
class Film
{
    public $titre;
    public $duree;
    public $genre;
    public $realisateur;
    public $acteurs = []; // Tableau d'acteurs
    public $annee;
    public $langue;
    public $description;
    public $horaires = []; // Tableau d'horaires
    public $notes = []; // Associatif, peut contenir 'presse' et 'spectateur'

    // Constructeur
    public function __construct($titre, $duree, $genre, $realisateur, $acteurs, $annee, $langue, $description, $horaires, $notes)
    {
        $this->titre = $titre;
        $this->duree = $duree;
        $this->genre = $genre;
        $this->realisateur = $realisateur;
        $this->acteurs = $acteurs;
        $this->annee = $annee;
        $this->langue = $langue;
        $this->description = $description;
        $this->horaires = $horaires;
        $this->notes = $notes;
    }
}

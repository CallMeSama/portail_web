<?php
require_once dirname(__DIR__) . '\modele\dao\FilmDAO.php';
require_once dirname(__DIR__) . '\modele\domaine\Film.php';

class GestionFilms
{
    private $filmDAO;

    public function __construct($fichierXML)
    {
        $this->filmDAO = new FilmDAO($fichierXML);
    }

    //Metode pour affciher tous les films
    public function afficherTousLesFilms()
    {
        $films = $this->filmDAO->chargerFilms();
        require_once dirname(__DIR__) . 'vue\afficherFilms.php';
    }

    public function ajouterFilm($film)
    {
        // Logique pour ajouter un film
        // Cela impliquerait probablement d'ajouter le film au fichier XML via FilmDAO
    }

    public function mettreAJourFilm($idFilm, $nouvellesInfos)
    {
        // Logique pour mettre à jour un film
        // Cela impliquerait de modifier le film dans le fichier XML via FilmDAO
    }

    public function supprimerFilm($idFilm)
    {
        // Logique pour supprimer un film
        // Cela impliquerait de supprimer le film du fichier XML via FilmDAO
    }
}

// Exemple d'utilisation
$gestionFilms = new GestionFilms('chemin/vers/le/fichier.xml');
$gestionFilms->afficherTousLesFilms();

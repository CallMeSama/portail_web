<?php
// controller/filmController.php

require_once __DIR__ . '/../model/dao/FilmDAO.php';

class FilmController {
    private $filmDAO;

    public function __construct() {
        $this->filmDAO = new FilmDAO();
    }

    public function getFilms() {
        return $this->filmDAO->getFilms();
    }

    public function getFilmByTitle($titre) {
        return $this->filmDAO->getFilmByTitle($titre);
    }

    public function addFilm($titre, $duree, $genre, $realisateur, $acteurs, $annee, $langue, $description, $horaires, $presse, $spectateur) {
        $this->filmDAO->addFilm($titre, $duree, $genre, $realisateur, $acteurs, $annee, $langue, $description, $horaires, $presse, $spectateur);
    }

    public function updateFilm($oldTitre, $titre, $duree, $genre, $realisateur, $acteurs, $annee, $langue, $description, $horaires, $presse, $spectateur) {
        $this->filmDAO->updateFilm($oldTitre, $titre, $duree, $genre, $realisateur, $acteurs, $annee, $langue, $description, $horaires, $presse, $spectateur);
            
    }

    public function deleteFilm($titre) {
        $this->filmDAO->deleteFilm($titre);
    }
}
?>

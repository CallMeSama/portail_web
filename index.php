<?php
require_once __DIR__.'\controleur\GestionsFilms.php'; 

$gestionFilms = new GestionFilms(__DIR__.'\data\xml\donnéesFilms.xml');

// Exemple de gestion basique des actions via GET
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'afficherFilm':
            $gestionFilms->afficherTousLesFilms();
            break;
        case 'ajouterFilm':
            // Ici, vous devriez récupérer les informations du film depuis $_GET ou $_POST
            // et appeler $gestionFilms->ajouterFilm($film);
            break;
        case 'mettreAJourFilm':
            // Similaire à 'ajouter', mais pour mettre à jour un film
            break;
        case 'supprimerFilm':
            // Ici, vous devriez récupérer l'ID du film à supprimer
            // et appeler $gestionFilms->supprimerFilm($idFilm);
            break;
        default:
            echo "Action non reconnue.";
            break;
    }
} else {
    // Si aucune action spécifique n'est demandée, afficher tous les films par défaut
    $gestionFilms->afficherTousLesFilms();
}
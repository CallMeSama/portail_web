<?php
require_once __DIR__ . '/controller/FilmController.php';

// Créer une instance de FilmController
$filmController = new FilmController();
// Rediriger en fonction de l'action
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'add':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $filmController->addFilm( 
                    $_POST['titre'],
                    $_POST['duree'],
                    $_POST['genre'],
                    $_POST['realisateur'],
                    $_POST['acteurs'],
                    $_POST['annee'],
                    $_POST['langue'],
                    $_POST['description'],
                    $_POST['horaires'],
                    $_POST['presse'],
                    $_POST['spectateur']
                );
                header('Location: view/listeFilmsVueAdmin.php');
                exit;
            }
            break;
            case 'update':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $updateSuccess = $filmController->updateFilm(
                        $_POST['oldTitre'],
                        $_POST['titre'],
                        $_POST['duree'],
                        $_POST['genre'],
                        $_POST['realisateur'],
                        $_POST['acteurs'],
                        $_POST['annee'],
                        $_POST['langue'],
                        $_POST['description'],
                        $_POST['horaires'],
                        $_POST['presse'],
                        $_POST['spectateur']
                    );
                    
                    header('Location: view/listeFilmsVueAdmin.php');
                    exit;
                    
                }
                break;
                case 'delete':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'delete') {
                        if (isset($_POST['titre'])) {
                            $titre = $_POST['titre'];
                            $filmController->deleteFilm($titre);
                            header('Location: view/listeFilmsVueAdmin.php');
                        }
                    }
                break;
        // Ajoutez d'autres actions pour update, delete, etc.
    }
}
?>

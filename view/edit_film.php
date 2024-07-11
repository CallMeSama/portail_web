<?php
require_once '../controller/FilmController.php';

// Créer une instance de FilmController
$filmController = new FilmController();


if (isset($_GET['titre'])) {
    $titre = $_GET['titre'];
    $film = $filmController->getFilmByTitle($titre);
}

if (!$film) {
    die("Film non trouvé.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>CinéGourmet-Admin</title>
    
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../css/styles.css" rel="stylesheet" />
</head>
<body>
<!-- Responsive navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#!">CinéGourmet</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#">Restaurant</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Cinéma</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Page header with logo and tagline-->
    <header class="py-0 bg-light border-bottom mb-4">
        <div class="container">
            
        </div>
    </header>
<!-- film post -->
<div class="container bg-light py-5">
<div class="bg-secondary" style="height: 40px; width: 100%; position: relative; top: -6vh;"></div>
<form class="row g-3" method="post" action="../index.php?action=update">
  <input type="hidden" name="oldTitre" value="<?php echo $film->titre; ?>">
  <div class="col-md-2">
    <label for="inputTitre" class="form-label">Titre</label>
    <input type="text" class="form-control" name="titre" value="<?php echo $film->titre; ?>">
  </div>
  <div class="col-md-2">
    <label for="inputDuree" class="form-label">Durée</label>
    <input type="text" class="form-control" name="duree" value="<?php echo $film->duree; ?>">
  </div>
  <div class="col-md-2">
    <label for="inputAddress" class="form-label">Genre</label>
    <input type="text" class="form-control" name="genre" value="<?php echo $film->genre; ?>">
  </div>
  <div class="col-md-2">
    <label for="inputAddress2" class="form-label">Réalisateur</label>
    <input type="text" class="form-control" name="realisateur" value="<?php echo $film->realisateur; ?>">
  </div>
  <div class="col-md-2">
    <label for="inputZip" class="form-label">Langue</label>
    <input type="text" class="form-control" name="langue" value="<?php echo $film->langue; ?>">
  </div>
  <div class="col-4">
    <label for="inputState" class="form-label">Année</label>
    <input type="text" class="form-control" name="annee" value="<?php echo $film->annee; ?>">
  </div>
  <div class="col-4">
    <label for="inputState" class="form-label">Notes Presse</label>
    <input type="text" class="form-control" name="presse" value="<?php echo $film->notes->presse; ?>">
  </div>
  <div class="col-4">
    <label for="inputState" class="form-label">Notes Spectateur</label>
    <input type="text" class="form-control" name="spectateur" value="<?php echo $film->notes->spectateur; ?>">
  </div>
  <div class="col-6">
    <label for="inputCity" class="form-label">Acteurs </label>
    <textarea class="form-control" name="acteurs"><?php echo implode(', ', array_map('strval', (array)$film->acteurs->acteur)); ?></textarea>
  </div>
 
 
  <div class="col-6">
    <label for="inputZip" class="form-label">Horaires</label>
    <textarea class="form-control" name="horaires"><?php
        foreach ($film->horaires->horaire as $horaire) {
            $jours = implode(',', array_map('strval', (array)$horaire->jours->jour));
            $heures = implode(',', array_map('strval', (array)$horaire->heures->heure));
            echo $jours . '|' . $heures . ';';
        }
    ?></textarea>
  </div>
  <div class="col-6">
    <label for="inputZip" class="form-label">Description</label>
    <textarea class="form-control" name="description"><?php echo $film->description; ?></textarea>
  </div>
  
 
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Mettre à jour</button>
  </div>
</form>
</div>

</body>
<?php
require_once '../controller/FilmController.php';

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
                    <li class="nav-item"><a class="nav-link" href="login.php">Déconnexion</a></li>
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
<form class="row g-3" method="post" action="../index.php?action=add">
  <div class="col-md-2">
    <label for="inputTitre" class="form-label">Titre</label>
    <input type="text" class="form-control" name="titre" required>
  </div>
  <div class="col-md-2">
    <label for="inputDuree" class="form-label">Durée</label>
    <input type="text" class="form-control" name="duree" required>
  </div>
  <div class="col-md-2">
    <label for="inputAddress" class="form-label">Genre</label>
    <input type="text" class="form-control" name="genre" required>
  </div>
  <div class="col-md-2">
    <label for="inputAddress2" class="form-label">Réalisateur</label>
    <input type="text" class="form-control" name="realisateur" required>
  </div>
  <div class="col-md-2">
    <label for="inputZip" class="form-label">Langue</label>
    <input type="text" class="form-control" name="langue" required>
  </div>
  <div class="col-4">
    <label for="inputState" class="form-label">Année</label>
    <input type="text" class="form-control" name="annee" required>
  </div>
  <div class="col-4">
    <label for="inputState" class="form-label">Notes Presse</label>
    <input type="text" class="form-control" name="presse">
  </div>
  <div class="col-4">
    <label for="inputState" class="form-label">Notes Spectateur</label>
    <input type="text" class="form-control" name="spectateur">
  </div>
  <div class="col-6">
    <label for="inputCity" class="form-label">Acteurs (séparés par des virgules) </label>
    <textarea class="form-control" name="acteurs" required></textarea>
  </div>
 
 
  <div class="col-6">
    <label for="inputZip" class="form-label">Horaires (format: jour1,jour2|heure1,heure2;jour3,jour4|heure3,heure4)</label>
    <textarea class="form-control" name="horaires" required></textarea>
  </div>
  <div class="col-6">
    <label for="inputZip" class="form-label">Description</label>
    <textarea class="form-control" name="description" required></textarea>
  </div>
  
 
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Ajouter</button>
  </div>
</form>
</div>

</body>
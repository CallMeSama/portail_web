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
<div class="container">
    <div class="row">
        <!-- Blog entries-->
        <div class="col-lg-8">
            
            <!-- Nested row for non-featured blog posts-->
            <div class="row">
    
                
                    <!-- Blog post-->
                    <div class="card mb-4">
                        <a href="#!">
                            <?php
                                if ($film->titre == "Les Brigades du Tigre") {
                                    $videoUrl = "../assets/video/brigade_du_tigre.mp4"; // Chemin vers la vidéo locale
                                } elseif ($film->titre == "Hierarchy") {
                                    $videoUrl = "../assets/video/hierarchy.mp4";
                                } elseif ($film->titre == "Business Proposal") {
                                    $videoUrl = "../assets/video/business_proposal.mp4";
                                } elseif ($film->titre == "My demon") {
                                    $videoUrl = "../assets/video/mydemon.mp4";
                                } else {
                                    $videoUrl = ""; // URL par défaut pour les autres titres
                                }
                            ?>
                            <?php if ($film->titre == "Les Brigades du Tigre"): ?>
                                <video class="card-img-top" width="560" height="315" controls>
                                    <source src="<?php echo $videoUrl; ?>" type="video/mp4">
                                    Votre navigateur ne supporte pas la balise vidéo.
                                </video>
                            <?php elseif ($film->titre == "Hierarchy"): ?>
                                <video class="card-img-top" width="560" height="315" controls>
                                    <source src="<?php echo $videoUrl; ?>" type="video/mp4">
                                    Votre navigateur ne supporte pas la balise vidéo.
                                </video>
                            <?php elseif ($film->titre == "Business Proposal"): ?>
                            <video class="card-img-top" width="560" height="315" controls>
                                <source src="<?php echo $videoUrl; ?>" type="video/mp4">
                                Votre navigateur ne supporte pas la balise vidéo.
                            </video>
                            <?php elseif ($film->titre == "My demon"): ?>
                            <video class="card-img-top" width="560" height="315" controls>
                                <source src="<?php echo $videoUrl; ?>" type="video/mp4">
                                Votre navigateur ne supporte pas la balise vidéo.
                            </video>
                            <?php else: ?>
                                <img class="card-img-top" src="<?php echo $videoUrl; ?>" alt="..." />
                            <?php endif; ?>
                        </a>

                        <div class="card-body">
                            <div class="small text-muted"><span class="fw-bolder">Genre :</span> <?php echo $film->genre; ?></div>
                            <h2 class="card-title h4"><?php echo $film->titre; ?></h2>
                            <p class="card-text"><?php echo $film->description; ?></p>
                            <p class="card-text"><span class="fw-bolder">Réalisateur :</span> <?php echo $film->realisateur; ?></p>
                            <p class="card-text"><span class="fw-bolder">Acteurs :</span>
                                <?php foreach ($film->acteurs->acteur as $acteur): ?>
                                    <?php echo $acteur . " "; ?> |
                                <?php endforeach; ?>
                            </p>

                            <p class="card-text"><span class="fw-bolder">Annee :</span> <?php echo $film->annee; ?></p>
                            <p class="card-text"><span class="fw-bolder">Langue diffusée :</span> <?php echo $film->langue; ?></p>
                            <p class="card-text"><span class="fw-bolder">Horaires de diffusion :</span> 
                                <?php foreach ($film->horaires->horaire as $horaire): ?>
                                    <br>
                                    <?php 
                                    $jours = $horaire->jours->jour;
                                    $heures = $horaire->heures->heure;
                                    $totalJours = count($jours);
                                    $totalHeures = count($heures);
                                    $countJour = 0;
                                    foreach ($jours as $jour): 
                                        $countJour++;
                                        echo $jour;
                                        if ($countJour < $totalJours) echo ",";
                                    endforeach; 
                                    ?>
                                    :   
                                    <?php 
                                    $countHeure = 0;
                                    foreach ($heures as $heure): 
                                        $countHeure++;
                                        echo $heure;
                                        if ($countHeure < $totalHeures) echo " | ";
                                    endforeach; 
                                    ?>
                                    <br>
                                <?php endforeach; ?>
                            </p>

                            <p class="card-text"><span class="fw-bolder">Notes :</span>
                            <span class="fw-bolder text-success">Presse :</span> <?php echo $film->notes->presse; ?> 
                            <span class="fw-bolder text-primary"> Spectateurs :</span> <?php echo $film->notes->spectateur; ?></p>
                            
                        </div>
                    </div>
                
            </div>
        </div>
    
    </div>
           
</div>


</body>
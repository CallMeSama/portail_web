<?php
// View/film.php
require_once __DIR__ . '/../controller/FilmController.php';

// Créer une instance de FilmController
$filmController = new FilmController();

// Appel des méthodes du contrôleur
// Récupérer tous les films
$films = $filmController->getFilms();
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
    <!-- JQuery (for AJAX) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        <div class="col-lg-8" id="film-list">
            
            <!-- Nested row for non-featured blog posts-->
            <div class="row">
                <?php if ($films !== false && isset($films->Film)): ?>
                    <?php 
                    $count = 0;
                    foreach ($films->Film as $film): 
                        if ($count % 2 == 0 && $count != 0): ?>
                            </div><div class="row">
                        <?php endif; ?>
                        <div class="col-lg-6">
                            <!-- Blog post-->
                            <div class="card mb-4">
                            <a href="#!">
                                <?php
                                    if ($film->titre == "Les Brigades du Tigre") {
                                        $imageUrl = "https://www.programme-tv.net/imgre/fit/~2~backoffice~program~d504ec779568d4ba.jpg/1200x630/crop-from/top/quality/80/cr/wqkgVGhlIE1vdmllIERC/les-brigades-du-tigre.jpg";
                                    } elseif ($film->titre == "HIERARCHY") {
                                        $imageUrl = "https://koreasowls.fr/wp-content/uploads/2024/05/Hierarchy-1.webp";
                                    } elseif ($film->titre == "Business Proposal") {
                                        $imageUrl = "https://resizing.flixster.com/50HR4NgmUoW72E60_TpsXXagnxU=/fit-in/705x460/v2/https://resizing.flixster.com/-XZAfHZM39UwaGJIFWKAE8fS0ak=/v3/t/assets/p21402965_b_h8_ad.jpg"; // URL par défaut pour les autres titres
                                    } elseif ($film->titre == "My demon") {
                                        $imageUrl = "https://www.justwatch.com/images/backdrop/309462806/s640/saison-1/saison-1"; // URL par défaut pour les autres titres
                                    } else {
                                        $imageUrl = "https://via.placeholder.com/700x350"; // URL par défaut pour les autres titres
                                    }
                                ?>
                                <img class="card-img-top" src="<?php echo $imageUrl; ?>" alt="..." />
                            </a>
                                <div class="card-body">
                                    <div class="small text-muted"><?php echo $film->genre; ?></div>
                                    <h2 class="card-title h4"><?php echo $film->titre; ?></h2>
                                    <p class="card-text"><?php echo $film->description; ?></p>
                                    <a class="btn btn-primary" href="edit_film.php?titre=<?php echo $film->titre; ?>">Editer</a>
                                    <a class="btn btn-secondary" href="view_film.php?titre=<?php echo $film->titre; ?>">Consulter</a>
                                    
                                    <form method="post" action="../index.php?action=delete" style="display:inline;">
                                        <input type="hidden" name="titre" value="<?php echo $film->titre; ?>">
                                        <input class="btn btn-danger" type="submit" value="Supprimer">
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php 
                    $count++;
                    endforeach;?>
                    <?php else: ?>
                        <p>Aucun film trouvé.</p>
                    <?php endif; ?>
            </div>
        </div>



        <!-- Side widgets-->
        <div class="col-lg-4">
             <!-- Search widget-->
             <div class="card mb-4">
                <div class="card-header">Recherche de films</div>
                <div class="card-body">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Rechercher" aria-label="Enter search term..." aria-describedby="button-search" id="search-term"/>
                        <button class="btn btn-primary" id="button-search" type="button">Rechercher</button>
                    </div> 
                </div>
            </div>
            <!-- Categories widget-->
            <div class="card mb-4">
                <div class="card-header">Catégories</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#!">Action</a></li>
                                <li><a href="#!">Romance</a></li>
                                <li><a href="#!">Comédie</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#!">Aventure</a></li>
                                <li><a href="#!">Drame</a></li>
                                <li><a href="#!">Science-Fiction</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Side widget-->
            <div class="card mb-4">
                <div class="card-header">Ajout de films</div>
                <div class="card-body">
                    <div class="input-group">
                        <a class="btn btn-secondary btn-sm" href="add_film.php">+ Ajouter</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
$(document).ready(function(){
    // Rechercher les films en tapant dans la barre de recherche
    $('#search-term').on('input', function(){
        var searchTerm = $(this).val();
        $.ajax({
            url: '../controller/FilmSearchController.php',
            type: 'GET',
            data: { term: searchTerm },
            success: function(data) {
                $('#film-list').html(data);
            }
        });
    });

    // Rechercher les films en cliquant sur le bouton Rechercher
    $('#button-search').on('click', function(){
        var searchTerm = $('#search-term').val();
        $.ajax({
            url: '../controller/FilmSearchController.php',
            type: 'GET',
            data: { term: searchTerm },
            success: function(data) {
                $('#film-list').html(data);
            }
        });
    });
});
</script>

</body>
</html>
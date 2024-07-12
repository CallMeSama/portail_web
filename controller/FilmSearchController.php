<?php
// controller/FilmSearchController.php
require_once __DIR__ . '/../model/dao/FilmDAO.php';

class FilmSearchController {
    private $filmDAO;

    public function __construct() {
        $this->filmDAO = new FilmDAO(__DIR__ . '/../data/xml/films.xml');
    }

    public function searchFilms($term) {
        $films = $this->filmDAO->getFilms();
        $results = [];
        if ($films !== false && isset($films->Film)) {
            foreach ($films->Film as $film) {
                if (stripos($film->titre, $term) !== false) {
                    $results[] = $film;
                }
            }
        }
        return $results;
    }
}

$searchTerm = isset($_GET['term']) ? $_GET['term'] : '';
$searchController = new FilmSearchController();
$results = $searchController->searchFilms($searchTerm);
$filmsDAO = new FilmDAO();
$films = $filmsDAO->getFilms();
if (!empty($results)) {
    $count = 0;
    foreach ($results as $film) {
        if ($count % 2 == 0 && $count == 0) {
            echo '</div><div class="row">';
        }
        echo '<div class="col-lg-6">
                <div class="card mb-4">
                <a href="#!">';
                    if ($film->titre == "Les Brigades du Tigre") {
                        $imageUrl = "https://www.programme-tv.net/imgre/fit/~2~backoffice~program~d504ec779568d4ba.jpg/1200x630/crop-from/top/quality/80/cr/wqkgVGhlIE1vdmllIERC/les-brigades-du-tigre.jpg";
                    } elseif ($film->titre == "Hierarchy") {
                        $imageUrl = "https://koreasowls.fr/wp-content/uploads/2024/05/Hierarchy-1.webp";
                    } elseif ($film->titre == "Business Proposal") {
                        $imageUrl = "https://resizing.flixster.com/50HR4NgmUoW72E60_TpsXXagnxU=/fit-in/705x460/v2/https://resizing.flixster.com/-XZAfHZM39UwaGJIFWKAE8fS0ak=/v3/t/assets/p21402965_b_h8_ad.jpg";
                    } elseif ($film->titre == "My demon") {
                        $imageUrl = "https://www.justwatch.com/images/backdrop/309462806/s640/saison-1/saison-1";
                    } else {
                        $imageUrl = "https://via.placeholder.com/700x350";
                    }
                    echo '<img class="card-img-top" src="'.$imageUrl.'" alt="..." />
                </a>
                    <div class="card-body">
                        <div class="small text-muted">'.$film->genre.'</div>
                        <h2 class="card-title h4">'.$film->titre.'</h2>
                        <p class="card-text">'.$film->description.'</p>
                        <a class="btn btn-secondary" href="view_filmV.php?titre='.$film->titre.'">Consulter</a>
                    </div>
                </div>
              </div>';
        $count++;
    }
} else {
    $count = 0;
    foreach ($films as $film) {
        if ($count % 2 == 0 && $count != 0) {
            echo '</div><div class="row">';
        }
        echo '<div class="col-lg-6">
                <div class="card mb-4">
                <a href="#!">';
                    if ($film->titre == "Les Brigades du Tigre") {
                        $imageUrl = "https://www.programme-tv.net/imgre/fit/~2~backoffice~program~d504ec779568d4ba.jpg/1200x630/crop-from/top/quality/80/cr/wqkgVGhlIE1vdmllIERC/les-brigades-du-tigre.jpg";
                    } elseif ($film->titre == "HIERARCHY") {
                        $imageUrl = "https://koreasowls.fr/wp-content/uploads/2024/05/Hierarchy-1.webp";
                    } elseif ($film->titre == "Business Proposal") {
                        $imageUrl = "https://resizing.flixster.com/50HR4NgmUoW72E60_TpsXXagnxU=/fit-in/705x460/v2/https://resizing.flixster.com/-XZAfHZM39UwaGJIFWKAE8fS0ak=/v3/t/assets/p21402965_b_h8_ad.jpg";
                    } elseif ($film->titre == "My demon") {
                        $imageUrl = "https://www.justwatch.com/images/backdrop/309462806/s640/saison-1/saison-1";
                    } else {
                        $imageUrl = "https://via.placeholder.com/700x350";
                    }
                    echo '<img class="card-img-top" src="'.$imageUrl.'" alt="..." />
                </a>
                    <div class="card-body">
                        <div class="small text-muted">'.$film->genre.'</div>
                        <h2 class="card-title h4">'.$film->titre.'</h2>
                        <p class="card-text">'.$film->description.'</p>
                        <a class="btn btn-secondary" href="view_filmV.php?titre='.$film->titre.'">Consulter</a>
                    </div>
                </div>
              </div>';
        $count++;
    }
}
?>

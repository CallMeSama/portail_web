<?php
// RestaurantDAO.php

require_once __DIR__ . '/../domaine/Restaurant.php';
require_once __DIR__ . '/../domaine/DescriptionRestaurant.php';
require_once __DIR__ . '/../domaine/Image.php';
require_once __DIR__ . '/../domaine/Plat.php'; // Incluez la classe Plat ici
require_once __DIR__ . '/../domaine/DescriptionPlat.php';
require_once __DIR__ . '/../domaine/Prix.php';
require_once __DIR__ . '/../domaine/Menu.php';
class RestaurantDAO {
    private $file;

    public function __construct() {
        $this->file = 'restaurants.xml';
    }

    public function getRestaurants() {
        $restaurants = [];

        if (file_exists($this->file)) {
            libxml_use_internal_errors(true);
            $xml = simplexml_load_file($this->file);
            
            if ($xml === false) {
                echo "Erreur lors du chargement du fichier XML :<br>";
                foreach (libxml_get_errors() as $error) {
                    echo "<br>", $error->message;
                }
                return false;
            }
            
            foreach ($xml->restaurant as $resto) {
                $coordonnees = (string) $resto->coordonnees;
                $nom = (string) $resto->nom;
                $adresse = (string) $resto->adresse;
                $restaurateur = (string) $resto->restaurateur;


                // Récupération des menus
                $menus = [];
                foreach ($resto->menu as $menu) {
                    $titre = (string) $menu->titre;

                    // Récupération des plats du menu
                    $platsMenu = [];
                    foreach ($menu->descriptionMenu->platMenu as $platMenu) {
                        $platId = (string) $platMenu['plat'];
                        $platsMenu[] = $platId;
                    }

                    $prixValeur = (float) $menu->prix['valeur'];
                    $prixDevise = (string) $menu->prix['devise'];

                    $prix = new Prix($prixValeur, $prixDevise);

                    $menuObj = new Menu($titre, $platsMenu, $prix);
                    $menus[] = $menuObj;
                }



                $carte = [];

                // Récupération des plats
                foreach ($resto->carte->plat as $plat) {
                    $numero = (string) $plat['numero'];
                    $indication = (string) $plat->indication['type'];
                    $prixValeur = (float) $plat->prix['valeur'];
                    $prixDevive = (string) $plat->prix['devise'];

                    $prix = new Prix($prixValeur, $prixDevive);
                    
                    $descriptionPlatParagraphe = (string) $plat->descriptionPlat->paragraphe;
                    $descriptionPlatImportantForme = (string) $plat->descriptionPlat->important['forme'];

                    $descriptionPlat = new DescriptionPlat($descriptionPlatParagraphe, $descriptionPlatImportantForme);

                    $platObj = new Plat($numero, $indication, $prix, $descriptionPlat);
                    $carte[] = $platObj;
                }

                // Création de l'objet DescriptionRestaurant
                $liste = (string) $resto->descriptionRestaurant->liste;
                $paragraphe = (string) $resto->descriptionRestaurant->paragraphe;
                $important = (string) $resto->descriptionRestaurant->important;
                $imageURL = (string) $resto->descriptionRestaurant->image['url'];
                $imagePosition = (string) $resto->descriptionRestaurant->image['position'];

                $image = new Image($imageURL, $imagePosition);
                $descriptionRestaurant = new DescriptionRestaurant($liste, $paragraphe, $important, $image);

                // Création de l'objet Restaurant avec la carte des plats
                $restaurant = new Restaurant($coordonnees, $nom, $adresse, $restaurateur, $descriptionRestaurant, $carte,$menus);
                $restaurants[] = $restaurant;
            }

            return $restaurants;
        } else {
            echo "Le fichier XML n'existe pas.";
            return false;
        }
    }

    public function addRestaurant(Restaurant $restaurant) {
        if (file_exists($this->file)) {
            libxml_use_internal_errors(true);
            $xml = simplexml_load_file($this->file);

            if ($xml === false) {
                echo "Erreur lors du chargement du fichier XML :<br>";
                foreach (libxml_get_errors() as $error) {
                    echo "<br>", $error->message;
                }
                return false;
            }

            // Création de l'élément restaurant
            $newRestaurant = $xml->addChild('restaurant');

            // Ajout des coordonnées
            $newRestaurant->addChild('coordonnees', $restaurant->coordonnees);

            // Ajout du nom
            $newRestaurant->addChild('nom', $restaurant->nom);

            // Ajout de l'adresse
            $newRestaurant->addChild('adresse', $restaurant->adresse);

            // Ajout du restaurateur
            $newRestaurant->addChild('restaurateur', $restaurant->restaurateur);

            // Ajout de la description du restaurant
            $descriptionRestaurant = $newRestaurant->addChild('descriptionRestaurant');
            $descriptionRestaurant->addChild('liste', $restaurant->descriptionRestaurant->liste);
            $descriptionRestaurant->addChild('paragraphe', $restaurant->descriptionRestaurant->paragraphe);
            $descriptionRestaurant->addChild('important', $restaurant->descriptionRestaurant->important);

            // Ajout de l'image
            $image = $descriptionRestaurant->addChild('image');
            $image->addAttribute('url', $restaurant->descriptionRestaurant->image->url);
            $image->addAttribute('position', $restaurant->descriptionRestaurant->image->position);

            // Ajout de la carte des plats
            $carte = $newRestaurant->addChild('carte');
            foreach ($restaurant->carte as $plat) {
                $platNode = $carte->addChild('plat');
                $platNode->addAttribute('numero', $plat->numero);
                $platNode->addChild('indication', $plat->indication);
                $platNode->addChild('prix', $plat->prix);
                $platNode->addChild('descriptionPlat')->addChild('paragraphe', $plat->descriptionPlat->paragraphe);
                $platNode->descriptionPlat->addChild('important', $plat->descriptionPlat->importantForme);
            }

            // Ajout des menus
            $menusNode = $newRestaurant->addChild('menus');
            foreach ($restaurant->menus as $menu) {
                $menuNode = $menusNode->addChild('menu');
                $menuNode->addChild('titre', $menu->titre);

                $descriptionMenu = $menuNode->addChild('descriptionMenu');
                foreach ($menu->plats as $platId => $description) {
                    $platMenuNode = $descriptionMenu->addChild('platMenu', $description);
                    $platMenuNode->addAttribute('plat', $platId);
                }

                $menuNode->addChild('prix', $menu->prix->valeur)->addAttribute('devise', $menu->prix->devise);
            }

            // Sauvegarde des modifications dans le fichier XML
            $xml->asXML($this->file);

            return true;
        } else {
            echo "Le fichier XML n'existe pas.";
            return false;
        }
    }

    public function deleteRestaurant($nomRestaurant) {
        if (file_exists($this->file)) {
            libxml_use_internal_errors(true);
            $xml = simplexml_load_file($this->file);

            if ($xml === false) {
                echo "Erreur lors du chargement du fichier XML :<br>";
                foreach (libxml_get_errors() as $error) {
                    echo "<br>", $error->message;
                }
                return false;
            }

            // Recherche du restaurant à supprimer par son nom
            $restaurantToDelete = null;
            foreach ($xml->restaurant as $restaurant) {
                if ((string) $restaurant->nom === $nomRestaurant) {
                    $restaurantToDelete = $restaurant;
                    break;
                }
            }

            if ($restaurantToDelete !== null) {
                // Suppression du restaurant
                $dom = dom_import_simplexml($restaurantToDelete);
                $dom->parentNode->removeChild($dom);

                // Sauvegarde des modifications dans le fichier XML
                $xml->asXML($this->file);

                return true;
            } else {
                echo "Restaurant non trouvé.";
                return false;
            }
        } else {
            echo "Le fichier XML n'existe pas.";
            return false;
        }
    }
}

// $restaurantsDao = new RestaurantDAO();
// $restaurants = $restaurantsDao->getRestaurants();

// foreach ($restaurants as $restaurant) {
//     echo "Nom : " . $restaurant->nom . "<br>";
//     echo "Adresse : " . $restaurant->adresse . "<br>";
//     echo "Restaurateur : " . $restaurant->restaurateur . "<br>";

//     // Accéder aux informations de la description
//     echo "Description : <br>";
//     echo "- Liste : " . $restaurant->descriptionRestaurant->liste . "<br>";
//     echo "- Paragraphe : " . $restaurant->descriptionRestaurant->paragraphe . "<br>";
//     echo "- Important : " . $restaurant->descriptionRestaurant->important . "<br>";

//     // Accéder aux informations de l'image
//     echo "- Image URL : " . $restaurant->descriptionRestaurant->image->url . "<br>";
//     echo "- Image Position : " . $restaurant->descriptionRestaurant->image->position . "<br>";

//     // Accéder aux informations de la carte des plats
//     echo "Carte des plats : <br>";
//     foreach ($restaurant->carte as $plat) {
//         echo "-- Plat : " . $plat->numero . "<br>";
//         echo "-- Indication : " . $plat->indication . "<br>";
//         echo "-- Prix : " . $plat->prix->valeur . " " . $plat->prix->devise . "<br>";
//         echo "-- Description : " . $plat->descriptionPlat->paragraphe . "<br>";
//         echo "-- Important : " . $plat->descriptionPlat->importantForme . "<br>";
//         echo "<br>";
//     }

//     echo "<br>";

//     foreach ($restaurant->menus as $menu) {
//         echo "-- Titre : " . $menu->titre . "<br>";
//         echo "-- Prix : " . $menu->prix->valeur . " " . $menu->prix->devise . "<br>";
//         echo "-- Détails : <br>";
//         foreach ($menu->plats as $platId => $description) {
//             echo "--- Plat $platId : $description <br>";
//         }
//         echo "<br>";
//     }

//     echo "<br>";
// }
?>

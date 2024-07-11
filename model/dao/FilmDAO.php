<?php
// dao/filmDAO.php

require_once __DIR__ . '/../domaine/Film.php';

class FilmDAO {
    private $file;

    public function __construct() {
        $this->file = __DIR__ . '/../../data/xml/films.xml';
    }

    public function getFilms() {

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
            
            return $xml;
        } else {
            echo "Le fichier XML n'existe pas.";
            return false;
        }
    }
    function getFilmByTitle($titre) {
        $films = $this->getFilms();
        foreach ($films->Film as $film) {
            if ((string)$film->titre === $titre) {
                return $film;
            }
        }
        return null;
    }
   
    function addFilm($titre, $duree, $genre, $realisateur, $acteurs, $annee, $langue, $description, $horaires, $presse, $spectateur) {
        $xml = $this->getFilms();
        
        $newFilm = $xml->addChild('Film');
        $newFilm->addChild('titre', $titre);
        $newFilm->addChild('duree', $duree);
        $newFilm->addChild('genre', $genre);
        $newFilm->addChild('realisateur', $realisateur);
        
        $acteursNode = $newFilm->addChild('acteurs');
        $acteursArray = explode(',', $acteurs);
        foreach ($acteursArray as $acteur) {
            $acteursNode->addChild('acteur', trim($acteur));
        }
        
        $newFilm->addChild('annee', $annee);
        $newFilm->addChild('langue', $langue);
        $newFilm->addChild('description', $description);
        
        $horairesElem = $newFilm->addChild('horaires');
        foreach (explode(';', $horaires) as $horaireData) {
            $horaire = $horairesElem->addChild('horaire');
    
            list($joursData, $heuresData) = explode('|', $horaireData);
    
            $jours = $horaire->addChild('jours');
            foreach (explode(',', $joursData) as $jour) {
                $jours->addChild('jour', trim($jour));
            }
    
            $heures = $horaire->addChild('heures');
            foreach (explode(',', $heuresData) as $heure) {
                $heures->addChild('heure', trim($heure));
            }
        }
    
        
        $notesNode = $newFilm->addChild('notes');
        $notesNode->addChild('presse', $presse);
        $notesNode->addChild('spectateur', $spectateur);
        
        $xml->asXML($this->file);
    }
    

    function updateFilm($oldTitre, $titre, $duree, $genre, $realisateur, $acteurs, $annee, $langue, $description, $horaires, $presse, $spectateur) {
        $films = $this->getFilms();
    
        foreach ($films->Film as $film) {
            if ((string)$film->titre === $oldTitre) {
                // Mise à jour des champs
                $film->titre = $titre;
                $film->duree = $duree;
                $film->genre = $genre;
                $film->realisateur = $realisateur;
                
                // Mise à jour des acteurs
                unset($film->acteurs);
                $acteursNode = $film->addChild('acteurs');
                $acteursArray = explode(',', $acteurs);
                foreach ($acteursArray as $acteur) {
                    $acteursNode->addChild('acteur', trim($acteur));
                }
    
                $film->annee = $annee;
                $film->langue = $langue;
                $film->description = $description;
    
                // Mise à jour des horaires
                unset($film->horaires);
                $horairesElem = $film->addChild('horaires');
                foreach (explode(';', $horaires) as $horaireData) {
                    $horaire = $horairesElem->addChild('horaire');
    
                    list($joursData, $heuresData) = explode('|', $horaireData);
    
                    $jours = $horaire->addChild('jours');
                    foreach (explode(',', $joursData) as $jour) {
                        $jours->addChild('jour', trim($jour));
                    }
    
                    $heures = $horaire->addChild('heures');
                    foreach (explode(',', $heuresData) as $heure) {
                        $heures->addChild('heure', trim($heure));
                    }
                }
    
                // Mise à jour des notes
                unset($film->notes);
                $notesNode = $film->addChild('notes');
                $notesNode->addChild('presse', $presse);
                $notesNode->addChild('spectateur', $spectateur);
    
                // Sauvegarder les modifications dans le fichier XML
                $films->asXML($this->file);
                return true;
            }
        }
        return false;
    }
    
    function deleteFilm($titre) {
        $films = $this->getFilms();
        $updatedFilms = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><Cinema></Cinema>');
    
        $filmFound = false;
    
        foreach ($films->Film as $film) {
            if ((string)$film->titre !== $titre) {
                $newFilm = $updatedFilms->addChild('Film');
                $newFilm->addChild('titre', (string)$film->titre);
                $newFilm->addChild('duree', (string)$film->duree);
                $newFilm->addChild('genre', (string)$film->genre);
                $newFilm->addChild('realisateur', (string)$film->realisateur);
    
                $acteursNode = $newFilm->addChild('acteurs');
                foreach ($film->acteurs->acteur as $acteur) {
                    $acteursNode->addChild('acteur', (string)$acteur);
                }
    
                $newFilm->addChild('annee', (string)$film->annee);
                $newFilm->addChild('langue', (string)$film->langue);
                $newFilm->addChild('description', (string)$film->description);
    
                $horairesNode = $newFilm->addChild('horaires');
                foreach ($film->horaires->horaire as $horaire) {
                    $newHoraire = $horairesNode->addChild('horaire');
                    $joursNode = $newHoraire->addChild('jours');
                    foreach ($horaire->jours->jour as $jour) {
                        $joursNode->addChild('jour', (string)$jour);
                    }
                    $heuresNode = $newHoraire->addChild('heures');
                    foreach ($horaire->heures->heure as $heure) {
                        $heuresNode->addChild('heure', (string)$heure);
                    }
                }
    
                $notesNode = $newFilm->addChild('notes');
                $notesNode->addChild('presse', (string)$film->notes->presse);
                $notesNode->addChild('spectateur', (string)$film->notes->spectateur);
    
                $filmFound = true;
            }
        }
    
        if ($filmFound) {
            $updatedFilms->asXML($this->file);
            return true;
        }
        return false;
    }
    
    
}
?>

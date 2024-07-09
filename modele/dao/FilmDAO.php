<?php
class FilmDAO
{
    private $fichierXML;

    public function __construct($fichierXML)
    {
        $this->fichierXML = $fichierXML;
    }

    public function chargerFilms()
    {
        $films = [];
        $xml = simplexml_load_file($this->fichierXML);
        foreach ($xml->film as $elementFilm) {
            $acteurs = [];
            foreach ($elementFilm->acteurs->acteur as $acteur) {
                $acteurs[] = (string)$acteur;
            }

            $horaires = [];
            foreach ($elementFilm->horaires->horaire as $horaire) {
                $jours = [];
                foreach ($horaire->jours->jour as $jour) {
                    $jours[] = (string)$jour;
                }

                $heures = [];
                foreach ($horaire->heures->heure as $heure) {
                    $heures[] = (string)$heure;
                }

                $horaires[] = ['jours' => $jours, 'heures' => $heures];
            }

            $notes = [];
            if (isset($elementFilm->notes->presse)) {
                $notes['presse'] = (string)$elementFilm->notes->presse;
            }
            if (isset($elementFilm->notes->spectateur)) {
                $notes['spectateur'] = (string)$elementFilm->notes->spectateur;
            }

            $films[] = new Film(
                (string)$elementFilm->titre,
                (string)$elementFilm->duree,
                (string)$elementFilm->genre,
                (string)$elementFilm->realisateur,
                $acteurs,
                (string)$elementFilm->annee,
                (string)$elementFilm->langue,
                (string)$elementFilm->description,
                $horaires,
                $notes
            );
        }
        return $films;
    }

    // Méthodes pour sauvegarder, mettre à jour, supprimer des films...
}

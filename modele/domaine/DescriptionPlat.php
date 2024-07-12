<?php
// domaine/DescriptionPlat.php

class DescriptionPlat {
    public $paragraphe;
    public $importantForme;

    public function __construct($paragraphe, $importantForme) {
        $this->paragraphe = $paragraphe;
        $this->importantForme = $importantForme;
    }
}
?>

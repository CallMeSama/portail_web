<?php
// domaine/Plat.php

class Plat {
    public $numero;
    public $indication;
    public $prix;
    public $descriptionPlat;

    public function __construct($numero, $indication, $prix, $descriptionPlat) {
        $this->numero = $numero;
        $this->indication = $indication;
        $this->prix = $prix;
        $this->descriptionPlat = $descriptionPlat;
    }
}
?>

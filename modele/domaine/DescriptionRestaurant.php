<?php

class DescriptionRestaurant {
    public $liste;
    public $paragraphe;
    public $important;
    public $image;

    public function __construct($liste, $paragraphe, $important, $image) {
        $this->liste = $liste;
        $this->paragraphe = $paragraphe;
        $this->important = $important;
        $this->image = $image;
    }
}

?>

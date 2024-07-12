<?php
class Prix {
    public $valeur;
    public $devise;

    public function __construct($valeur, $devise) {
        $this->valeur = $valeur;
        $this->devise = $devise;
    }
}
?>

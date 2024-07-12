<?php

class Image {
    public $url;
    public $position;

    public function __construct($url, $position) {
        $this->url = $url;
        $this->position = $position;
    }
}

?>

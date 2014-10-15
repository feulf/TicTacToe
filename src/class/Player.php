<?php

require_once dirname(__DIR__) . "/constants.php";

/**
 * Player
 */
class Player {

    private $name;

    function __construct($name) {
        $this->name = $name;
    }

    function getName() {
        return $this->name;
    }

    function isHuman() {
        return true;
    }

}

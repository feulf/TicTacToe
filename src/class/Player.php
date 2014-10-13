<?php

require_once dirname(__DIR__) . "/constants.php";

/**
 * Player
 */
class Player {

    private $name;
    private $is_human = false;

    function __construct($name, $is_human = false) {
        $this->name = $name;
        $this->is_human = $is_human;
    }

    function getName() {
        return $this->name;
    }

    function isHuman() {
        return $this->is_human;
    }

}

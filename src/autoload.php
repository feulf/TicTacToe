<?php

// automatically loads the class
function ticTacToeAutoload($class) {
    require __DIR__ . "/class/" . (ucfirst(strtolower($class))) . ".php";
}

spl_autoload_register("ticTacToeAutoload");

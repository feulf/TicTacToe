<?php

// automatically loads the class
function ticTacToeAutoload($class) {
    require "class/" . (strtolower($class)) . ".php";
}

spl_autoload_register("ticTacToeAutoload");

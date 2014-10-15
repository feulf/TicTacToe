<?php

require_once dirname(__DIR__) . "/src/constants.php";

class PlayerTest extends PHPUnit_Framework_TestCase {

    function testPlayer() {
        $player = new Player("John Connor", true);
        $this->assertTrue($player->isHuman());
        $this->assertEquals("John Connor", $player->getName());
    }
}

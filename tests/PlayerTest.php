<?php

require_once dirname(__DIR__) . "/src/constants.php";

class PlayerTest extends PHPUnit_Framework_TestCase {

    function testPlayer() {
        $player1 = new Player("John Connor", true);
        $player2 = new Player("Terminator", false);

        $this->assertTrue($player1->isHuman());
        $this->assertFalse($player2->isHuman());

        $this->assertEquals("John Connor", $player1->getName());
        $this->assertEquals("Terminator", $player2->getName());
    }
}

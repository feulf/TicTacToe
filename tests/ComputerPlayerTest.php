<?php

require_once dirname(__DIR__) . "/src/constants.php";

class ComputerPlayerTest extends PHPUnit_Framework_TestCase {

    private $winningMove = [
        [x,_,x],
        [o,_,_],
        [o,_,_]
    ];

    private $winningMoveHorizontal2 = [
        [x,o,_],
        [x,_,x],
        [o,_,o]
    ];

    private $winningMoveHorizontal3 = [
        [x,o,o],
        [_,_,o],
        [_,x,x]
    ];

    private $winningMoveVertical = [
        [x,o,x],
        [o,_,x],
        [o,_,_]
    ];

    private $winningMoveVertical2 = [
        [_,x,o],
        [o,x,o],
        [_,_,_]
    ];

    private $winningMoveVertical3 = [
        [x,o,x],
        [o,_,x],
        [o,_,_]
    ];

    private $winningMoveDiagonal = [
        [x,o,x],
        [o,x,_],
        [o,_,_]
    ];

    private $winningMoveDiagonal2 = [
        [_,o,x],
        [o,_,x],
        [x,_,o]
    ];

    private $stopNextWinnerMove = [
        [_,o,_],
        [o,x,_],
        [o,x,_]
    ];

    private $corner = [
        [_,_,_],
        [_,_,_],
        [_,_,_]
    ];

    private $corner2 = [
        [_,_,o],
        [_,_,_],
        [_,_,_]
    ];

    private $corner3 = [
        [_,_,_],
        [_,_,_],
        [o,_,_]
    ];

    private $corner4 = [
        [_,_,_],
        [_,_,_],
        [_,_,o]
    ];

    private $corner5 = [
        [x,_,_],
        [_,o,_],
        [_,_,x]
    ];

    private $corner6 = [
        [o,_,x],
        [_,x,_],
        [_,_,o]
    ];

    private $whateverAvailable = [
        [_,_,x],
        [x,_,o],
        [o,x,o]
    ];

    function testPlayer() {
        $player = new ComputerPlayer("Terminator", false);
        $this->assertFalse($player->isHuman());
        $this->assertEquals("Terminator", $player->getName());
    }

    function testWinningMoveHorizontal() {
        $player = new ComputerPlayer("CPU");
        $this->assertEquals(2, $player->winningMove($this->winningMove, x));
        $this->assertEquals(5, $player->winningMove($this->winningMoveHorizontal2, x));
        $this->assertEquals(7, $player->winningMove($this->winningMoveHorizontal3, x));
    }

    function testWinningMoveVertical() {
        $player = new ComputerPlayer("CPU");
        $this->assertEquals(9, $player->winningMove($this->winningMoveVertical, x));
        $this->assertEquals(8, $player->winningMove($this->winningMoveVertical2, x));
        $this->assertEquals(9, $player->winningMove($this->winningMoveVertical3, x));
    }

    function testWinningMoveDiagonal() {
        $player = new ComputerPlayer("CPU");
        $this->assertEquals(9, $player->winningMove($this->winningMoveDiagonal, x));
        $this->assertEquals(5, $player->winningMove($this->winningMoveDiagonal2, x));
    }

    function testStopNextWinnerMove() {
        $player = new ComputerPlayer("CPU");
        $this->assertEquals(1, $player->stopNextWinnerMove($this->stopNextWinnerMove, x));
    }

    function testTakeCorner() {
        $player = new ComputerPlayer("CPU");
        $this->assertTrue(in_array($player->takeCorner($this->corner, x), [1,3,7,9]));
        $this->assertEquals(7, $player->takeCorner($this->corner2, x));
        $this->assertEquals(3, $player->takeCorner($this->corner3, x));
        $this->assertEquals(1, $player->takeCorner($this->corner4, x));

        // it play random in the sides
        $this->assertTrue(in_array($player->computerMove($this->corner5, o), [2,4,6,8]));
        $this->assertEquals(7, $player->computerMove($this->corner6, o));
    }

    function testCenter() {
        $player = new ComputerPlayer("CPU");
        $this->assertEquals(5, $player->takeCenter($this->corner, x));
        $this->assertEquals(null, $player->takeCenter($this->winningMoveDiagonal, x));
    }

    function testTakeWhateverIsLeft() {
        $player = new ComputerPlayer("CPU");
        $this->assertEquals(1, $player->whateverAvailable($this->whateverAvailable, x));
    }


}

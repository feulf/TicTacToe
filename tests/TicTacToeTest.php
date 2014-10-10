<?php

require_once dirname(__DIR__) . "/src/constants.php";

class TicTacToeTest extends PHPUnit_Framework_TestCase {

    private $horizontal = [
        [x,x,x],
        [o,o,_],
        [o,_,_]
      ];
    
    private $vertical = [
        [x,o,o],
        [x,o,_],
        [x,_,_]
      ];
    
    private $diagonal = [
        [x,o,_],
        [o,x,_],
        [o,_,x]
      ];

    function testHorizontal() {
        $tic_tac_toe = new TicTacToe($this->horizontal);
        $this->assertEquals(x, $tic_tac_toe->getWinner());
    }

    function testVertical() {
        $tic_tac_toe = new TicTacToe($this->vertical);
        $this->assertEquals(x, $tic_tac_toe->getWinner());
    }

    function testDiagonal() {
        $tic_tac_toe = new TicTacToe($this->diagonal);
        $this->assertEquals(x, $tic_tac_toe->getWinner());
    }
}

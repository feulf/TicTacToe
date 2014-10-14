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

    private $player2_win = [
        [x,x,o],
        [x,o,_],
        [o,_,x]
    ];

    private $uncompleted = [
        [x,o,_],
        [o,_,_],
        [o,_,x]
    ];

    private $completed_no_winner = [
        [x,o,o],
        [o,x,x],
        [o,x,o]
    ];

    function testGetWinner() {
        $this->assertEquals(x, (new TicTacToe($this->horizontal))->getWinner());
        $this->assertEquals(x, (new TicTacToe($this->vertical))->getWinner());
        $this->assertEquals(x, (new TicTacToe($this->diagonal))->getWinner());
        $this->assertEquals(o, (new TicTacToe($this->player2_win))->getWinner());
        $this->assertEquals(_, (new TicTacToe($this->uncompleted))->getWinner());
        $this->assertEquals(_, (new TicTacToe($this->completed_no_winner))->getWinner());
    }

    function testIsGameCompleted() {
        $this->assertTrue((new TicTacToe($this->horizontal))->isGameCompleted());
        $this->assertTrue((new TicTacToe($this->vertical))->isGameCompleted());
        $this->assertTrue((new TicTacToe($this->diagonal))->isGameCompleted());
        $this->assertTrue((new TicTacToe($this->player2_win))->isGameCompleted());
        $this->assertFalse((new TicTacToe($this->uncompleted))->isGameCompleted());
        $this->assertTrue((new TicTacToe($this->completed_no_winner))->isGameCompleted());
    }

    function testInit() {
        $table = (new TicTacToe())->getTable();
        for ($i=0;$i<3;$i++){
            for ($j=0;$j<3;$j++){
                $this->assertEquals(_, $table[$i][$j]);
            }
        }
    }

}

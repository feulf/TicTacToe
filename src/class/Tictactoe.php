<?php

require_once dirname(__DIR__) . "/constants.php";

/**
 * Tic Tac Toe game
 */
class TicTacToe {

    private $table = [];

    function __construct($table = []) {
        $this->table = $table;
    }

    /**
     * @return boolean true if completed, false if not completed
     */
    function isGameCompleted() {
        $winner = $this->getWinner();
        if ($winner !== _) {
            return true;
        }

        for ($i=0; $i<3; $i++) {
            for ($j=0; $j<3; $j++) {
                if ($this->table[$i][$j] === _) {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * @return $winner Returns the winner id or null if no winner
     */
    function getWinner() {

        if ($winner = $this->checkHorizontal()) {
            return $winner;
        }

        if ($winner = $this->checkVertical()) {
            return $winner;
        }

        if ($winner = $this->checkDiagonal()) {
            return $winner;
        }
    }

    /**
     * @return winner
     */
    private function checkHorizontal() {
        for ($i=0; $i<3; $i++) {
            $winner = $this->table[0][$i];

            for ($j=0; $j<3; $j++) {
                if ($this->table[$i][$j] != $winner) {
                    $winner = null;
                    break;
                }
            }
            // if the winner is not null stop
            if ($winner !== null) {
                break;
            }
        }
        return $winner;
    }

    private function checkVertical() {
        for ($i=0; $i<3; $i++) {
            $winner = $this->table[$i][0];

            for ($j=0; $j<3; $j++) {
                if ($this->table[$j][$i] != $winner) {
                    $winner = null;
                    break;
                }
            }
            // if the winner is not null stop
            if ($winner !== null) {
                break;
            }
        }
        return $winner;
    }

    private function checkDiagonal() {
      
        // check the first diagonal
        $winner = $this->table[0][0];
        for ($i=0; $i<3; $i++) {
            if ($this->table[$i][$i] != $winner) {
                $winner = null;
                break;
            }
        }

        // if there's no winner check the second diagonal
        if ($winner === null) {
            $winner = $this->table[0][2];
            for ($i=0; $i<3; $i++) {
                if ($this->table[$i][2-$i] != $winner) {
                    $winner = null;
                    break;
                }
            }
        }

        return $winner;
    }

}

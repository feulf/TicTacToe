<?php

require_once dirname(__DIR__) . "/constants.php";

/**
 * Tic Tac Toe game
 */
class TicTacToe {

    private $table = [];
    private $next_player = x; // first player is player 1

    function __construct($table = []) {
        if ($table) {
            $this->table = $table;
        } else {
            $this->table = $this->initTable();
        }
    }

    function getTable() {
        return $this->table;
    }

    /**
     * @param $cell int chose the cell number
     *
     *     1 | 2 | 3
     *    -----------
     *     4 | 5 | 6
     *    -----------
     *     7 | 8 | 9
     *
     */
    function play($cell) {

        switch($cell) {
            case 1: $i = 0; $j = 0; break;
            case 2: $i = 0; $j = 1; break;
            case 3: $i = 0; $j = 2; break;
            case 4: $i = 1; $j = 0; break;
            case 5: $i = 1; $j = 1; break;
            case 6: $i = 1; $j = 2; break;
            case 7: $i = 2; $j = 0; break;
            case 8: $i = 2; $j = 1; break;
            case 9: $i = 2; $j = 2; break;
        }


        if ($this->table[$i][$j] === _) {
            $this->table[$i][$j] = $this->next_player;

            // set the next player
            $this->next_player = $this->next_player === x ? o : x;

            return true;
        } else {
            return false;
        }
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
            $winner = $this->table[$i][0];

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
            $winner = $this->table[0][$i];

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

    private function initTable() {
        $table = [];
        for ($i=0; $i<3; $i++) {
            for ($j=0; $j<3; $j++) {
                $table[$i][$j] = _;
            }
        }
        return $table;
    }

}

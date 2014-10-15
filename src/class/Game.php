<?php

require_once dirname(__DIR__) . "/constants.php";

/**
 * Player
 */
class Game {

    const COLOR_PLAYER1 = "\e[91m";
    const COLOR_PLAYER2 = "\e[95m";
    const COLOR_DEFAULT = "\e[0m";

    private $games_counter = 1,
            $win_player_1 = 0,
            $win_player_2 = 0;

    function init() {
    }

    function start() {

        $this->clearScreen();

        $player1_name = $this->input("Insert player 1 name (leave empty for computer player): ", self::COLOR_PLAYER1);
        if ($player1_name !== "") {
            $player1 = new Player($player1_name);
        } else {
            $player1 = new ComputerPlayer("Computer");
        }

        $player2_name = $this->input("Insert player 2 name (leave empty for computer player): ", self::COLOR_PLAYER2);
        if ($player2_name !== "") {
            $player2 = new Player($player2_name);
        } else {
            $player2 = new ComputerPlayer("Computer");
        }

        do {
            $winner = $this->play($player1, $player2);
            switch ($winner) {
                case x:
                    $this->win_player_1++;
                    echo self::COLOR_PLAYER1 . $player1->getName() . self::COLOR_DEFAULT . " wins the game\n";
                    break;
                case o:
                    $this->win_player_2++;
                    echo self::COLOR_PLAYER2 . $player2->getName() . self::COLOR_DEFAULT . " wins the game\n";
                    break;
                default:
                    echo "Nobody wins.";
            }
            echo "\n    Game Over     \n\n";
            $this->games_counter++;

            $play_again = strtolower($this->input("Do you want to play again? [yes]"));
        } while ( $play_again == "yes" || $play_again == "");

        echo "Goodbye\n";
        sleep(1);
        system(clear);
    }

    function play($player1, $player2) {

        $tic_tac_toe = new TicTacToe();

        echo "Do your move";
        do {

            $this->printSummary($tic_tac_toe, $player1, $player2);

            while(1) {
                if ($player1->isHuman()) {
                    $cell = $this->input($player1->getName() . " your turn: ");
                } else {
                    $cell = $player1->computerMove($tic_tac_toe->getTable(), x);
                }
                $move = $tic_tac_toe->play($cell);
                $this->printSummary($tic_tac_toe, $player1, $player2);
                if (!$move) {
                    echo "You can't do this move\n";
                } else {
                    break;
                }
            }


            if ($tic_tac_toe->getWinner() == x) {
                return x;
            }

            if ($tic_tac_toe->isGameCompleted()) {
                return false;
            }

            while(1){
                if ($player2->isHuman()) {
                    $cell = $this->input($player2->getName() . " your turn: ");
                } else {
                    $cell = $player2->computerMove($tic_tac_toe->getTable(), o);
                }
                $move = $tic_tac_toe->play($cell);
                $this->printSummary($tic_tac_toe, $player1, $player2);
                if (!$move) {
                    echo "You can't do this move\n";
                } else {
                    break;
                }
            }

            if ($tic_tac_toe->getWinner() == o) {
                return o;
            }

        } while (!$tic_tac_toe->isGameCompleted());

        // nobody win
        return _;
    }

    function printTable($tic_tac_toe, $player1, $player2) {
        $count = 1;
        $table = $tic_tac_toe->getTable();
        echo "Summary: \n";

        echo $this->games_counter . " game(s) played\n";
        echo self::COLOR_PLAYER1 . $player1->getName() . self::COLOR_DEFAULT . " vs " . self::COLOR_PLAYER2 . $player2->getName() . self::COLOR_DEFAULT . "\n";
        echo self::COLOR_PLAYER1 . $this->win_player_1 . self::COLOR_DEFAULT . "  -  " . self::COLOR_PLAYER2 . $this->win_player_2 . self::COLOR_DEFAULT . "\n";

        echo "\n\n";

        for ($i=0; $i<3; $i++) {
            if ($i>0){
                echo "-----------\n";
            }
            for ($j=0; $j<3; $j++) {
                $symbol = $count;
                if ($table[$i][$j] === x) {
                    $symbol = self::COLOR_PLAYER1 . "x" . self::COLOR_DEFAULT;
                }
                if ($table[$i][$j] === o) {
                    $symbol = self::COLOR_PLAYER2 . "o" . self::COLOR_DEFAULT;
                }
                echo " {$symbol} ";
                if ($j < 2) {
                    echo  "|";
                }
                $count++;
            }
            echo "\n";
        }
        echo "\n";

    }

    private function printSummary($tic_tac_toe, $player1, $player2) {
        $this->clearScreen();
        echo "
Tic Tac Toe
-----------
Use the number to select the cell the numbers are positioned as follows:\n
";

        $this->printTable($tic_tac_toe, $player1, $player2);


    }

    private function input($message, $color = self::COLOR_DEFAULT) {
        echo $message;
        echo $color;
        $input = trim(fgets(STDIN));
        echo self::COLOR_DEFAULT;
        return $input;
    }

    private function clearScreen() {
        system("clear");
    }

}

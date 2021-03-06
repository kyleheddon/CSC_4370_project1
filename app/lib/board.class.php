<?php
class TicTacToeBoard {
    private $board_data;

    public function __construct($board_data){
        $this->board_data = $board_data;
    }

    public function assign_value($row, $column, $value){
        $this->board_data[$row][$column] = $value;
    }

    public function get_winner(){
        $winner = $this->get_row_winner();
        if(!$winner)
            $winner = $this->get_column_winner();
        if(!$winner)
            $winner = $this->get_diagonal_winner();

        return $winner;
    }

    public function toString(){
        $b = $this->board_data;
        return
            ' | '.$b[0][0].' | '.$b[0][1].' | '.$b[0][2]." |\n".
            ' | '.$b[1][0].' | '.$b[1][1].' | '.$b[1][2]." |\n".
            ' | '.$b[2][0].' | '.$b[2][1].' | '.$b[2][2]." |\n";
    }

    public function is_tie(){
        foreach($this->board_data as $row){
            foreach($row as $cell){
                if($cell == null)
                    return false;
            }
        }
        return true;
    }

    private function get_row_winner(){
        return $this->find_horizontal_winner($this->board_data);
    }

    private function get_column_winner(){
        $b = $this->board_data;
        $data = array(
            array($b[0][0], $b[1][0], $b[2][0]),
            array($b[0][1], $b[1][1], $b[2][1]),
            array($b[0][2], $b[1][2], $b[2][2])
        );
        return $this->find_horizontal_winner($data);
    }

    private function get_diagonal_winner(){
        $b = $this->board_data;
        $winner = $this->find_winner(array($b[0][0], $b[1][1], $b[2][2]));
        if(!$winner)
            $winner = $this->find_winner(array($b[2][0], $b[1][1], $b[0][2]));

        return $winner;
    }

    private function find_horizontal_winner($rows){
        foreach($rows as $row){
            if($winner = $this->find_winner($row))
                return $winner;
        }
        return null;
    }

    private function find_winner($values){
        $winner = null;
        if($values[0] != null && $values[1] != null && $values[2] != null){
            $all = strtolower($values[0].$values[1].$values[2]);
            if($all == 'xxx')
                $winner = 'X';
            else if ($all == 'ooo')
                $winner = 'O';
        }

        return $winner;
    }

}

?>

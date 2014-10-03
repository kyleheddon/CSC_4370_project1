<?php
	class TicTacToeBoard {
		private $board_data;

		public function __construct(){
			$board_data = func_get_args();
			if($board_data){
				$this->board_data = $board_data;
			} else {
				$this->board_data = array(array(null, null, null), array(null, null, null), array(null, null, null));
			}
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

		private function get_row_winner(){
			return $this->find_straight_winner($this->board_data);
		}

		private function get_column_winner(){
			$b = $this->board_data;
			$data = array(
				array($b[0][0], $b[1][0], $b[2][0]),
				array($b[0][1], $b[1][1], $b[2][1]),
				array($b[0][2], $b[1][2], $b[2][2])
			);
			return $this->find_straight_winner($data);
		}

		private function get_diagonal_winner(){
			$b = $this->board_data;
			$winner = $this->find_winner(array($b[0][0], $b[1][1], $b[2][2]));
			if(!$winner)
				$winner = $this->find_winner(array($b[2][0], $b[1][1], $b[0][2]));

			return $winner;
		}

		private function find_straight_winner($rows){
			foreach($rows as $row){
				if($winner = $this->find_winner($row))
					return $winner;
			}
			return null;
		}

		private function find_winner($values){
			$winner = null;

			if($values[0] && $values[1] && $values[2]){
				$all = strtolower($values[0].$values[1].$values[2]);
				if($all == 'xxx')
					$winner = 'x';
				else if ($all == 'yyy')
					$winner = 'y';
			}

			return $winner;
		}

	}

?>

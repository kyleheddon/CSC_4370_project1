<?php
include 'lib/board.class.php';
function construct_board_data_arr_from_hidden_inputs(){
		$arr = array(array(null, null, null), array(null, null, null), array(null, null, null));

		for($i = 0; $i < 3; $i++){
				for($j = 0; $j < 3; $j++){
						if(isset($_POST["cell_$i$j"])){
								$value = $_POST["cell_$i$j"];
						} else {
								$value = null;
						}
						$arr[$i][$j] = $value;
				}
		}

		return $arr;
}

function addPostedCellToBoardData($board_data, $whos_turn){

}

if(isset($_POST['whos_turn'])){
		$whos_turn= $_POST['whos_turn'];
}
else{
		$whos_turn = null;
}
?>
<!DOCTYPE html>
<html>
<head>
		<title>Project 1</title>
		<link href="css/main.css" rel="stylesheet" type="text/css" />
		<meta content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" name="viewport">
</head>
<body>
<h1 id="title">Tic Tac Toe</h1>

<?php if(!$whos_turn) { ?>
		<h2>Pick Starting Player</h2>
		<form method="post">
				<select name="whos_turn">
						<option value="X">X</option>
						<option value="O">O</option>
				</select>
				<input type="submit" value="Submit" />
		</form>
<?php } else {
		$board_data = construct_board_data_arr_from_hidden_inputs();
		if(isset($_POST['cell'])) {
				$row = $_POST['cell'][0];
				$column = $_POST['cell'][1];
				$board_data[$row][$column] = $whos_turn;
				$whos_turn = strtolower($whos_turn) == 'x' ? 'O' : 'X';
		}
		$board = new TicTacToeBoard($board_data);
		if($winner = $board->get_winner()){ ?>
				<h2>Game Over - <?php echo "$winner wins";?></h2>
		<?php } else if($board->is_tie()) { ?>
				<h2>Game Over - Tie</h2>
		<?php } else { ?>
				<h2><?php echo $whos_turn; ?>'s Turn</h2>
		<?php } ?>
		<form method="post">
				<input type="hidden" name="whos_turn" value="<?php echo $whos_turn; ?>" />
				<table id="board">
						<?php for($i = 0; $i < 3; $i++){ ?>
								<tr>
										<?php for($j = 0; $j < 3; $j++){ ?>
												<td class="mark">
														<label>
																<?php if(isset($board_data[$i][$j])) { ?>
																		<input name="cell_<?php echo $i.$j; ?>" value="<?php echo $board_data[$i][$j]; ?>" type="hidden" />
																		<div class="mask"><?php echo $board_data[$i][$j]; ?></div>
																<?php } else { ?>
																		<input name="cell" value="<?php echo "$i$j"; ?>" type="radio" />
																		<div class="mask"><?php echo $whos_turn; ?></div>
																<?php } ?>
														</label>
												</td>
										<?php } ?>
								</tr>
						<?php } ?>
				</table>
				<input type="submit" value="Submit" />
		</form>
<?php } ?>
</body>
</html>

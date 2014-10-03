<?php
include 'lib/board.class.php';
$whos_turn = 'X';
// this will change each turn by checking $_POST['whos_turn']
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Project 1</title>
		<link href="css/main.css" rel="stylesheet" type="text/css" />
		<meta content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" name="viewport">
	</head>
	<body>
		<h1>Tic Tac Toe</h1>
		<h2><?php echo $whos_turn; ?>'s Turn - hello</h2>
		<form method="post">
			<input type="hidden" name="whos_turn" value="<?php echo $whos_turn; ?>" />
			<!--
				Notice ^this^ hidden input. On the first page load, this input will not
				exist and instead there will be a dropdown where the user can select who
				goes first, X or Y. They will submit, and we then save the value in a
				hidden input. We will now render the tic tac toe board. When the cell
				and whos_turn values are both submitted, we know we need to swap whos
				turn it is.
			-->
			<input type="hidden" name="cell_00" value="x" />
			<input type="hidden" name="cell_01" value="y" />
			<input type="hidden" name="cell_02" value="y" />
			<table id="board">
<?php for($i = 0; $i < 3; $i++){ ?>
				<tr>
	<?php for($j = 0; $j < 3; $j++){ ?>
					<td class="mark">
						<label>
							<input name="cell" value="<?php echo "$i$j"; ?>" type="radio" />
							<div class="mask"><?php echo $whos_turn; ?></div>
						</label>
					</td>
	<?php } ?>
				</tr>
<?php } ?>
			</table>
			<input type="submit" value="Submit" />
		</form>

		<pre><?php
				if(isset($_POST['cell'])){
					// When the form submits, the values being submitted should be
					//	whos_turn=X
					//	cell=12
					//	     ^ the first character is the row, the second is the column

					$board = new TicTacToeBoard();
					/*
						In the example above, I am constructing a new Board without passing
						previous turns' data into it. For our app, we will need to do 2
						nested for loops in order to construct a 2 dimensional array that we
						can pass into the constructor of the TicTacToeBoard. In the inner
						loop we will check if $_POST['cell_'.$i.$j] isset, and if so push
						the value into the array.

						$board_data = convert_cell_hidden_inputs_to_2_dimensional_array();
						$board = new TicTacToeBoard($board_data);
					*/


					$row = $_POST['cell'][0];
					$column = $_POST['cell'][1];
					// get the new cell that was just posted
					$board->assign_value($row, $column, $whos_turn);

					// assigning values that we know result in a win, for testing
					$board->assign_value(0, 0, $whos_turn);
					$board->assign_value(1, 1, $whos_turn);
					$board->assign_value(2, 2, $whos_turn);


					print($board->toString());
					$winner = $board->get_winner();
				}
			?></pre>
			<?php if($winner){ ?>
			<h2>Winner is <?php echo $winner; ?></h2>
			<?php } ?>
	</body>
</html>

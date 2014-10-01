<!DOCTYPE html>
<html>
	<head>
		<title>Project 1</title>
		<link href="css/main.css" rel="stylesheet" type="text/css" />
		<meta content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" name="viewport">
	</head>
	<body>
		<h1>Tic Tac Toe</h1>
		<h2>X's Turn - hello</h2>
		<form>
			<table id="board">
<?php for($i = 0; $i < 3; $i++){ ?>
				<tr>
	<?php for($j = 0; $j < 3; $j++){ ?>
					<td class="x">
						<label>
							<input name="cell" value="<?php echo "$i$j"; ?>" type="radio" />
							<div class="mask">X</div>
						</label>
					</td>
	<?php } ?>
				</tr>
<?php } ?>
			</table>
			<input type="submit" value="Submit" />
		</form>
	</body>
</html>

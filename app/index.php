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
    <form method="post">
        <select name="whos_turn">
            <option value="x">X</option>
            <option value="o">O</option>
            <select>

                <input type="submit" value="Submit" />

    </form>
<?php } else {
    $board_data = construct_board_data_arr_from_hidden_inputs();
    //echo "<pre>".print_r($board_data)."</pre>";
    if(isset($_POST['cell'])) {
        $row = $_POST['cell'][0];
        $column = $_POST['cell'][1];
        $value = $whos_turn;
        $whos_turn = strtolower($whos_turn) == 'x' ? 'o' : 'x';
        $board_data[$row][$column] = $value;
    }
    $board = new TicTacToeBoard($board_data);
    ?>

    <form method="post">
        <input type="hidden" name="whos_turn" value="<?php echo $whos_turn; ?>" />
        <table id="board">
            <?php for($i = 0; $i < 3; $i++){ ?>
                <tr>
                    <?php for($j = 0; $j < 3; $j++){ ?>
                        <td class="mark">
                            <label>
                                <?php
                                if(isset($board_data[$i][$j])) { ?>
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
    <?php if($winner = $board->get_winner()){ ?>
        <h1><?php echo "Winner is $winner";?></h1>
    <?php } else { ?>
        <h1>No winner</h1>
    <?php } ?>
<?php } ?>
</body>
</html>

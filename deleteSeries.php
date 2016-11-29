<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","robinjam-db","TJl7rNob9kTbcPSP","robinjam-db");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<style>
		a.button {
			-webkit-appearance: button;
			-moz-appearance: button;
			appearance: button;

			text-decoration: none;
			color: initial;
		}
</style>

<body>

<div>
	<?php include 'navBar.php'; ?>
</div>

<?php
	$series_id = $_POST['sID'];
	echo $series_id;
	
	if(!($stmt = $mysqli->prepare("DELETE FROM game_series WHERE series_id = ?"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	//Bound the ? from above to the integer below
	if(!($stmt->bind_param("i",$_POST['sID']))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}

	else
		echo "You have deleted from the game_series table";
	$stmt->close();
?>

</body>
</html>
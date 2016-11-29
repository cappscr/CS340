<?php
	// Turn on error reporting
	ini_set('display_errors', 'On');

	// Connect to database
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu","cappsc-db","bUPxSJyB1RecNl7q","cappsc-db");

	if($mysqli->connect_errno){
		echo "Connection error: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
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

<div>
	<?php
		$genre_id = $_POST['genreID'];
	
		if(!($stmt = $mysqli->prepare("SELECT name FROM genre
											WHERE genre_id = ?")))
			{
				echo "Prepare failed: " .$stmt->errno . " " . $stmt->error;
			}
			
			//Bound the ? from above to the integer below
			if(!($stmt->bind_param("i", $genre_id))){
			echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
			}
			
			if(!$stmt->execute())
			{
				echo "Execute failed: " .$mysqli->connect_errno . " " . $mysqli->connect_errnor;
			}
			
			//save results if you get some
			if(!$stmt->bind_result($name))
			{
				echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
	
		//create a prepopulated form
		while($stmt -> fetch())
		{
			echo 	"<form method='post' action='update-genre.php'> \n
						<fieldset>\n
							<legend>Edit the series's information</legend> \n
							<p>Title: <input type = 'text' name = 'name' value = '" . $name . "' /></p>\n
						</fieldset>\n";
			 
		}
		?>
		
		<?php echo "<p><input type = 'hidden' name = 'genreID' value = " . $genre_id . " /></p>"; ?>
		<p><input type = "submit" value = "Submit"/></p>
	</form>
</div>
</body>
</html>
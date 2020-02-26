<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 'on');

// mysqli connection via user-defined function
include('./myconnect.php');
$mysqli = get_mysqli_conn();

//Update
// updates the instrument played by a specific performer
//SQL statement 
$sql = "UPDATE Performer SET instrument = ? WHERE performer_name = ?";

//Prepared statement, stage 1: prepare

$instrument = $_GET['instrument'];
$performer = $_GET ['performer'];

//Prepared statement, stage 2: bind and execute
$stmt = $mysqli->prepare($sql);


$stmt->bind_param('ss', $instrument, $performer);


if ($stmt->execute()){
		
	
			
	//}
			$message = "Success! You have changed the instrument played by: "."" . $performer . " to " . "" . $instrument;



} else {
	echo "error";
}


//Bind result variables
/*fetch values*/

/*close statement and connection*/
$stmt->close();
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>Update Section</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<body>

<?php echo $message; ?>


<form action="webtest.php">
<input type="submit" value="Home Page">
</form>
</body>
</html>















<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 'on');

//Band- query 3
// join function: given a band, list all memebers and the instruments they play.
//mysqli connection via user-defined function
include('./myconnect.php');
$mysqli = get_mysqli_conn();

//SQL statemet
$sql = "SELECT Band.band_name, Performer.performer_name, Performer.instrument FROM Performer Natural join Performer_id Natural join Band WHERE Band.band_name= ? ";

//Prepared statement ,stage 1: prepare
$bandname = $_GET['bandname'];




//Prepare statement, stage 2: bind and execute

$stmt = $mysqli->prepare($sql);


$stmt->bind_param('s', $bandname);


if($stmt-> execute()){

//Bind result variables
$stmt->bind_result($band_name, $performer_name, $instrument);

	while ($stmt->fetch()){
		$message .= "<tr><td>$band_name</td><td>$performer_name</td><td>$instrument</td></tr>";
		
	}
}
	else{
		echo "error";
	}


// Close statement and connection
$stmt->close();
$mysqli->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>Band Information</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<body>
<table class="table table-stripeds">
<thead>
<tr>
	<th>Band Name</th>
	<th>Band Member</th>
	<th>Instrument</th>
	
</tr>
</thead>
<tbody>
<?php echo $message; ?>
</tbody>
</table>
<form action="webtest.php">
<input type="submit" value="Home Page">
</form>
</body>
</html>




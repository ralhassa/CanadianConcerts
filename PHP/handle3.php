<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 'on');

// venue- query 4
// Aggregation: given a venue name, shows a count of all the upcoming concerts at that venue
//mysqli connection via user-defined function
include('./myconnect.php');
$mysqli = get_mysqli_conn();

//SQL statemet
$sql = "SELECT Venue.venue_name, Count(Hosted_at.venue_id) FROM Hosted_at Natural Join Venue Where Venue.venue_name= ? Group by Hosted_at.venue_id";

//Prepared statement ,stage 1: prepare
$venue_count = $_GET['venue_count'];




//Prepare statement, stage 2: bind and execute

$stmt = $mysqli->prepare($sql);


$stmt->bind_param('s', $venue_count);


if($stmt-> execute()){

//Bind result variables
$stmt->bind_result($Venue_name, $Count);

	while ($stmt->fetch()){
		$message .= "<tr><td>$Venue_name</td><td>$Count</td></tr>";
		
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
  <title>Venue Information</title>
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
	<th>Venue Name</th>
	<th>Number of Upcoming Concerts</th>
	
	
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




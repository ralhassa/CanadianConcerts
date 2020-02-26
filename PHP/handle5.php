<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 'on');


//mysqli connection via user-defined function
include('./myconnect.php');
$mysqli = get_mysqli_conn();

//performer- query1
//Group by Having: given a genre, gives a list of performers within that genre that have a number of twitter followers greater than 10,000,000.
//SQL statemet
$sql = "SELECT Performer.performer_name, Performer.p_type, Social_media.social_media_handle, Social_media.twitter_followers FROM Social_media Natural Join Performer Natural Join Performer_has WHERE Performer.p_type = ? GROUP BY Performer.performer_name Having Social_media.twitter_followers > 10000000";

//Prepared statement ,stage 1: prepare
$genre = $_GET['genre'];




//Prepare statement, stage 2: bind and execute

$stmt = $mysqli->prepare($sql);


$stmt->bind_param('s', $genre);


if($stmt-> execute()){

//Bind result variables
$stmt->bind_result($performer_name, $genre, $handle, $twitter_f);

	while ($stmt->fetch()){
		$message .= "<tr><td>$performer_name</td><td>$genre</td><td>$handle</td><td>$twitter_f</td></tr>";
		
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
  <title>Performer Information</title>
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
	<th>Performer Name</th>
	<th>Genre</th>
	<th>Social Media Handle</th>
	<th>Twitter Followers</th>
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




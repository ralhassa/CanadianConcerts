<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 'on');

// mysqli connection via user-defined function
include('./myconnect.php');
$mysqli = get_mysqli_conn();

// Concert: query 2
//join function: given a province, gives you all the concerts in that province (info: performer name, city of concert, date of concert, start time of concert)
//SQL statement 
$sql = "SELECT p.performer_name, c.city, c.province, c.date, c.start_time FROM `Performer` p, `Concert` c, `Performer_plays_at` pa WHERE c.province = ? AND c.concert_id = pa.concert_id AND pa.performer_id = p.performer_id";

//Prepared statement, stage 1: prepare

$province = $_GET['province'];

//Prepared statement, stage 2: bind and execute
$stmt = $mysqli->prepare($sql);


$stmt->bind_param('s', $province);


if ($stmt->execute()){
		
	$stmt->bind_result($Performer_name, $Concert_city, $Concert_province, $Concert_date, $Concert_start_time);

	while($stmt->fetch()) {
			$message .= "<tr><td>$Performer_name</td><td>$Concert_city</td><td>$Concert_province</td><td>$Concert_date</td><td>$Concert_start_time</td></tr>";
	}


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
  <title>Concert Infromation</title>
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
	<th>City</th>
	<th>Province</th>
	<th>Concert Date</th>
	<th>Start Time</th>
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













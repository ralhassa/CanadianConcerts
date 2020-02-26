<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 'on');

// mysqli connection via user-defined function
include('./myconnect.php');
$mysqli = get_mysqli_conn();

//Concert- query 2.0
// Nested: shows a list of concerts that have a number of hosting staff that is greater than the average (info: concert ID, number of hosting staff, hosting manager)
//SQL statement 
$sql = "SELECT concert_id, num_hosting_staff, hosting_manager FROM Hosted_at WHERE Hosted_at.num_hosting_staff > (SELECT AVG(H1.num_hosting_staff) FROM Hosted_at H1)";

//Prepared statement, stage 1: prepare



//Prepared statement, stage 2: bind and execute
$stmt = $mysqli->prepare($sql);





if ($stmt->execute()){
	$stmt->bind_result($Concert_id, $num_staff,$manager);

	while($stmt->fetch()) {
			$message .= "<tr><td>$Concert_id</td><td>$num_staff</td><td>$manager</td></tr>";
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
  <title>Concert Information</title>
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
	<th>Concert ID</th>
	<th>Number of Staff Required</th>
	<th>Hosting Manager</th>
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













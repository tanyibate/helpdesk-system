<!DOCTYPE html>
<html>
<head>
<style>

</style>
</head>
<body>

<?php
$q = $_GET['q'];

$servername = "localhost";
$username = "root";
$password = "Team23";
$dbname = "Team23";

$conn = new mysqli($servername, $username, $password, $dbname);
 // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$sql="SELECT * FROM Personnel_Table WHERE Name LIKE '$q'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	
	while($row = $result->fetch_assoc()) {
		echo "<b>Name:</b>" . $row["Name"]. "<br><b>Employee ID:</b>" . $row["ID"]. "<br><b>Job Title:</b>" . $row["Job Title"]. "<br><b>Department:</b>" . $row["Department"]. "<br><b>Telephone:</b>" . $row["Telephone"]. "";
	}
	}
	
	else {
		echo " '$q' not found in employee database";
	}
$conn->close();
?>
</body>
</html>
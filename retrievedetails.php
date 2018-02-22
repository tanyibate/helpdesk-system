<?php
$servername = "localhost";
$username = "root";
$password = "Team23";
$dbname = "Team23";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
 // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
    $callername=$_POST['cID'];
			
	$sql="SELECT * FROM Personnel_Table WHERE Name LIKE '$callername'";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
	
	while($row = $result->fetch_assoc()) {
		echo "<b>Name:</b>" . $row["Name"]. "<br><b>Employee ID:</b>" . $row["ID"]. "<br><b>Job Title:</b>" . $row["Job Title"]. "<br><b>Department:</b>" . $row["Department"]. "<br><b>Telephone:</b>" . $row["Telephone"]. "";
	}
	}
	
	else {
		echo "'$callername' not found in employee database";
	}		
	
$conn->close();
?> 


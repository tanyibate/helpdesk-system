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
	$cid=$_POST['callID'];
	$ptype=$_POST['type'];
	$subtype=$_POST['subtype'];
	$details=$_POST['details'];
			
	
	 
	//if ($conn->query($sql) === TRUE) {
	//	echo "New record created successfully";
	//} else {
	//	echo "Error: Problem not logged";
	//}
	
	try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $sql="INSERT INTO Problem_Table (Call_ID, Problem_Type, Sub_Problem, Problem_Details) VALUES ('$cid','$ptype','$subtype','$details')";
   
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "New record created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
				

//$conn->close();
?> 


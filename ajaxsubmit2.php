<?php
$servername = "localhost";
                  $username = "root";
                  $password = "Team23";
                  $dbname = "Team23";
				  $ptype=$_POST['problem'];
	$subtype=$_POST['subproblem'];
	$specialist=$_POST['specialist'];
	$details=$_POST['details'];
	$hardwareserial=$_POST['hsnumber'];
	$os=$_POST['os'];
	$software=$_POST['software'];
	$cid=$_POST['callID'];
				  
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$sql = "INSERT INTO Problem_Table (Call_ID, Problem_Type, Sub_Problem, Specialist_Allocated, Problem_Details, Time_Of_Report, Date_Of_Report, Hardware_Serial, Operating_System, Software_Name) VALUES ('$cid','$ptype','$subtype','$specialist', '$details', '".date("H:i:s")."', '".date("Y-m-d")."', '$hardwareserial', '$os', '$software')";

if ($conn->query($sql) === TRUE) {
    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$sql2 = "SELECT Problems_Pending FROM Technical_Specialist WHERE Specialist_Name LIKE '$specialist'";
    $result2 = $conn->query($sql2);

 if ($result2->num_rows > 0) {
	
	 while($row = $result2->fetch_assoc()) {
		 $problemspending = $row["Problems_Pending"] ;
	 }
	 }
$problemspending = intval($problemspending);	 
$problemspending = $problemspending + 1;

$sql1 = "UPDATE Technical_Specialist SET Problems_Pending=$problemspending WHERE Specialist_Name LIKE '$specialist'";
$result1 = $conn->query($sql1);

$sql12="SELECT Problem_ID FROM Problem_Table ORDER BY Problem_ID DESC LIMIT 1";
$result12 = $conn->query($sql12);

if ($result12->num_rows > 0) {
	
	while($row = $result12->fetch_assoc()) {
		$callid = $row["Call_ID"] ;
		echo $callid;
	}
	}


?>
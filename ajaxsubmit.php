<?php
$servername = "localhost";
                  $username = "root";
                  $password = "Team23";
                  $dbname = "Team23";
				  $operatorname = $_POST['operatorname'];
                  $usernames=$_POST['ename'];
				  $calldetails=$_POST['reason'];
				  
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$sql = "INSERT INTO Calls (Caller_Name,Operator_Name,Reason,Time,Date)
VALUES ('$usernames', '$operatorname', '$calldetails','".date("H:i:s")."','".date("Y-m-d")."')";

if ($conn->query($sql) === TRUE) {
    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$sql1="SELECT Call_ID FROM Calls ORDER BY Call_ID DESC LIMIT 1";
$result1 = $conn->query($sql1);

if ($result1->num_rows > 0) {
	
	while($row = $result1->fetch_assoc()) {
		$callid = $row["Call_ID"] ;
		echo $callid;
	}
	}
	$calllogged = TRUE;
?>
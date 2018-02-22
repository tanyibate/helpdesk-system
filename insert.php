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
 
$sql = "INSERT INTO Username (ID,username, passw)
 VALUES (2,'John', 'Doe')";
 
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?> 
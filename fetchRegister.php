<?php
//fetch.php
$servername = "localhost";
$username = "root";
$password = "Team23";
$dbname = "Team23";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  echo $conn->connect_error;
}

$output = '';
if(isset($_POST["query"]))
{
 $search = $conn->real_escape_string($_POST["query"]);
 $query = "
  SELECT * FROM Calls 
  WHERE Call_ID LIKE '%".$search."%'
    
 ";
}
else
{
 $query = "
  SELECT * FROM Calls ORDER BY Problem_ID
 ";
}

$result = $conn->query($query);

if(mysqli_num_rows($result) > 0)
{
 $output .= '
  <div class="table-responsive">
  
   <table class="table table bordered" id="example">
    <tr>
     <th>Call ID</th>
     <th>Caller Name</th>
     <th>Operator Name</th>
     <th>Reason</th>
	 <th>Time</th>
	 <th>Date</th>
	
    
    </tr>
 ';
 while($row = $result->fetch_assoc())
 {
  $currentid = $row["Problem_ID"];
  $output .= '
   <tr>
    
    <td>'.$row["Call_ID"].'</td>
    <td>'.$row["Caller_Name"].'</td>
    <td>'.$row["Operator_Name"].'</td>
    <td>'.$row["Reason"].'</td>
	<td>'.$row["Time"].'</td>
	<td>'.$row["Date"].'</td>
	
   </tr>
  ';
 }
 echo $output;
}

?>
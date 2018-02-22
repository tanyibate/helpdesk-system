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
  SELECT * FROM Problem_Table WHERE (Call_ID LIKE '%".$search."%') ";
  
}
else
{
 $query = "
  SELECT * FROM Problem_Table  
 ";
}

$result = $conn->query($query);

if(mysqli_num_rows($result) > 0)
{
 $output .= '
  <div class="table-responsive">
  
   <table class="table table bordered" id="example">
    <tr>
     <th>Problem ID</th>
     <th>Call ID</th>
     <th>Problem Type</th>
     <th>Sub Type</th>
	 <th>Details</th>
	 <th>Specialist</th>
	 <th>Reported</th>
	 <th>Solved</th>
	 <th>Solution</th>
	 
    
    </tr>
 ';
 while($row = $result->fetch_assoc())
 {
  $currentid = $row["Problem_ID"];
  $specialist = $row["Specialist_Allocated"];
  $output .= '
   <tr>
    
    <td>'.$row["Problem_ID"].'</td>
    <td>'.$row["Call_ID"].'</td>
    <td>'.$row["Problem_Type"].'</td>
    <td>'.$row["Sub_Problem"].'</td>
	<td>'.$row["Problem_Details"].'</td>
	<td>'.$row["Specialist_Allocated"].'</td>
	<td>'.$row["Date_Of_Report"].'</td>
	<td>'.$row["Date_Of_Solution"].'</td>
	<td>'.$row["Solution_Details"].'</td>
	
        
   
   </tr>
  ';
 }
 echo $output;
}

?>
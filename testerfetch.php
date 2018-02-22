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
  SELECT * FROM Problem_Table 
  WHERE Problem_ID LIKE '%".$search."%'
  OR Call_ID LIKE '%".$search."%' 
  OR Problem_Type LIKE '%".$search."%' 
  OR Specialist_Allocated LIKE '%".$search."%'  
 ";
}
else
{
 $query = "
  SELECT * FROM Problem_Table ORDER BY Problem_ID
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
         <th>Select</th>
    </tr>
 ';
 while($row = $result->fetch_assoc())
 {
  $output .= '
   <tr>
    <td><form action=update.php method=post>
    <td>'.$row["Problem_ID"].'</td>
    <td>'.$row["Call_ID"].'</td>
    <td><input type=text name=SolutionDetails value='.$row["Problem_Type"].'></td>
    <td>'.$row["Sub_Problem"].'</td>
	<td>'.$row["Problem_Details"].'</td>
	<td>'.$row["Specialist_Allocated"].'</td>
	<td>'.$row["Time_Of_Report"].'</td>
	<td>'.$row["Time_Of_Solution"].'</td>
	<td>'.$row["Solution_Details"].'></td>
        <td><a href="http://google.com">Edit</a></td>
        
   
   </tr>
  ';
 }
 echo $output;
}
?>
<!-- php file that runs once login credentials are entered and redirects user to its corresponding webpage -->

<?php
$servername = "localhost";
$username = "root";
$password = "Team23";
$dbname = "Team23";

// Create connection to database
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

	// Variables assigned to username and password input form values and used in sql statement
    $uname=$_POST['uname'];
	$password=$_POST['psw'];
			
	$sql="SELECT * FROM Username WHERE username LIKE '$uname' AND passw LIKE '$password'";
	
	// query result stored in variable and number of rows counted and sotred in another variable	 
	$result = $conn->query($sql);
	$rowcount=mysqli_num_rows($result);

	// If statement checking if combination of username and password can be found on database
	// User redirected to their corresponding page if match is found for their credentials
	// If no match found, error message echoed
				
				if($rowcount==1 && $uname=='Bert23'){
					header('Location: TSBert.php');
				}
				
				elseif($rowcount==1 && $uname=='Alice23'){					
					header('Location: HomePage.php');					
				}
				
				elseif($rowcount==1 && $uname=='Clara23'){					
					header('Location: TSClara.php');					
				}	

				elseif($rowcount==1 && $uname=='Jane23'){					
					header('Location: TSJane.php');					
				}	

				elseif($rowcount==1 && $uname=='William23'){					
					header('Location: TSWilliam.php');					
				}	

				elseif($rowcount==1 && $uname=='Carl23'){					
					header('Location: TSCarl.php');					
				}	

				elseif($rowcount==1 && $uname=='Donnovan23'){					
					header('Location: TSDonnovan.php');					
				}	
				
				elseif($rowcount==1 && $uname=='Simba23'){					
					header('Location: TSSimba.php');					
				}	
				
				else{					
					echo " Unsuccessful Login ";
				}			

$conn->close();
?> 


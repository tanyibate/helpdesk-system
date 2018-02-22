<!-- Main page for technical specialist Clara displaying her pending problems and log out button
It uses an sql query searching for problems assigned to Clara where Date of Solution has not been logged
This means it is unresolved
Contribution: Roberto Trujillo -->
<html !DOCTYPE>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clara</title>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">
	<!-- Our Custom CSS -->
    <link rel="stylesheet" href="style2.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
		
	<style>
	
	@import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";

	.wrapper {
		display: flex;
		align-items: stretch;
	}
	
	body {
		font-family: 'Poppins', sans-serif;
		background: #fafafa;
	}

	p {
		font-family: 'Poppins', sans-serif;
		font-size: 1.1em;
		font-weight: 300;
		line-height: 1.7em;
		color: #999;
	}

	a, a:hover, a:focus {
		color: inherit;
		text-decoration: none;
		transition: all 0.3s;
	}

	#sidebar {
		min-width: 250px;
		max-width: 250px;
		background: #3d3d3d;
		color: #fff;
		transition: all 0.3s;
	}

	#sidebar .sidebar-header {
		padding: 20px;
		background: #4c4c4c;
	}

	#sidebar ul.components {
		padding: 20px 0;
	}

	#sidebar ul p {
		color: #fff;
		padding: 10px;
	}

	#sidebar ul li a {
		padding: 10px;
		font-size: 1.1em;
		display: block;
	}
	#sidebar ul li a:hover {
		color: #7386D5;
		background: #fff;
	}


	ul ul a {
		font-size: 0.9em !important;
		padding-left: 30px !important;
		background: #6d7fcc;
	}
	
	#sidebar.active {
		min-width: 80px;
		max-width: 80px;
		text-align: center;
	}

	/* Toggling the sidebar header content, hide the big heading [h3] and showing the small heading [strong] and vice versa*/
	#sidebar .sidebar-header strong {
		display: none;
	}
	#sidebar.active .sidebar-header h3 {
		display: none;
	}
	#sidebar.active .sidebar-header strong {
		display: block;
	}

	#sidebar ul li a {
		text-align: left;
	}

	#sidebar.active ul li a {
		padding: 20px 10px;
		text-align: center;
		font-size: 0.85em;
	}

	#sidebar.active ul li a i {
		margin-right:  0;
		display: block;
		font-size: 1.8em;
		margin-bottom: 5px;
	}

/*
 * Row with equal height columns
 * --------------------------------------------------
 */
.row-eq-height {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display:         flex;
}

/*
 * Styles copied from the Grid example to make grid rows & columns visible.
 */
.container {
  padding-right: 15px;
  padding-left: 15px;
}

h4 {
  margin-top: 25px;
}
.row {
  margin-bottom: 20px;
}
.row .row {
  margin-top: 10px;
  margin-bottom: 0;
}
[class*="col-"] {
  padding-top: 15px;
  padding-bottom: 15px;
  background-color: #fff;
  border: 1px solid #ddd;
  border: 1px solid rgba(86,61,124,.2);
}



	
    	
	</style>
	
</head>
<body>

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <!-- Bootstrap Js CDN -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!-- Custom Scroller Js CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
	
	<div class="wrapper">

		<nav id="sidebar">
			<!-- Sidebar Header -->
			<div class="sidebar-header">
				<h3>Make-It-All</h3>
			</div>

			<!-- Sidebar Links -->
			<ul class="list-unstyled components">												
				<li>
					<a href="login.html">
						<i class="glyphicon glyphicon-log-out"></i>
						Log Out
					</a>
				</li>
			</ul>
		</nav>
	
		<div id="content">
		
			<button type="button" id="sidebarCollapse" class="btn"bg-faded">
				<i class="glyphicon glyphicon-align-left"></i>
				Toggle Sidebar
			</button>
	
			<br><br>
				<div class="container">
				
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
				
				$sql = "SELECT Problem_ID, Problem_Type, Sub_Problem, Date_Of_Report, Time_Of_Report, Problem_Details  FROM Problem_Table WHERE Specialist_Allocated LIKE 'Clara Smith' && Date_Of_Solution IS NULL ";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					echo '<table class="table table bordered"><tr><th>Problem ID</th><th>Problem Type</th><th>Date Reported</th><th>Time Reported</th><th>Problem Details</th></tr>';
				
				// output data of each row
				
				while($row = $result->fetch_assoc()) {
					echo "<tr><td>" . $row["Problem_ID"]. "</td><td>" . $row["Problem_Type"]. " - " . $row["Sub_Problem"]. "</td><td>" . $row["Date_Of_Report"]. "</td><td>" . $row["Time_Of_Report"]. "</td><td>" . $row["Problem_Details"]. "</td></tr>";
				}
				
				echo "</table>";
				} 
				
				else {
					echo "No problems pending";
				}	
					
				?>

	
			</div>
	 
		</div>
     </div>
	 
	 <script>
		$(document).ready(function () {
			
		 $("#sidebar").mCustomScrollbar({
         theme: "minimal"
		});	

		$('#sidebarCollapse').on('click', function () {
			$('#sidebar').toggleClass('active');
		});

		});
	</script>
	 
</body>
</html> 

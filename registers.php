<html !DOCTYPE>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registers</title>
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
		height:100hv;
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

	
	</style>
	
	<title> Registers </title>
	
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
				
				<li class="active">
					<a href="HomePage.php">
						<i class="glyphicon glyphicon-home"></i>
						Home
					</a>
				</li>
				
				<li>
					<a href="newcall.php">
						<i class="glyphicon glyphicon-plus"></i>
						New Call
					</a>
				</li>
			   
			<li>
					<a href="ProblemsArchive.php">
						<i class="glyphicon glyphicon-pencil"></i>
						Update Problem
					</a>
				</li>	
				
				<li>
					<a href="ProblemList.php">
						<i class="glyphicon glyphicon-list-alt"></i>
						Problem List
					</a>
				</li>

				<li>
					<a href="CallArchive.php">
						<i class="glyphicon glyphicon-folder-open"></i>
						Call Archive
					</a>
				</li>
				
				<li>
					<a href="TechnicalSpecialists.php">
						<i class="glyphicon glyphicon-user"></i>
						Technical Specialists
					</a>
				</li>
				
				<li>
					<a href="registers.php">
						<i class="glyphicon glyphicon-list-alt"></i>
						Registers
					</a>
				</li>
				
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
				
				<div class="container">
				
				
					<h2>Software / Hardware Registers</h2>
					
					
					<h3>Software Register</h3>
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
				$sql1 = "SELECT * FROM Authorised_Software_Register";
				$result1 = $conn->query($sql1);

				if ($result1->num_rows > 0) {
					echo '<table class="table table bordered"><tr><th>Serial Number</th><th>Name</th><th>Type</th><th>Licensed</th></tr>';
					// output data of each row
					while($row = $result1->fetch_assoc()) {
						echo "<tr><td>" . $row["Software_Serial"]. "</td><td>" . $row["Software_Name"]. "</td><td>" . $row["Software_Type"]. "</td><td>" . $row["Licensed"]. "</td></tr>";
					}
					echo "</table>";
				}
				 else {
					echo "No software registered";
				}

				echo"<br><br>";

				$conn->close();
				?> 

				</div>



				<h3>Hardware Register</h3>

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

				$sql2 = "SELECT * FROM Equipment_Register";
				$result2 = $conn->query($sql2);

				if ($result2->num_rows > 0) {
					echo '<table class="table table bordered"><tr><th>Serial Number</th><th>Type</th><th>Make</th></tr>';
					// output data of each row
					while($row = $result2->fetch_assoc()) {
						echo "<tr><td>" . $row["Hardware_Serial"]. "</td><td>" . $row["Hardware_Type"]. "</td><td>" . $row["Hardware_Make"]. "</td></tr>";
					}
					echo "</table>";
				}
				 else {
					echo "No hardware registered";
				}


				$conn->close();
				?> 
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

<!-- This is the Helpdesk Operator (Alice) main page. Three charts will load automatically 
One pie chart displaying number of problems per problem area
One bar chart displaying number of problems solved and pneding per specialist
One bar chart displaying the average time each specialist takes to solve their assigned problems
It also displays side navigation bar that can be toogled by clicking corresponding button and that has links to other pages
She can also visualize her profile
Contributions: Bate Tanyi, Roberto Trujillo -->

<?php

// php for Problem Area Pie Chart

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

// sql queries that go through the Problems Table and count the number of rows for each problem area
// It searches for matches with Problem Type column for each Problem Area and stores value in corresponding variable  
// Variable is then echoed into is corresponding section of the pie chart 

$sql = "SELECT Problem_Type FROM Problem_Table WHERE Problem_Type Like 'Printer';";
$result = $conn->query($sql);
$count = $result->num_rows;
$sql = "SELECT Problem_Type FROM Problem_Table WHERE Problem_Type Like 'Operating System';";
$result = $conn->query($sql);
$oscount = $result->num_rows;
$sql = "SELECT Problem_Type FROM Problem_Table WHERE Problem_Type Like 'Software';";
$result = $conn->query($sql);
$softwarecount = $result->num_rows;
$sql = "SELECT Problem_Type FROM Problem_Table WHERE Problem_Type Like 'Hardware';";
$result = $conn->query($sql);
$hardwarecount = $result->num_rows;
$sql = "SELECT Problem_Type FROM Problem_Table WHERE Problem_Type Like 'Other';";
$result = $conn->query($sql);
$othercount = $result->num_rows;

?>

<?php

// php for Bar Chart of Problems Solved and Problems Completed per Technical Specialist

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

// each technical specialist has two sql statements (problems solved and pending)
// problems pending query looks through Problem Table and counts number of appearences for that specialist where the problem has no solution
// problems solved query looks through Problem Table and counts numer of appearences for that specialist where there are solution details
// each value is stored in corresponding variable and is echoed into corresponding bar in chart

$sql = "SELECT Problem_ID FROM Problem_Table WHERE Specialist_Allocated Like 'Bert Adams' && Date_Of_Solution IS NOT NULL;";
$result = $conn->query($sql);
$berts = $result->num_rows;
$sql = "SELECT Problem_ID FROM Problem_Table WHERE Specialist_Allocated Like 'Bert Adams' && Date_Of_Solution IS NULL;";
$result = $conn->query($sql);
$bertp = $result->num_rows;
$sql = "SELECT Problem_ID FROM Problem_Table WHERE Specialist_Allocated Like 'Jane Evans' && Date_Of_Solution IS NOT NULL;";
$result = $conn->query($sql);
$janes = $result->num_rows;
$sql = "SELECT Problem_ID FROM Problem_Table WHERE Specialist_Allocated Like 'Jane Evans' && Date_Of_Solution IS NULL;";
$result = $conn->query($sql);
$janep = $result->num_rows;
$sql = "SELECT Problem_ID FROM Problem_Table WHERE Specialist_Allocated Like 'Clara Smith' && Date_Of_Solution IS NOT NULL;";
$result = $conn->query($sql);
$claras = $result->num_rows;
$sql = "SELECT Problem_ID FROM Problem_Table WHERE Specialist_Allocated Like 'Clara Smith' && Date_Of_Solution IS NULL;";
$result = $conn->query($sql);
$clarap = $result->num_rows;
$sql = "SELECT Problem_ID FROM Problem_Table WHERE Specialist_Allocated Like 'William Lee' && Date_Of_Solution IS NOT NULL;";
$result = $conn->query($sql);
$williams = $result->num_rows;
$sql = "SELECT Problem_ID FROM Problem_Table WHERE Specialist_Allocated Like 'William Lee' && Date_Of_Solution IS NULL;";
$result = $conn->query($sql);
$williamp = $result->num_rows;
$sql = "SELECT Problem_ID FROM Problem_Table WHERE Specialist_Allocated Like 'Carl Jones' && Date_Of_Solution IS NOT NULL;";
$result = $conn->query($sql);
$carls = $result->num_rows;
$sql = "SELECT Problem_ID FROM Problem_Table WHERE Specialist_Allocated Like 'Carl Jones' && Date_Of_Solution IS NULL;";
$result = $conn->query($sql);
$carlp = $result->num_rows;
$sql = "SELECT Problem_ID FROM Problem_Table WHERE Specialist_Allocated Like 'Donnovan Mitchell' && Date_Of_Solution IS NOT NULL;";
$result = $conn->query($sql);
$donnovans = $result->num_rows;
$sql = "SELECT Problem_ID FROM Problem_Table WHERE Specialist_Allocated Like 'Donnovan Mitchell' && Date_Of_Solution IS NULL;";
$result = $conn->query($sql);
$donnovanp = $result->num_rows;
$sql = "SELECT Problem_ID FROM Problem_Table WHERE Specialist_Allocated Like 'Simba Reynolds' && Date_Of_Solution IS NOT NULL;";
$result = $conn->query($sql);
$simbas = $result->num_rows;
$sql = "SELECT Problem_ID FROM Problem_Table WHERE Specialist_Allocated Like 'Simba Reynolds' && Date_Of_Solution IS NULL;";
$result = $conn->query($sql);
$simbap = $result->num_rows;


?>

<?php

// php for bar chart showing average time each specialist takes to solve their assigned problems

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

// sql statement that calculates the difference between date of report and date of solution for each problem that has been solved (solution date exists)
// it then averages all these values for each technical secialist
// value stored in variable

$sql = "SELECT AVG(DATEDIFF(Date_Of_Solution, Date_Of_Report)) FROM Problem_Table WHERE Date_Of_Solution IS NOT NULL && Specialist_Allocated LIKE 'Clara Smith' ;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	
	while($row = $result->fetch_assoc()) {
		$clara = $row["AVG(DATEDIFF(Date_Of_Solution, Date_Of_Report))"] ;
	}
}
$sql = "SELECT AVG(DATEDIFF(Date_Of_Solution, Date_Of_Report)) FROM Problem_Table WHERE Date_Of_Solution IS NOT NULL && Specialist_Allocated LIKE 'Bert Adams';";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	
	while($row = $result->fetch_assoc()) {
		$bert = $row["AVG(DATEDIFF(Date_Of_Solution, Date_Of_Report))"] ;
	}
}
$sql = "SELECT AVG(DATEDIFF(Date_Of_Solution, Date_Of_Report)) FROM Problem_Table WHERE Date_Of_Solution IS NOT NULL && Specialist_Allocated LIKE 'Carl Jones';";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	
	while($row = $result->fetch_assoc()) {
		$carl = $row["AVG(DATEDIFF(Date_Of_Solution, Date_Of_Report))"] ;
	}
}
$sql = "SELECT AVG(DATEDIFF(Date_Of_Solution, Date_Of_Report)) FROM Problem_Table WHERE Date_Of_Solution IS NOT NULL && Specialist_Allocated LIKE 'Jane Evans';";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	
	while($row = $result->fetch_assoc()) {
		$jane = $row["AVG(DATEDIFF(Date_Of_Solution, Date_Of_Report))"] ;
	}
}
$sql = "SELECT AVG(DATEDIFF(Date_Of_Solution, Date_Of_Report)) FROM Problem_Table WHERE Date_Of_Solution IS NOT NULL && Specialist_Allocated LIKE 'William Lee';";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	
	while($row = $result->fetch_assoc()) {
		$william = $row["AVG(DATEDIFF(Date_Of_Solution, Date_Of_Report))"] ;
	}
}
$sql = "SELECT AVG(DATEDIFF(Date_Of_Solution, Date_Of_Report)) FROM Problem_Table WHERE Date_Of_Solution IS NOT NULL && Specialist_Allocated LIKE 'Donnovan Mitchell';";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	
	while($row = $result->fetch_assoc()) {
		$donnovan = $row["AVG(DATEDIFF(Date_Of_Solution, Date_Of_Report))"] ;
	}
}
$sql = "SELECT AVG(DATEDIFF(Date_Of_Solution, Date_Of_Report)) FROM Problem_Table WHERE Date_Of_Solution IS NOT NULL && Specialist_Allocated LIKE 'Simba Reynolds';";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	
	while($row = $result->fetch_assoc()) {
		$simba = $row["AVG(DATEDIFF(Date_Of_Solution, Date_Of_Report))"] ;
	}
}
?>


<html !DOCTYPE>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home Page</title>
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
			<!-- button to partially hide the sidebar -->
			<button type="button" id="sidebarCollapse" class="btn"bg-faded">
				<i class="glyphicon glyphicon-align-left"></i>
				Toggle Sidebar
			</button>
			
			
	<h1 class="text-center" style="font-size:50px;">Home</h1>
	
	<!-- Charts placed into continers to visualize easily -->	
	
	<div class="container-fluid">
	
	<div class="row-eq-height">
	
	<div id="piechart" class="col-sm-6">

		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

		<script type="text/javascript">
		
		
		// Load google charts
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);

		// Draw the chart and set the chart values
		function drawChart() {
		var data = google.visualization.arrayToDataTable([
		['Area', 'Problems per Area'],
		['Printer', <?php echo $count ?>],
		['Operating System', <?php echo $oscount ?>],
		['Software', <?php echo $softwarecount ?>],
		['Hardware', <?php echo $hardwarecount ?>],
		['Other', <?php echo $othercount ?>],
		]);

		// Title and width and height of the chart
		var options = {'title':'Problems per Area', 'width':650, 'height':450};

		// Display the chart inside the div> element with id="piechart"
		var chart = new google.visualization.PieChart(document.getElementById('piechart'));
		chart.draw(data, options);
		}
		</script>	
	</div>
		
		<div id="time" class="col-sm-6">
	
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script type="text/javascript">
			
			// Load google charts
			google.charts.load("current", {packages:["corechart"]});
			google.charts.setOnLoadCallback(drawChart);
			
			// Draw the chart and set the chart values
			function drawChart() {
			  var data = google.visualization.arrayToDataTable([
				["Technical Specialist", "Average Solving Time ", { role: "style" } ],
				["Clara Smith", <?php echo $clara ?>, "#0080ff"],
				["Jane Evans", <?php echo $jane ?>, "#0080ff"],
				["Carl Jones", <?php echo $carl ?>, "#0080ff"],
				["William Lee", <?php echo $william ?>, "#0080ff"],
				["Bert Adams", <?php echo $bert ?>, "#0080ff"],
				["Donnovan Mitchell", <?php echo $donnovan ?>, "#0080ff"],
				["Simba Reynolds", <?php echo $simba ?>, "#0080ff"]
			  ]);

			  var view = new google.visualization.DataView(data);
			  view.setColumns([0, 1,
							   { calc: "stringify",
								 sourceColumn: 1,
								 type: "string",
								 role: "annotation" },
							   2]);
			  
			  // Title and width and height of the chart
			  var options = {
				title: "Average time to solve a problem in days",
				width: 600,
				height: 450,
				bar: {groupWidth: "95%"},
				legend: { position: "none" },
			  };
			  
			  // Display the chart inside the div> element with id="time"
			  var chart = new google.visualization.BarChart(document.getElementById("time"));
			  chart.draw(view, options);
		  }
		</script>
	
	</div>
	</div>
	
	<div class="row-eq-height">

	<div id="bar" class="col-sm-12">
	
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script type="text/javascript">
      
		// Load google charts
		google.charts.load('current', {packages: ['corechart', 'bar']});
		google.charts.setOnLoadCallback(drawStacked);
		
		// Draw the chart and set the chart values
		function drawStacked() {
			  var data = google.visualization.arrayToDataTable([
				['TechnicalSpecialist', 'Problems Solved', 'Problems Pending'],
				['Bert Adams', <?php echo $berts ?>, <?php echo $bertp ?>],
				['Clara Smith', <?php echo $claras ?>, <?php echo $clarap ?>],
				['Carl Jones', <?php echo $carls ?>, <?php echo $carlp ?>],
				['William Lee', <?php echo $williams ?>, <?php echo $williamp ?>],
				['Jane Evans', <?php echo $janes ?>, <?php echo $janep ?>],
				['Donnovan Mitchell', <?php echo $donnovans ?>, <?php echo $donnovanp ?>],
				['Simba Reynolds', <?php echo $simbas ?>, <?php echo $simbap ?>]
			  ]);
			  
			  // Title and width and height of the chart
			  var options = {
				title: 'Problems Solved and Pending',
				chartArea: {width: 800, height:150},
				isStacked: true,
				hAxis: {
				  title: 'Total Problems',
				  minValue: 0,
				},
				vAxis: {
				  title: 'Technial Specialist'
				}
			  };
			  
			  // Display the chart inside the div> element with id="bar"
			  var chart = new google.visualization.BarChart(document.getElementById('bar'));
			  chart.draw(data, options);
			}
			
			</script>			
	</div>
	</div>

	
	</div>
	 
		</div>
	</div>
		
	<!-- function enabling bar to remain fixed and to be toogled through clicking the button -->
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
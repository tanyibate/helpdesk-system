<?php

                  $servername = "localhost";
                  $username = "root";
                  $password = "Team23";
                  $dbname = "Team23";
				  $operatorname = $_POST['operatorname'];
                  $usernames=$_POST['ename'];
				  $calldetails=$_POST['reason'];
				  $cid=$_POST['callID'];
	$ptype=$_POST['type'];
	$subtype=$_POST['subtype'];
	$specialist=$_POST['specialist'];
	$details=$_POST['details'];
	$hardwareserial=$_POST['hsnumber'];
	$os=$_POST['os'];
	$software=$_POST['software'];
	$callid = "";
	$otherspecialist = "";
	$hardwarespecialist ="";
	$softwarespecialist = "";
	$osspecialist = "";
	$printerspecialist = "";
	$problemspending = "";
	$calllogged = "";
	$output = "";
	$selectedspecialist = "";
	$specialistI = "";
	
	// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
 // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//code for autoselecting a speccialist/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$sql="SELECT Specialist_Name FROM Technical_Specialist WHERE Speciality_1 LIKE 'General' OR Speciality_2 LIKE 'General' ORDER BY Problems_Pending ASC LIMIT 1";
    $result = $conn->query($sql);
	if ($result->num_rows > 0) {
	
	while($row = $result->fetch_assoc()) {
		$otherspecialist = $row["Specialist_Name"] ;
	}
	}
	$sql="SELECT Specialist_Name FROM Technical_Specialist WHERE Speciality_1 LIKE 'Hardware' OR Speciality_2 LIKE 'Hardware' ORDER BY Problems_Pending ASC LIMIT 1";
    $result = $conn->query($sql);
	if ($result->num_rows > 0) {
	
	while($row = $result->fetch_assoc()) {
		$hardwarespecialist = $row["Specialist_Name"] ;
	}
	}
	$sql="SELECT Specialist_Name FROM Technical_Specialist WHERE Speciality_1 LIKE 'Software' OR Speciality_2 LIKE 'Software' ORDER BY Problems_Pending ASC LIMIT 1";
    $result = $conn->query($sql);
	if ($result->num_rows > 0) {
	
	while($row = $result->fetch_assoc()) {
		$softwarespecialist = $row["Specialist_Name"] ;
	}
	}
	$sql="SELECT Specialist_Name FROM Technical_Specialist WHERE Speciality_1 LIKE 'Operating System' OR Speciality_2 LIKE 'Operating System' ORDER BY Problems_Pending ASC LIMIT 1";
    $result = $conn->query($sql);
	if ($result->num_rows > 0) {
	
	while($row = $result->fetch_assoc()) {
		$osspecialist = $row["Specialist_Name"] ;
	}
	}
	$sql="SELECT Specialist_Name FROM Technical_Specialist WHERE Speciality_1 LIKE 'Printer' OR Speciality_2 LIKE 'Printer' ORDER BY Problems_Pending ASC LIMIT 1";
    $result = $conn->query($sql);
	if ($result->num_rows > 0) {
	
	while($row = $result->fetch_assoc()) {
		$printerspecialist = $row["Specialist_Name"] ;
	}
	}
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
if($_SERVER["REQUEST_METHOD"] == "GET"){
	$specialistI = $_GET['chosenspecialist'];
}
if($_SERVER["REQUEST_METHOD"] == "POST"){

if(isset($usernames) === true && $usernames !='' ) {

   
			
	$sql = "INSERT INTO Calls (Caller_Name,Operator_Name,Reason,Time,Date)
VALUES ('$usernames', '$operatorname', '$calldetails','".date("H:i:s")."','".date("Y-m-d")."')";

if ($conn->query($sql) === TRUE) {
    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$sql1="SELECT `Call_ID` FROM `Calls` WHERE `Time` = '".date("H:i:s")."'";
$result1 = $conn->query($sql1);

if ($result1->num_rows > 0) {
	
	while($row = $result1->fetch_assoc()) {
		$callid = $row["Call_ID"] ;
	}
	}
	$calllogged = TRUE;

	
			
	

}
/////////////////code to submit ptoblem detaill//////////////////////////////////////////
else if(isset($details) === true && $details !='' ) {
	
	
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

}}
///////////////////////////////////select  specialist manually//////////////////////////////////////////////////////
$output = '';
$specialistselected = '';

 $query = "SELECT Specialist_Name,Speciality_1,Speciality_2,Problems_Pending FROM Technical_Specialist";

$result = $conn->query($query);

if(mysqli_num_rows($result) > 0)
{
 $output .= '
  <div class="table-responsive">
  
   <table class="table table bordered" id="hello">
    <tr>
     <th>Specialist Name</th>
     <th>Speciality 1</th>
     <th>Speciality 2</th>
     <th>Problems Pending</th>
	 
	 
	 
	 
    
    </tr>
 ';
 while($row = $result->fetch_assoc())
 {
  
  $selectedspecialist = $row["Specialist_Name"];
  $output .= '
   <tr>
    
    <td>'.$row["Specialist_Name"].'</td>
    <td>'.$row["Speciality_1"].'</td>
    <td>'.$row["Speciality_2"].'</td>
    <td>'.$row["Problems_Pending"].'</td>
	
	
	
	
        
   
   </tr>
  ';
 }

}


?>

<html !DOCTYPE>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Call</title>
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


	.highlight { background-color: gray; }
	
	

	
	</style>
	
	<title> New Call </title>
	
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
						<i class="glyphicon glyphicon-ok"></i>
						Solve Problem
					</a>
				</li>	
				
			   <li>
					<a href="ProblemList.php">
						<i class="glyphicon glyphicon-list-alt"></i>
						Problem List
						</a>
				</li>	

				<li>
					<a href="CallArchive.html">
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
	
	
		<div class="row">
     <div class="col-sm-6">
			<h1 >New Call</h1>
					<!-- Trigger the modal with a button -->


	
					
					
					
					<div>
						
						<div class="inputs">
						     
							
							<label>Helpdesk Operator: </label>
							<input type="text" name="operatorname" value="Alice Brown"/>
							<br><br>
							
							<label> Name of Employee:</label>
							<input type="text" name="ename" onkeyup="showUser(this.value)"/>
							<br><br>
							
							<label style="vertical-align:top;">Reason for call: </label>
							<textarea name="reason" rows="2" cols="35"></textarea>
							<br><br>
							             
						
						</div>	
						
						<input id="submit" type="button" value="Submit">
						
					</div>		
				</div>
			
				<div class="col-sm-6">
			<h1 class="headings">Caller Details</h1>
				
				
				<br><br>
				
				<div  id="txtHint">
				
				</div></div></div>
						 			   
										
		 <div class="row">
		<div class="col-sm-6">
				<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
			<h1>New Problem</h1>
				
							
					<form action="newcallproblemsubmit.php" method="post">

						<div class="inputs">
							
							<label>Call ID:</label>
							<input type="text" name="callID" value="<?php echo $calltime ?>" style="width:40px;height:20px;"/>
							<br><br>
							
							<label>Problem:</label> <select name = "type" id="problem" onchange="subProblem();chooseSpecialist(this.value);hideSpecialist();" style="margin-top: 10px">
								<option >Select</option>
							    <option >Printer</option>
							    <option >Operating System</option>
							    <option >Software</option>
							    <option >Hardware</option>
								<option >Other</option>
							</select > 
							
							&nbsp;  &nbsp; <label>Sub Problem:</label><select name = "subtype" id="subproblem">
								<option id ="nosubproblem">No Sub Problem</option>
							</select>
							
							<br><br><script>
							var change = false;
function myF() {
	if(change == false)
	{
    document.getElementById("selectspecialist").style.visibility = "visible";
	change = true;
	}
	else{
		document.getElementById("selectspecialist").style.visibility = "collapse";
		change = false;
	}
}
</script>
							
							<label>Specialist:</label><input type="text" name = "specialist" id="specialist" onchange="" style="margin-top: 10px" value ="<?php echo $specialistI; ?>"  >&nbsp;  &nbsp;<button type="button" onclick="myF();">Manually Select</button>
								
							
							<br><br>
							
							<label>Hardware Serial Number (if required):</label>
							<input type="text" name="hsnumber"/>
							<br><br>						
							
							<label>Operating System (if required):</label>
							<input type="text" name="os"/>
							<br><br>
							
							<label>Software (if required):</label>
							<input type="text" name="software"/>
							<br><br>							
							
							<label style="vertical-align:top;">Problem details: </label>
							<textarea name="details" rows="2" cols="35"></textarea>
							<br><br>
							
						</div>
						
						<div class="button">
							<button type="submit" id="myBtn">Log Problem</button>
						</div>
					</form>
				</div><div class="col-sm-6" id="selectspecialist" style="visibility:collapse"><?php echo $output ?></div></div></div>
				
			
	
	<script>

  function removeOptions(selectbox)//used to remove select option so is used for subProblem()
             {
                   var i;
                   for(i = selectbox.options.length - 1 ; i >= 0 ; i--)
                       {
                          selectbox.remove(i);
                       }
             }
//using the function:

        function hideSpecialist(){
			change = false;
			document.getElementById("selectspecialist").style.visibility = "collapse";
		}

       
             
         function subProblem()
                {
					
           
           removeOptions(document.getElementById("subproblem"));
           
           var content = {printer : ["Select","Printing","Printer Software","Printer Que Cancellation","No Sub Problem"],operatingSystem:["Select","Drivers","Blue Screen","No Sub Problem"],hardware:["Select","Screen","Hard Drive","No Sub Problem"],software:["No Sub Problem"],select:["No Sub Problem"],other:["No Sub Problem"]}
       
             var e = document.getElementById("problem");
           var select = document.getElementById("subproblem"); 
             var strUser = e.options[e.selectedIndex].text;
      if (strUser=="Printer"){     
         for(var i = 0; i < content.printer.length; i++)

             {

                 var option = document.createElement("OPTION"),

                     txt = document.createTextNode(content.printer[i]);

                 option.appendChild(txt);

                 option.setAttribute("value",content.printer[i]);

                 select.insertBefore(option,select.lastChild);

             }
      }
      if (strUser=="Operating System"){    
         for(var i = 0; i < content.operatingSystem.length; i++)

             {

                 var option = document.createElement("OPTION"),

                     txt = document.createTextNode(content.operatingSystem[i]);

                 option.appendChild(txt);

                 option.setAttribute("value",content.operatingSystem[i]);

                 select.insertBefore(option,select.lastChild);

             }
      }
        else if (strUser=="Hardware"){     
         for(var i = 0; i < content.hardware.length; i++)

             {

                 var option = document.createElement("OPTION"),

                     txt = document.createTextNode(content.operatingSystem[i]);

                 option.appendChild(txt);

                 option.setAttribute("value",content.operatingSystem[i]);

                 select.insertBefore(option,select.lastChild);

             }
      }
            else if (strUser=="Software"){     
         for(var i = 0; i < content.software.length; i++)

             {

                 var option = document.createElement("OPTION"),

                     txt = document.createTextNode(content.software[i]);

                 option.appendChild(txt);

                 option.setAttribute("value",content.software[i]);

                 select.insertBefore(option,select.lastChild);

             }
      }
            else if (strUser=="Select"){     
         for(var i = 0; i < content.select.length; i++)

             {

                 var option = document.createElement("OPTION"),

                     txt = document.createTextNode(content.select[i]);

                 option.appendChild(txt);

                 option.setAttribute("value",content.select[i]);

                 select.insertBefore(option,select.lastChild);

             }
      }
	        else if (strUser=="Other"){     
         for(var i = 0; i < content.select.length; i++)

             {

                 var option = document.createElement("OPTION"),

                     txt = document.createTextNode(content.select[i]);

                 option.appendChild(txt);

                 option.setAttribute("value",content.select[i]);

                 select.insertBefore(option,select.lastChild);

             }
      }


         }
		 
		 function showUser(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","getuser.php?q="+str,true);
        xmlhttp.send();
    }
}
        function chooseSpecialist(str) {
    if (str == "Other") {
        document.getElementById("specialist").value = "<?php echo $otherspecialist ?>" ; 
        
    } 
	else if (str == "Hardware") {
        document.getElementById("specialist").value = "<?php echo $hardwarespecialist ?>" ; 
        
    } 
	else if (str == "Operating System") {
        document.getElementById("specialist").value = "<?php echo $osspecialist ?>" ; 
        
    } 
	else if (str == "Software") {
        document.getElementById("specialist").value = "<?php echo $softwarespecialist ?>" ; 
        
    } 
	else if (str == "Printer") {
        document.getElementById("specialist").value = "<?php echo $printerspecialist ?>" ; 
        
    } 
	else if (str == "Select") {
        document.getElementById("specialist").value = "" ; 
        
    } 
	
	
}

function myFunction(x) {
    rowindex = x.rowIndex;
}

$(document).ready(function(){
  
	
	
	$("#hello").on("click","tr",  function(){
        myFunction(this);
		if(rowindex !=0){
		var selected = $(this).hasClass("highlight");
        $("#hello tr").removeClass("highlight");
        if(!selected)
            $(this).addClass("highlight");
        document.getElementById("specialist").value = document.getElementById("hello").rows[rowindex].cells[0].innerHTML;
        }
    });
	
	 


});


	

</script>
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
		 $("#submit").click(function(){
var operatorname = $("#operatorname").val();
var username = $("#ename").val();
var calldetails = $("#reason").val();

// Returns successful data submission message when the entered information is stored in database.
var dataString = 'operatorname='+ operatorname + '&username='+ username + '&calldetails='+ calldetails;
if(operatorname==''||username==''||calldetails==''){

alert("Please Fill All Fields");
}
else
{
// AJAX Code To Submit Form.
$.ajax({
type: "POST",
url: "ajaxsubmit.php",
data: dataString,
cache: false,
success: function(result){
alert(result);
}
});
}
return false;
});

	});
	</script>
	
	

  </div>
</div>
</body>
</html>
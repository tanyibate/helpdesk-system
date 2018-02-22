<?php
session_start();
				  
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
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<style>
.highlight { background-color: gray; }
</script>
	
</head>
<body>
<h1>Edit Problem</h1>
				
							
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
							
							<input type="text" name = "specialist" id="specialist" onchange="" style="margin-top: 10px" value ="<?php echo $specialistI; ?>"  >&nbsp;  &nbsp;<button type="button" onclick="myF();">Assign Specialist</button>
								
							
							<br><br>
							
							<label>Hardware Serial Number (if required):</label>
							<input type="text" name="hsnumber" id="hsnumber"/>
							<br><br>						
							
							<label>Operating System (if required):</label>
							<input type="text" name="os" id="os"/>
							<br><br>
							
							<label>Software (if required):</label>
							<input type="text" name="software" id="software"/>
							<br><br>							
							
							<label style="vertical-align:top;">Problem details: </label>
							<textarea name="details" id="details" rows="2" cols="35"></textarea>
							<br><br>
							
						</div>
						
						<div class="button">
							<button type="button" id="submit2">Log Problem</button>
						</div>
					</form><div id="formsuccess2"></div><div class="col-sm-6" id="selectspecialist" style="visibility:collapse"><?php echo $output ?></div>
</body>
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
</script>
</html>
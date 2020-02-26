<!-- database connection-->
<?php
	session_start();
	require 'dbconfig/config.php';
	$intname="";
	$fname="";
	$fname_arr=array();
	$femail="";
	$femail_arr=array();
	$sname="";
	$sname_arr=array();
	$semail="";
	$semail_arr=array();
	$date="";
	$desc="";
	$index="";
?>


<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">     <!--for icons-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
	<script src="repeater.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<title>Display Internships</title>

	<style>
	html{
	  height:100%;
	}

	body {
	 margin: 0;
	 /* background: #105469; */
	 background-repeat: no-repeat;
	 background-size: cover;
	 height: 100%;
	 background-attachment: fixed;

   font-family:Lucida Bright;;
	}

	#title{
	  font-variant:small-caps;
	  font-family:Algerian;
	  color:#3b1212;
	}

	.topnav {
	 overflow: hidden;
	 background-color:#003333;
	}

	.topnav a {
	 float: left;
	 display: block;
	 color: #fbf5e9;
	 text-align: center;
	 padding: 14px 16px;
	 text-decoration: none;
	  font-size: 20px;
  font-weight:bold;
   font-family:Lucida Bright;
	}

	.topnav a:hover {
	 background-color: #fbf5e9;
	 color: #554011;
	}

	.topnav .icon_bar {
	 display: none;
	}

	@media screen and (max-width: 600px) {
	 .topnav a:not(:first-child) {display: none;}
	 .topnav a.icon_bar {
	   float: right;
	   display: block;
	 }
	}

	@media screen and (max-width: 600px) {
	 .topnav.responsive {position: relative;}
	 .topnav.responsive .icon_bar {
	   position: absolute;
	   right: 0;
	   top: 0;
	 }
	 .topnav.responsive a {
	   float: none;
	   display: block;
	   text-align: left;
	 }
	}

	 .row{
	   min-height:100%;
	 }
	 .row .col-sm-4{
	   padding:10px;
	   text-align:center;
	   -webkit-flex: 1; /* Safari */
	   -ms-flex: 1; /* IE 10 */
	   flex: 1; /* Standard syntax */
	 }
	 .row .col-sm-8{
	   min-height:100%;
	   padding:10px;

	 }

	.bttn {
	  background-image: linear-gradient(to right,#2c5887, #13263a,#13263a, #2c5887);
	  color: white;
	  cursor: pointer;
	  padding: 15px;
	  width: 90%;
	  border: none;
	  outline:none;
	  text-align: center;
	  font-weight:bold;
	  outline: none;
	  font-size: 20px;
	  border-radius:20px;
	  margin:5px;
	}
	button.bttn {
	position: -webkit-sticky;
	  position: sticky;
	  padding: 10px;
	  font-weight : bold;
	}
	.bttn:hover
	{
		color:#9fbee0;
	}

	a{
	  color:#e6f8ff;
	  text-decoration:none;
	}
	a:hover{
		color:#0385b0;
	  cursor: pointer;
	  text-decoration:none;
	}

	p{
	border:none;
	border-radius: 25px;
  border-collapse: collapse;
	background: #012B39;
	color: #9ae5fe;
	font-size: 20px;
	padding:20px 20px;
	}
p:hover{
	background: #014055;
	transition: background 0.75s ease;
}
	#year_title{
	  background: #0083b3;
		color:#80ddff;
	  text-align:center;
	  border:none;
	}

	.icon {
	  background-color: Black;
	  border: none;
	  border-radius:100%;
	  margin:3px;
	  float:right;
	  color: white;
	  padding: 8px 8px;
	  font-size: 20px;
	  cursor: pointer;
	}

	/* Darker background on mouse-over */
	.d:hover {
	  background-color:#ff1a1a;
	}
	.e:hover {
	  background-color:#2eb82e;
	}
	.icn {
	  background-color: black;
	  border: none;
	  color: white;
	  padding: 8px 8px;
	  font-size: 20px;
	  cursor: pointer;
	}
	/* Darker background on mouse-over */
	.icn:hover {
	  background-color: #006699;
	}

#content
{
	background-color: rgba(25, 51, 77,0.75);
	padding:10px;
	margin-bottom: 10px;
	border-radius: 10px;
}
	label
  {
	  color:white;
	  font-style:italic;
	  font-family:Candara;
	  font-size:20px;

  }

	input,textarea {
  background-color: transparent;
  border: none;
  border-bottom: 1px solid #CCC;
  color: #e6f8ff;
  box-sizing: border-box;
  font-family: 'Arvo';
  font-size: 18px;
}
input:focus {
  outline:none;
	border-bottom: 1px solid #006699;
}
textarea:focus{
	border: 1px solid #006699;
}

	</style>

</head>

<body style="background-image: url('image/displaybg1.jpg');">
	<!-- navbar-->
	<div class="topnav" id="myTopnav">
	  <a href="home page/index.php" class="active"><i class="fa fa-home"></i> Home</a>
	  <a href="#"><i class="fa fa-list"></i> About</a>
	  <a href="displayintp.php"><i class="fa fa-black-tie"></i> Internship</a>
	  <?php
	    			if(isset($_SESSION['email']))
	    			{
	          $email=$_SESSION['email'];
	      		$query= "SELECT `type` from usertable WHERE email='$email'" ;
	      		$result=$con->query($query);
	      		if($result->num_rows > 0)
	      		{
	      				$row=$result->fetch_assoc();
	      				if($row['type']=='student')
	    				  {
	               	echo '<a name="edit" id="edit"  href="studentprofile.php?email='.$email.'"><i class="fa fa-user"></i> My Profile </a>';
	              }
								else if($row['type']=='faculty')
								{
									echo '<a name="edit" id="edit"  href="facultyprofile.php?email='.$email.'"><i class="fa fa-user"></i> My Profile </a>';
								}
								echo "<a name='logout' id='logout'  href='logout.php' style='float:right'><i class='fa fa-sign-out'></i> Sign Out </a>";
	          }
	          }
	    			?>
					<!--<a name="edit" id="edit" href="stuform.php"><i class="fa fa-pencil"></i> Edit Profile </a>
	  			<a name='logout' id='logout'  href='logout.php' style='float:right'><i class='fa fa-sign-out'></i> Sign Out </a>-->
	  <a href="javascript:void(0);" class="icon_bar" onclick="myFunction()">
	    <i class="fa fa-bars"></i>
	  </a>
	</div>
	<script>
	function myFunction() {
	  var x = document.getElementById("myTopnav");
	  if (x.className === "topnav") {
	    x.className += " responsive";
	  } else {
	    x.className = "topnav";
	  }
	}
	</script>

	<!--Display Add internship,delete,edit buttons only when logged in-->
	<?php
	if(isset($_SESSION['email']))
	{
		$email=$_SESSION['email'];
		$query= "SELECT `type` from usertable WHERE email='$email'" ;
		$result=$con->query($query);
		if($result->num_rows > 0)
		{
				$row=$result->fetch_assoc();
				if($row['type']=='admin')
				{
					echo "<script>
						$(document).ready(function(){
						document.getElementById('addi').style.display='block';
						var icon=document.getElementsByClassName('icon');
						var i;
						for(i=0;i<icon.length;i++)
						{
							icon[i].style.display='block';
						}
					});
				</script>";
				}
		}
	}
	?>
<!-- Internsip Year buttons-->
<div class="row">
<div class="col-sm-4" >
	<form method="post" id="left">
  <button type="submit" class="bttn" name="year" value="All" id="all">All Years</button><br>
    <?php
			$sql= "SELECT `Start Date` from internshiptable ORDER BY `Start Date` DESC";
			$result=$con->query($sql);
			if($result->num_rows > 0)
			{
				while($row=$result->fetch_assoc())
				{
					$date=DateTime::createFromFormat("Y-m-d", $row['Start Date']);
					$year=$date->format("Y");
					//script to check element exists else create
					echo "<script type='text/javascript'>if(!document.getElementById('$year'))
					{
            left=document.getElementById('left');
						btn=document.createElement('BUTTON');
						btn.innerHTML='$year';
						btn.id='$year';
						btn.name='year';
						btn.value='$year';
						btn.className='bttn';
	 					btn.type='submit';
						left.appendChild(btn);
            var br=document.createElement('BR');
            left.appendChild(br);
					}</script>";
			   }
      }
		?>
	</form>
</div>
<?php
			if(isset($_POST["edit"]))
			{
				//Edit button for each internship
				$intname=$_POST['edit'];
				$query="SELECT * FROM internshiptable WHERE `Internship Name`='$intname'";
				$result=mysqli_query($con,$query);
				if($result)
				{
					if(mysqli_num_rows($result)>0)
					{
						$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
						$intname=$row["Internship Name"];
						$_SESSION['int_name']=$intname;
						$fname=$row["Faculty Name"];
						$fname_arr = explode (", ", $fname);
						$femail=$row["Faculty Email"];
						$femail_arr = explode (", ", $femail);
						$sname=$row["Student Name"];
						$sname_arr = explode (", ", $sname);
						$sroll=$row["Student Roll No"];
						$sroll_arr = explode (", ", $sroll);
						$semail=$row["Student Email"];
						$semail_arr = explode (", ", $semail);
						$date=$row["Start Date"];
						$desc=$row["Description"];
					}
				}
			}
	?>
<!--Display Internships-->
<div class="col-sm-8">
	<!--Add Internship-->
	<button name='addi' id="addi" class="icn" style="display:none"><i class="fa fa-plus-square"></i> Add Internship</button>
	<br>
	<div id="content" style="display:none">
	<!--Form to add and edit internship-->
	<form method="post">
		<label>Internship Name:</label>
		<input type="text" name="internship_name" value="<?php if(isset($_POST["edit"])){echo $intname;} ?>" required><br><br>
		<div id="faculty_repeat">
			<label>Faculty Name:</label>
			<input type="text" name="faculty_name[]" data-name="faculty_name[]" value="<?php if(isset($_POST["edit"])){echo $fname_arr[0];} ?>" required>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<label>Faculty Email:</label>
			<input type="email" name="faculty_email[]" value="<?php if(isset($_POST["edit"])){echo $femail_arr[0];} ?>" required>
			<br><br>
		</div>
		<button type="button" id="faculty_btn" class="btn btn-info">Add more faculty</button>
		<br><br>
		<div id="student_repeat">
			<label>Student Name:</label>
			<input type="text" name="student_name[]" value="<?php if(isset($_POST["edit"])){echo $sname_arr[0];} ?>" required>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<label>Student Roll No.:</label>
			<input type="number" name="student_roll_no[]" value="<?php if(isset($_POST["edit"])){echo $sroll_arr[0];} ?>" required>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<label>Student Email:</label>
			<input type="email" name="student_email[]" value="<?php if(isset($_POST["edit"])){echo $semail_arr[0];} ?>" required>
			<br><br>
		</div>
		<button type="button" id="student_btn" class="btn btn-info">Add more Student</button>
		<br><br>
		<label>Start Date:</label><input type="date" name="date" value="<?php if(isset($_POST["edit"])){echo $date;}?>" required><br><br>
		<label>Description:</label><br><textarea name="desc" rows="4" cols="100" placeholder="optional"><?php if(isset($_POST["edit"])){echo $desc;}?></textarea><br><br>
		<input type="submit" name="add" value="Insert" class="btn btn-primary btn-lg">
	</form>
	</div>

	<!--Event listener for Add Internship button-->
	<script>
		var b= document.getElementById("addi");
		b.addEventListener("click", function() {
		var content =document.getElementById("content");
		if(content.style.display=="none")
		{content.style.display="block";}
		else
		{content.style.display="none";}
		});
	</script>

	<!--Add more faculty and students-->
	<script>
		//Add faculty

		$("#faculty_btn").click(function(){
			/*var fname_arr=<?php //echo json_encode($fname_arr);?>;
			var fd=$(".faculty_div").length;*/
			$("#faculty_repeat").append('<div class="faculty_div"><label>Faculty Name:</label><input type="text" name="faculty_name[]"  value="" required>&nbsp;&nbsp;&nbsp;&nbsp;<label>Faculty Email:</label><input type="email" name="faculty_email[]" value="" required>&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="Remove" class="faculty_remove btn btn-danger"/><br><br></div>');
		});
		//Remove faculty
		$('body').on('click','.faculty_remove',function() {
			$(this).parent('div.faculty_div').remove();
		});
		//Add student
		$("#student_btn").click(function(){
			$("#student_repeat").append('<div class="student_div"><label>Student Name:</label><input type="text" name="student_name[]" value="" required>&nbsp;&nbsp;&nbsp;&nbsp;<label>Student Roll No.:</label><input type="number" name="student_roll_no[]" value="" required>&nbsp;&nbsp;&nbsp;&nbsp;<label>Student Email:</label><input type="email" name="student_email[]" value="" required>&nbsp&nbsp&nbsp&nbsp;<input type="button" value="Remove" class="student_remove btn btn-danger"/><br><br></div>');
		});
		//Remove student
		$('body').on('click','.student_remove',function() {
			$(this).parent('div.student_div').remove();
		});
	</script>

	<!--Internship details and Edit delete buttons in form-->
<div id='display'>

	<form method='post'>

		<?php

		if(isset($_POST['year']))

		{

			//pagination

			$results_per_page=10;
			$page='';

			echo "<p id='year_title'>".$_POST['year']."</p>";

			//$sql= "SELECT `Internship Name`,`Faculty Name`,`Student Name`,`Start Date`,`Description` from internshiptable ORDER BY `Start Date` DESC  ";



			if(!isset($_GET['page']))

			{

				$page=1;

			}else{

				$page=$_GET['page'];

			}

			$this_page_first_result=($page-1)*$results_per_page;
			$y=$_POST['year'];
			if($y!='All')
			{
				$sql= "SELECT * from internshiptable WHERE YEAR(`Start Date`)='$y' ORDER BY `Start Date` DESC LIMIT $this_page_first_result, $results_per_page";
			}
			else {
				$sql= "SELECT * from internshiptable ORDER BY `Start Date` DESC LIMIT $this_page_first_result, $results_per_page";
			}

			$result=$con->query($sql);

			$number_of_results=mysqli_num_rows($result);

			$number_of_pages=ceil($number_of_results/$results_per_page);

			if($result->num_rows > 0)

			{

				while($row = $result->fetch_assoc())

				{

					$date=DateTime::createFromFormat("Y-m-d", $row['Start Date']);

					$year=$date->format("Y");

					//script to check element exists else create

					if($_POST['year']=="All" || $year==$_POST['year'])

						{

							//Internship name and description

							echo "<p>Internship Name: <a class='intp'>".$row["Internship Name"]."</a><br class='desc' style='display:none;'><span class='desc' style='display:none;'>".$row["Description"]."</span><br>Faculty In-charge: ";

							//Faculty Name

							$fname_arr = explode (", ", $row["Faculty Name"]);
							$femail_arr = explode (", ", $row["Faculty Email"]);

							for($i=0;$i<count($fname_arr);$i++)

							{

								if($i!=0){

									echo ', ';

								}

								echo "<a href='facultyprofile.php?email=".$femail_arr[$i]."'>".$fname_arr[$i]."</a>";

							}

							//Student Name

							echo "<br>Students: ";

							$sname_arr = explode (", ", $row["Student Name"]);
							$semail_arr = explode (", ", $row["Student Email"]);

							for($i=0;$i<count($sname_arr);$i++)

							{

								if($i!=0){

									echo ', ';

								}

								echo "<a href='studentprofile.php?email=".$semail_arr[$i]."'>".$sname_arr[$i]."</a>";

							}

							//Edit and Delete buttons

							echo "<button type='submit' style='display:none' onClick=\"javascript: return confirm('Please confirm deletion');\" name='delete' value='".$row["Internship Name"]."'class=\"icon d\"><i class=\"fa fa-trash\"></i></button>

						<button type='submit' style='display:none' name='edit' value='".$row["Internship Name"]."'class=\"icon e\"><i class=\"fa fa-pencil\"></i></button></p>";}

				}

			}

			for($page=1;$page<=$number_of_pages;$page++)

			{

				echo'<a href="#display?page='.$page.'">'.$page.'</a>';

			}

		}

		?>

	</form>

	</div>
	</div>
</div>

<!--Internship description display on clicking internship name-->
<script>
$(function(){
$(".intp").click(function(){
	$(this).siblings('.desc').slideToggle(10);
});
});
</script>

<!--Print multiple faculty and students in edit from-->
<?php
if(isset($_POST['edit']))
{
for($i=1;$i<count($fname_arr);$i++)
{
	echo	'<script>$("#faculty_repeat").append(\'<div class="faculty_div"><label>Faculty Name:</label><input type="text" name="faculty_name[]"  value="'.$fname_arr[$i].'" required>&nbsp;&nbsp;&nbsp;&nbsp;<label>Faculty Email:</label><input type="email" name="faculty_email[]" value="'.$femail_arr[$i].'" required>&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="Remove" class="faculty_remove btn btn-danger"/><br><br></div>\');</script>';
}
for($j=1;$j<count($sname_arr);$j++)
{
	echo	'<script>$("#student_repeat").append(\'<div class="student_div"><label>Student Name:</label><input type="text" name="student_name[]" value="'.$sname_arr[$j].'" required>&nbsp;&nbsp;&nbsp;&nbsp;<label>Student Roll No.:</label><input type="number" name="student_roll_no[]" value="'.$sroll_arr[$j].'" required>&nbsp;&nbsp;&nbsp;&nbsp;<label>Student Email:</label><input type="email" name="student_email[]" value="'.$semail_arr[$j].'" required>&nbsp&nbsp&nbsp&nbsp;<input type="button" value="Remove" class="student_remove btn btn-danger"/><br><br></div>\');</script>';
}
}
?>

<?php include 'update.php';?>

</body>
</html>

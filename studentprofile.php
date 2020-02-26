<?php
	session_start();
	require 'dbconfig/config.php';
?>
<?php
if(isset($_GET['email']))
{
  $email=$_GET['email'];
  $query= "SELECT `type` from usertable WHERE email='$email'" ;
  $result=$con->query($query);
  if($result->num_rows > 0)
  {
      $row=$result->fetch_assoc();
      if($row['type']=='student')
      {
				$query_student="SELECT * FROM student WHERE `email`='$email'";
				$result_student=mysqli_query($con,$query_student);
				if($result_student)
				{
					if(mysqli_num_rows($result_student)>0)
					{
						$row1=mysqli_fetch_array($result_student,MYSQLI_ASSOC);
						$profile=$row1['Profile_Image'];
            $name=$row1['Name'];
						$about=$row1['About'];
            $dept=$row1['Department'];
            $sem=$row1['Semester'];
            $city=$row1['City'];
            $linkedin=$row1['Linkedin'];
            $github=$row1['Github'];
            $website=$row1['Website'];
            $degree=explode(", ",$row1["Edu_Degree"]);
            $instname=explode(", ",$row1["Edu_Inst_Name"]);
            $iyear=explode(", ",$row1["Edu_Year"]);
            $grade=explode(", ",$row1["Edu_Grade"]);
            $skill=explode(", ",$row1["Skills"]);
						$sdc=explode(", ",$row1["SDC_Int_Name"]);
            $ptitle=explode(", ",$row1["Project_Title"]);
            $pdesc=explode(", ",$row1["Project_Detail"]);
            $plink=explode(", ",$row1["Project_Link"]);
            $inttitle=explode(", ",$row1["Int_Name"]);
            $intdesc=explode(", ",$row1["Int_Detail"]);
            $intcerti=explode(", ",$row1["Int_Certificate"]);
					}
				}
      }
    }
}
 ?>
<html>
<head>
  <title>Student Profile</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <style>

 body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #000033;
}

.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 25px;
}

.topnav a:hover {
  background-color: #e6e6ff;
  color: black;
}

.topnav .icon {
  display: none;
}

@media screen and (max-width: 600px) {
  .topnav a:not(:first-child) {display: none;}
  .topnav a.icon {
    float: right;
    display: block;
  }
}

@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
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
  html{
    height:100%;
  }
  body{
    background-image: linear-gradient(to bottom right,#000033,#000033);
  	background-repeat: no-repeat;
    background-size: cover;
    height: 100%;
    background-attachment: fixed;
    }

      .container{
        background:white;
        width:90%;
        min-height:100%;
        position:absolute;
        left:5%;
        border:2px solid #b3b3ff;
        display: -webkit-flex; /* Safari */
    	  display: flex; /* Standard syntax */
				overflow-x:auto;
    }
    .container .row .col-sm-4{
			min-height:100%;
      padding:10px;
      background:#ccccff;
      text-align:center;
      -webkit-flex: 1; /* Safari */
      -ms-flex: 1; /* IE 10 */
      flex: 1; /* Standard syntax */
    }
    .container .row .col-sm-8{
      padding:10px;
      background:white;
    }
		td{
word-break: break-word;
		}
 .image{
  height:250px;
  width:100%;
  overflow:hidden;
}
img{
  height:250px;
}

  table,td
  {
    padding:5px;
    font-size:20px;
  }


  .nav-tabs li a{
    color:#8080ff;
    font-size:20px;
  }
  button{
    border:none;
    background:#ccccff;
  }
	a{
		color:black;
		text-decoration:none;
	}
	a:hover{
		color: #a2a2c3;
		cursor: pointer;
	  text-decoration:none;
	}


  </style>

</head>

<body>
<div class="topnav" id="myTopnav">
  <a href="home page/index.php" class="active"><i class="fa fa-home"></i> Home</a>
  <a href="#"><i class="fa fa-list"></i> About</a>
  <a href="displayintp.php"><i class="fa fa-black-tie"></i> Internship</a>
  <?php
    			if(isset($_SESSION['email']))
    			{

							$emails=$_SESSION['email'];
		      		$query= "SELECT `type` from usertable WHERE email='$emails'" ;
		      		$result=$con->query($query);
		      		if($result->num_rows > 0)
		      		{
		      				$row=$result->fetch_assoc();
									if($_SESSION['email']==$_GET['email'])
						      {
		                echo '<a name="edit" id="edit"  href="stuform.php"><i class="fa fa-pencil"></i> Edit Profile </a>';
									}
									echo "<a name='logout' id='logout'  href='logout.php' style='float:right'><i class='fa fa-sign-out'></i> Sign Out </a>";
		          }
          }
    			?>
				<!--<a name="edit" id="edit" href="stuform.php"><i class="fa fa-pencil"></i> Edit Profile </a>
  <a name='logout' id='logout'  href='logout.php' style='float:right'><i class='fa fa-sign-out'></i> Sign Out </a>-->
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
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
  <div class="container">
		<div class="row">
        <div class="col-sm-4">
          <div class="image">
            <img id="image" src="image\<?php if($profile){echo $profile;}else{echo 'placeholder.png';}?>">
            <input type="file" name="file" id="file" accept="image/gif, image/jpeg, image/png" onchange="readURL(this);" style="display:none;"/></i>
          </div>

            <h2><?php echo $name;?></h2>
            <table>
                <?php if($dept!=""){?><tr><td><i class="fa fa-bank"></i></td><td>Department: <?php echo $dept;?></td></tr>
                <?php } if($sem!=0){?><tr><td><i class="fa fa-book"></i></td><td>Semester: <?php echo $sem;?></td></tr>
                <?php } if($email!=""){?><tr><td><i class="fa fa-envelope"></i></td><td><?php echo $email;?></td></tr>
								<?php } if($city!=""){?><tr><td><i class="fa fa-map-marker"></i></td><td><?php echo $city;?></td></tr>
								<?php } ?>
            </table>

            <h2>Social</h2>
            <table>
              <?php if($linkedin!=""){?><tr><td><i class="fa fa-linkedin"></i></td><td>LinkedIn<td><td><?php echo $linkedin;?></td></tr>
						<?php }if($github!=""){?><tr><td><i class="fa fa-github"></i></td><td><?php echo $github;?></td></tr>
					<?php } if($website!=""){?><tr><td><i class="fa fa-globe"></i></td><td>Website</td><td><?php echo $website;?></td></tr>
							<?php } ?>
						</table>

        </div>
        <div class="col-sm-8">
       				<h2>About</h2>
               <p><?php echo $about;?></p>
               <hr>

               <ul class="nav nav-tabs">
                 <li class="active"><a data-toggle="tab" href="#Education">Education</a></li>
                 <li><a data-toggle="tab" href="#Skills">Skills</a></li>
                 <li><a data-toggle="tab" href="#intp">SDC Internships</a></li>
                 <li><a data-toggle="tab" href="#exp">Experience</a></li>
               </ul>

               <div class="tab-content">
                 <div id="Education" class="tab-pane fade in active">
										 <?php
										 if(count($degree)>0 && $degree[0]!="")
 										{
 											echo "<ul>";
										 for($i=0;$i<count($degree) && $degree[$i]!="";$i++)
										 {
											 echo "<li>";
											 echo "<h3>".$degree[$i]."</h3>";
											 echo " <p><h4>From ".$instname[$i]." in ".$iyear[$i]."</h4></p>";
											 echo " <p><h4>Grade ".$grade[$i]."</h4></p>";
											 echo "</li>";
										 }
 											echo "</ul>";
 										}
										  ?>
                 </div>
                 <div id="Skills" class="tab-pane fade">
									 	<?php
										if(count($skill)>0 && $skill[0]!="")
										{
											echo "<h3>Skills</h3><ul>";
									 	for($i=0;$i<count($skill);$i++)
									 	{
									 		echo "<li>";
									 		echo "<h3>".$skill[$i]."</h3>";
									 		echo "</li>";
									 	}
											echo "</ul>";
										}
									 	 ?>
                 </div>
                 <div id="intp" class="tab-pane fade">
									  <?php
										if(count($sdc)>0 && $sdc[0]!="")
										{
											echo "<h3>SDC Internships</h3><ul>";
									  for($i=0;$i<count($sdc);$i++)
									  {
									 	 echo "<li>";
									 	 echo "<a class='title'><h3>".$sdc[$i]."</h3></a>";
										 $sql= "SELECT `Description` from internshiptable WHERE `Internship Name`='$sdc[$i]'";
							 			$result=$con->query($sql);
							 			if($result->num_rows > 0)
							 			{
							 				while($row=$result->fetch_assoc())
							 				{
												echo "<p class='desc' style='display:none;font-size:20px;'>".$row['Description']."</p>";
											}
										}
									 	 echo "</li>";
									  }
											echo "</ul>";
										}
										?>
                 </div>
                 <div id="exp" class="tab-pane fade">
									  <?php
										if(count($ptitle)>0 && $ptitle[0]!="")
										{
											echo "<h3>Projects</h3><ul>";
									  for($i=0;$i<count($ptitle);$i++)
									  {
									 	echo "<li>";
									 	echo "<a class='title'><h3>".$ptitle[$i]."</h3></a>";
									 	echo "<p class='desc' style='display:none;font-size:20px;'>".$pdesc[$i]."</p>";
										echo "<a href='".$plink[$i]."'><p>".$plink[$i]."</p></a>";
										echo "</li>";
									  }
											echo "</ul>";
										}
									  ?>
									  <?php
										if(count($inttitle)>0 && $inttitle[0]!="")
										{
											echo "<h3>Internships</h3><ul>";
									  for($i=0;$i<count($inttitle);$i++)
									  {
									 	echo "<li>";
									 	echo "<a class='title'><h3>".$inttitle[$i]."</h3></a>";
									 	echo "<p class='desc' style='display:none;font-size:20px;'>".$intdesc[$i]."</p>";
										echo "<p>".$intcerti[$i]."</p>";
										echo "</li>";
									  }
											echo "</ul>";
										}
									  ?>
                 </div>
               </div>
        </div>
			</div>
  </div>
	<!--Internship description display on clicking internship name-->
	<script>
	$(function(){
	$(".title").click(function(){
		$(this).siblings('.desc').slideToggle(10);
	});
	});
	</script>
</body>
</html>

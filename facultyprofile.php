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
      if($row['type']=='faculty')
      {
				$query_faculty="SELECT * FROM faculty WHERE `email`='$email'";
				$result_faculty=mysqli_query($con,$query_faculty);
				if($result_faculty)
				{
					if(mysqli_num_rows($result_faculty)>0)
					{
						$row1=mysqli_fetch_array($result_faculty,MYSQLI_ASSOC);
            $name=$row1['Name'];
            $about=$row1['About'];
            $dept=$row1['Department'];
			      $desig=$row1['Designation'];
            $profile=$row1['Profile_Image'];
			     	$course=explode(", ",$row1["Course"]);
			     	$research=explode(", ",$row1["Research"]);
            $degree=explode(", ",$row1["Edu_Degree"]);
            $instname=explode(", ",$row1["Edu_Inst"]);
            $iyear=explode(", ",$row1["Edu_Year"]);
            $pubtitle=explode(", ",$row1["Pub_Title"]);
            $pubdesc=explode(", ",$row1["Pub_Desc"]);
            $publink=explode(", ",$row1["Pub_Link"]);
            $inttitle=explode(", ",$row1["Intp_name"]);
					}
				}
      }
    }
}
 ?>
<html>
<head>
  <title>Faculty Profile</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
   body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #1f262e;
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
    background-image: linear-gradient(to bottom right, #1f262e, #48586a);
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
#image{
  height:250px;
}

  table,td
  {
    padding:5px;
    font-size:22px;
  }


  .nav-tabs li a{
    color:#8080ff;
    font-size:20px;
  }
  button{
    border:none;
    background:#c2d1f0;;
  }
  </style>
  <script>
  function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

</head>

<body>
<div class="topnav" id="myTopnav">
  <a href="home page/index.php" class="active"><i class="fa fa-home"></i> Home</a>
  <a href="displayintp.php"><i class="fa fa-black-tie"></i> Internship</a>
  <?php
    			if(isset($_SESSION['email']))
    			{
          $emailf=$_SESSION['email'];
      		$query= "SELECT `type` from usertable WHERE email='$emailf'" ;
      		$result=$con->query($query);
      		if($result->num_rows > 0)
      		{
      				$row=$result->fetch_assoc();
							if($_SESSION['email']==$_GET['email'])
							{
								echo '<a name="edit" id="edit"  href="facultyform.php"><i class="fa fa-pencil"></i> Edit Profile </a>';
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
      <?php if($dept!=""){?><tr><td><i class="fa fa-book"></i></td><td>Department: <?php echo $dept;?></td></tr>
      <?php }if($desig!=""){?><tr><td><i class="fas fa-chalkboard-teacher"></i></td><td><?php echo $desig;?></td></tr>
			<?php }if($email!=""){?><tr><td><i class="fa fa-envelope"></i></td><td><?php echo $email;?></td></tr>
			<?php } ?>
			</table>
  </div>
  <div class="col-sm-8">
		<h2>About</h2>
		<p><?php echo $about;?></p>
    <hr>
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#PersonalProfile">Personal Profile</a></li>
        <li><a data-toggle="tab" href="#Publications">Publications</a></li>
				<li><a data-toggle="tab" href="#intps_offered">Internships Offered</a></li>
        <!--<li><a data-toggle="tab" href="#exp">Experience</a></li>-->
    </ul>
      <div class="tab-content">
        <div id="PersonalProfile" class="tab-pane fade in active">
          <ul>
						<?php if(count($course)>0 && $course[0]!=""){ ?>
            <li>
              <h3>Courses Taught</h3>
              <ul>
								<?php
								for($i=0;$i<count($course) && $course[$i]!="";$i++)
								{
									echo "<li>";
									echo "<h4>".$course[$i]."</h4>";
									echo "</li>";
								}
								 ?>
							</ul>
            </li>
					<?php }
					if(count($research)>0 && $research[0]!=""){
					 ?>
            <li>
              <h3>Reasearch Interests</h3>
							<ul>
								<?php
								for($i=0;$i<count($research) && $research[$i]!="";$i++)
								{
									echo "<li>";
									echo "<h4>".$research[$i]."</h4>";
									echo "</li>";
								}
								 ?>
							</ul>

            </li>
					<?php }
					if(count($degree)>0 && $degree[0]!=""){
					 ?>
            <li>
              <h3>Career and Education</h3>
							<ul>
								<?php
								for($i=0;$i<count($degree) && $degree[$i]!="";$i++)
								{
									echo "<li>";
									echo "<h3>".$degree[$i]."</h3>";
									echo " <p><h4>From ".$instname[$i]." in ".$iyear[$i]."</h4></p>";
									echo "</li>";
								}
								 ?>
							</ul>
            </li>
					<?php } ?>
          </ul>

        </div>
        <div id="Publications" class="tab-pane fade">
				<?php
				if(count($pubtitle)>0 && $pubtitle[0]!=""){
				 ?>
          <h3>Publications</h3>
					<ul>
					 <?php
					 for($i=0;$i<count($pubtitle) && $pubtitle[$i]!="";$i++)
					 {
					 echo "<li>";
					 echo "<a class='title'><h3>".$pubtitle[$i]."</h3></a>";
					 echo "<p class='desc' style='display:none;font-size:20px;'>".$pubdesc[$i]."</p>";
					 echo "<a href='".$publink[$i]."'><p>".$publink[$i]."</p></a>";
					 echo "</li>";
					 }
					 ?>
					</ul>
				<?php } ?>
        </div>
				<div id="intps_offered" class="tab-pane fade">
					<?php
					if(count($inttitle)>0 && $inttitle[0]!=""){
					 ?>
          <h3>SDC Internships</h3>
					<ul>
					 <?php
					 for($i=0;$i<count($inttitle) && $inttitle[$i]!="";$i++)
					 {
						echo "<li>";
						echo "<a class='title'><h3>".$inttitle[$i]."</h3></a>";
						$sql= "SELECT `Description` from internshiptable WHERE `Internship Name`='$inttitle[$i]'";
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
					 ?>
					</ul>
					<?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
$(function(){
$(".title").click(function(){
	$(this).siblings('.desc').slideToggle(10);
});
});
</script>
</body>

</html>

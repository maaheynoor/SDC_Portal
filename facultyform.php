<?php
  session_start();
  require 'dbconfig/config.php';
?>
<?php
if(isset($_SESSION['email']))
{
  $email=$_SESSION['email'];
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
  <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="jquery.min.js"></script>
  <script src="bootstrap.min.js"></script>
  <script src="Croppie/croppie.js"></script>
  <link rel="stylesheet" href="bootstrap.min.css" />
  <link rel="stylesheet" href="Croppie/croppie.css" />



  <style>
   body {
  margin: 0;

}

.topnav {
  overflow: hidden;
  background-color:#00284d;
}

.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 25px;
  font-weight:bold;
   font-family:Lucida Bright;
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
    background-image: linear-gradient(to bottom right, #00284d,#00284d);
	background-repeat: no-repeat;
  background-size: cover;
  width: 100%;
    height: 100%;
	background-attachment:fixed;
  }
  .contain{
    background:#e6fff2;
    width:90%;
    position:absolute;
    left:5%;
    border:2px solid #b3b3ff;
    border-radius:15px;
    padding:30px;
  }
  .split {
    height: 100%;
    position:absolute;
    top:0;
    overflow-x: hidden;
    padding:10px;
  }
  .left{
    width:30%;
    left:0px;
    background:#a3c2c2;
    text-align:center;
    border-top-left-radius:20px;
    border-bottom-left-radius: 20px;
  }
.image{
  height:200px;
  width:100%;
  overflow:hidden;
}
#stu_profile_image
{
  height:250px;
}
  table,td
  {
    padding:5px;
    font-size:20px;
  }
  .right{
    width:70%;
    right:0px;
    background:white;
    border-top-right-radius:20px;
    border-bottom-right-radius: 20px;
  }
  .nav-tabs li a{
    color:#a3c2c2;
    font-size:20px;
  }

  fieldset{
	  padding:10px;
	  margin:15px;

  }
  button{
	  font-size:25px;
	  color: #660066;
	  font-weight:bold;
	  font-family:Lucida Bright;
	  border:none;
    background:#e6fff2;

  }
  label
  {
	  font-size:23px;
	  color:#990073;
	  font-style:italic;
	  font-family:Candara;
	  font-weight:900;
  }

  input{
	  font-size:20px;
	  font-family:Geneva;
	  padding:5px;
  }
  .toggle-btn
  {
    margin:10px;
    border-radius:10px;
	-webkit-transition: .3s all ease-in-out;
  -o-transition: .3s all ease-in-out;
  transition: .3s all ease-in-out;
  }
  .form
  {
    display:none;
  }
  button:focus{
    border:none;
    outline:none;
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
          $email=$_SESSION['email'];
      		$query= "SELECT `type` from usertable WHERE email='$email'" ;
      		$result=$con->query($query);
      		if($result->num_rows > 0)
      		{
      				$row=$result->fetch_assoc();
      				if($row['type']=='faculty')
    				  {
						   echo '<a name="edit" id="edit"  href="facultyprofile.php?email='.$email.'"><i class="fa fa-user"></i> My Profile </a>';
                echo "<a name='logout' id='logout'  href='logout.php' style='float:right'><i class='fa fa-sign-out'></i> Sign Out </a>";
              }
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
<div class="contain">
  <div class="panel panel-info">
    <div class="panel-heading">Select Profile Image</div>
    <div class="panel-body" align="left">
     <img src="image\<?php if($profile){echo $profile;}else{echo 'placeholder.png';}?>" onclick="upload()" id="stu_profile_image" title="Click to change profile picture">
     <input type="file" name="upload_image" id="upload_image" accept="image/*" style="display:none">
    </div>
   </div>
<div>
  <button class="toggle-btn"><i class="fa fa-lock" style="font-size:36px"></i> Change Password</button>
  <form class="form" method="post" action="facsubmit.php">
    <label>Current Password:</label><input type="password" name="curr_pass" required><br><br>
    <label>New Password:</label><input type="password" name="new_pass" required><br><br>
    <label>Confirm New Password:</label><input type="password" name="cnew_pass" required><br><br>
    <input type="submit" name="password" class="btn btn-success btn-lg" value="Confirm">
  </form>
</div>
  <div>
    <button class="toggle-btn"><i class="fa fa-user" style="font-size:36px"></i> Personal Information</button>
    <form class="form" method="post" action="facsubmit.php">
      <label>Name:</label><input type="textbox" name="name"  value="<?php echo $name; ?>" required><br><br>
      <textarea rows=5 cols=100 placeholder="About You" name="about" ><?php echo $about; ?></textarea><br><br>
      <label>Department:</label><input type="textbox" name="dept" value="<?php echo $dept; ?>" required><br><br>
      <label>Designation:</label><input type="textbox" name="desig" value="<?php echo $desig; ?>" required><br><br>
      <input type="submit" name="pinfo" class="btn btn-success btn-lg" value="Submit">
    </form>
  </div>
  <div>
    <button class="toggle-btn"><i class="fas fa-chalkboard-teacher" style="font-size:36px"></i> Courses Taught</button>
    <form class="form" method="post" action="facsubmit.php">
      <div id="course_repeat">
        <input type="text" name="course[]" value="<?php echo $course[0]; ?>"><br><br>
      </div>
      <input type="button"  class="btn btn-primary btn-lg" value="+Add Courses Taught" id="course"><br><br>
      <input type="submit" name="courses" class="btn btn-success btn-lg" value="Submit">
    </form>
  </div>
  <div>
    <button class="toggle-btn"><i class="fas fa-desktop" style="font-size:36px"></i> Research Interests</button>
    <form class="form" method="post" action="facsubmit.php">
      <div id="research_repeat">
        <input type="text" name="research[]" value="<?php echo $research[0]; ?>"><br><br>
      </div>
      <input type="button"  class="btn btn-primary btn-lg" value="+Add Research Interests" id="research"><br><br>
      <input type="submit" name="research_btn" class="btn btn-success btn-lg" value="Submit"><br><br>
    </form>
  </div>
  <div>
     <button class="toggle-btn"><i class="fa fa-mortar-board" style="font-size:36px"></i> Academic Qualification</button>
	   <form class="form" method="post" action="facsubmit.php">
	  <div id="acad_repeat">
        <label>Degree:</label>
        <input type="text" name="degree[]" value="<?php echo $degree[0]; ?>"><br><br>
        <label>Institute Name:</label>
        <input type="text" name="instname[]" value="<?php echo $instname[0]; ?>"><br><br>
        <label>Year of passing:</label>
        <input type="month" name="iyear[]" value="<?php echo $iyear[0]; ?>"><br><br>
    	</div>
      <br>
      <input type="button" class="btn btn-primary btn-lg" id="acad" value="+Add Qualification"><br><br>
      <input type="submit" name="acad" class="btn btn-success btn-lg" value="Submit">
    </form>
	</div>
  <div>
    <button class="toggle-btn"><i class="fas fa-print" style="font-size:36px"></i> Publications</button>
    <form class="form" method="post" action="facsubmit.php">
      <div id="publ_repeat">
        <label>Title:</label><input type="text" placeholder="Title" name="pubtitle[]" value="<?php echo $pubtitle[0]; ?>"><br><br>
        <textarea rows=5 cols=100 placeholder="Description" name="pubdesc[]" ><?php echo $pubdesc[0]; ?></textarea><br><br>
		    <label>Publication Link:</label><input type="text" placeholder="Publication Link" name="publink[]" value="<?php echo $publink[0]; ?>"><br><br>
      </div>
      <br>
      <input type="button"  class="btn btn-primary btn-lg" value="+Add Publications" id="publ"><br><br>
      <input type="submit" name="publication" class="btn btn-success btn-lg" value="Submit">
    </form>
  </div>
</div>
 <script>

    //form toggle
    $(function(){
    $(".toggle-btn").click(function(){
      $(this).siblings('.form').slideToggle(500);
    });
    });

		//Add degree
		$("#acad").click(function(){
			$("#acad_repeat").append('<div class="acad_div"><label>Degree:</label><input type="text" name="degree[]" ><br><br><label>Institute Name:</label><input type="text" name="instname[]" ><br><br><label>Year of passing:</label><input type="month" name="iyear[]"><br><br><input type="button" value="Remove" class="acad_remove btn btn-danger btn-lg"/><br></div>');
		});
		//Remove degree
		$('body').on('click','.acad_remove',function() {
			$(this).parent('div.acad_div').remove();
		});
		//Add Courses Taught
		$("#course").click(function(){
			$("#course_repeat").append('<div class="course_div"><input type="text" name="course[]">&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="Remove" class="course_remove btn btn-danger"/><br><br></div>');
		});
		//Remove Courses Taught
		$('body').on('click','.course_remove',function() {
			$(this).parent('div.course_div').remove();
		});
		//Add Research Interest
		$("#research").click(function(){
			$("#research_repeat").append('<div class="research_div"><input type="text" name="research[]">&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="Remove" class="research_remove btn btn-danger"/><br><br></div>');
		});
		//Remove Research Interest
		$('body').on('click','.research_remove',function() {
			$(this).parent('div.research_div').remove();
		});
    //Add Publications
		$("#publ").click(function(){
			$("#publ_repeat").append('<div class="publ_div"><label>Title:</label><input type="text" placeholder="Title" name="pubtitle[]"><br><br><textarea rows=5 cols=100 placeholder="Description" name="pubdesc[]"></textarea><br><br><label>Publication Link:</label><input type="text" placeholder="Publication Link" name="publink[]"><br><br><input type="button" value="Remove" class="publ_remove btn btn-danger btn-lg"/><br><br></div>');
		});
		//Remove Publications
		$('body').on('click','.publ_remove',function() {
			$(this).parent('div.publ_div').remove();
		});
	</script>
<?php
  //Print multiple acad,skills,project and internships in faculty profile form
  for($i=1;$i<count($degree);$i++)
  {
    echo	'<script>$("#acad_repeat").append(\'<div class="acad_div"><label>Degree:</label><input type="text" name="degree[]" value="'.$degree[$i].'"><br><br><label>Institute Name:</label><input type="text" name="instname[]" value="'.$instname[$i].'"><br><br><label>Year of passing:</label><input type="month" name="iyear[]" value="'.$iyear[$i].'"><br><br><input type="button" value="Remove" class="acad_remove btn btn-danger btn-lg"/><br></div>\');</script>';
  }
  for($i=1;$i<count($course);$i++)
  {
    echo '<script>$("#course_repeat").append(\'<div class="course_div"><input type="text" name="course[]" value="'.$skill[$i].'">&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="Remove" class="course_remove btn btn-danger"/><br><br></div>\');</script>';
  }
  for($i=1;$i<count($pubtitle);$i++)
  {
    echo	'<script>$("#publ_repeat").append(\'<div class="publ_div"><label>Title:</label><input type="text" placeholder="Title" name="pubtitle[]" value="'.$pubtitle[$i].'"><br><br><textarea rows=5 cols=100 placeholder="Description" name="pubdesc[]" value="'.$pubdesc[$i].'"></textarea><br><br><label>Publication Link:</label><input type="text" placeholder="Publication Link" name="publink[]" value="'.$publink[$i].'"><br><br><input type="button" value="Remove" class="publ_remove btn btn-danger btn-lg"/><br><br></div>\');</script>';
  }
  ?>

</body>
</html>

<div id="uploadimageModal" class="modal" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Upload & Crop Image</h4>
        </div>
        <div class="modal-body">
        <div id="image_demo" style="width:350px; height:500px; margin-top:30px"></div>
        <button class="btn btn-success crop_image">Crop & Upload Image</button>
        </div>
        </div>
     </div>
    </div>


<script>
function upload(){
  document.querySelector('#upload_image').click();
}

$(document).ready(function(){

 $image_crop = $('#image_demo').croppie({
    enableExif: true,
    viewport: {
      width:150,
      height:150,
      type:'square' //circle
    },
    boundary:{
      width:400,
      height:400
    }
  });

  $('#upload_image').on('change', function(){
    var reader = new FileReader();
    reader.onload = function (event) {
      $image_crop.croppie('bind', {
        url: event.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
    $('#uploadimageModal').modal('show');
  });

  $('.crop_image').click(function(event){
    $image_crop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function(response){
      $.ajax({
        url:"facsubmit.php",
        type: "POST",
        data:{"image": response},
        success:function(data)
        {
          $('#uploadimageModal').modal('hide');

        }
      });
    })
  });

});
</script>

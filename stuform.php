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
    background-image: linear-gradient(to bottom right, #330033,#330033);
	background-repeat: no-repeat;
  background-size: cover;
  width: 100%;
    height: 100%;
	background-attachment:fixed;
  }
  .container{
    background:#e6fff2;
    width:90%;
    left:5%;
    top:15%;
    border:2px solid #b3b3ff;
    border-radius:15px;
    padding:30px;
    overflow-x:auto;
  }

.image{
  height:200px;
  width:100%;
  overflow:hidden;
}

  table,td
  {
    padding:5px;
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
#stu_profile_image
{
  height:250px;
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
      				if($row['type']=='student')
    				  {
						   echo '<a name="edit" id="edit"  href="studentprofile.php?email='.$email.'"><i class="fa fa-user"></i> My Profile </a>';
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
<div class="container">
    <button class="toggle-btn" onclick="upload()"><i class="fa fa-picture-o" style="font-size:36px"> Change Profile Image</i></button><br><br>
       <img src="image\<?php if($profile){echo $profile;}else{echo 'placeholder.png';}?>" onclick="upload()" id="stu_profile_image" title="Click to change profile picture">
       <input type="file" name="upload_image" id="upload_image" accept="image/*" style="display:none">

  <div>
    <button class="toggle-btn"><i class="fa fa-lock" style="font-size:36px"> Change Password</i></button>
    <form class="form" method="post" action="stusubmit.php">
      <label>Current Password:</label><input type="password" name="curr_pass" required><br><br>
      <label>New Password:</label><input type="password" name="new_pass" required><br><br>
      <label>Confirm New Password:</label><input type="password" name="cnew_pass" required><br><br>
      <input type="submit" name="password" class="btn btn-success btn-lg" value="Confirm">
    </form>
  </div>
  <div>
    <button class="toggle-btn"><i class="fa fa-user" style="font-size:36px"> Personal Information</i></button>
    <form class="form" method="post" action="stusubmit.php">
      <label>Name:</label><input type="textbox" name="name"  value="<?php echo $name; ?>" required><br><br>
      <textarea rows=5 cols=100 placeholder="About You" name="about" ><?php echo $about; ?></textarea><br><br>
      <label>Department:</label><input type="textbox" name="dept" value="<?php echo $dept; ?>" required><br><br>
      <label>Semester:</label><input type="textbox" name="sem" value="<?php echo $sem; ?>" required><br><br>
      <label>City:</label><input type="textbox" name="city" value="<?php echo $city; ?>" required><br><br>
      <input type="submit" name="pinfo" class="btn btn-success btn-lg" value="Submit">
    </form>
  </div>
  <div>
    <button class="toggle-btn"><i class="fa fa-comments-o" style="font-size:36px"> Social</i></button>
    <form class="form" method="post" action="stusubmit.php">
      <label>LinkedIn:</label><input type="textbox" name="linkedin" value="<?php echo $linkedin; ?>"><br><br>
      <label>Github:</label><input type="textbox" name="github" value="<?php echo $github; ?>"><br><br>
      <label>Website:</label><input type="textbox" name="website" value="<?php echo $website; ?>"><br><br>
      <input type="submit" name="social" class="btn btn-success btn-lg" value="Submit">
    </form>
  </div>
  <div>
    <button class="toggle-btn"><i class="fa fa-mortar-board" style="font-size:36px">Academic Qualification</i></button>
    <form class="form" method="post" action="stusubmit.php">
      <div id="acad_repeat">
        <label>Degree:</label>
        <input type="text" name="degree[]" value="<?php echo $degree[0]; ?>"><br><br>
        <label>Institute Name:</label>
        <input type="text" name="instname[]" value="<?php echo $instname[0]; ?>"><br><br>
        <label>Year of passing:</label>
        <input type="month" name="iyear[]" value="<?php echo $iyear[0]; ?>"><br><br>
        <label>Percentage or CGPA:</label>
    	  <input type="text" name="grade[]" value="<?php echo $grade[0]; ?>"><br><br>
    	</div>
      <br>
      <input type="button" class="btn btn-primary btn-lg" id="acad" value="+Add Qualification"><br><br>
      <input type="submit" name="acad" class="btn btn-success btn-lg" value="Submit">
    </form>
  </div>
  <div>
    <button class="toggle-btn"><i class="fa fa-magic" style="font-size:36px"> Skills</i></button>
    <form class="form" method="post" action="stusubmit.php">
      <div id="skill_repeat">
        <input type="text" name="skill[]" value="<?php echo $skill[0]; ?>"><br><br>
      </div>
      <input type="button"  class="btn btn-primary btn-lg" value="+Add Skills" id="skill"><br><br>
      <input type="submit" name="skills" class="btn btn-success btn-lg" value="Submit">
    </form>
  </div>
  <div>
    <button class="toggle-btn"><i class="fa fa-puzzle-piece" style="font-size:36px"> Projects</i></button>
    <form class="form" method="post" action="stusubmit.php">
      <div id="project_repeat">
        <label>Title:</label><input type="text" placeholder="Title" name="ptitle[]" value="<?php echo $ptitle[0]; ?>"><br><br>
        <textarea rows=5 cols=100 placeholder="Description" name="pdesc[]" ><?php echo $pdesc[0]; ?></textarea><br><br>
		    <label>Project Link:</label><input type="text" placeholder="Project Link" name="plink[]" value="<?php echo $plink[0]; ?>"><br><br>
      </div>
      <br>
      <input type="button"  class="btn btn-primary btn-lg" value="+Add Projects" id="project"><br><br>
      <input type="submit" name="project" class="btn btn-success btn-lg" value="Submit">
    </form>
  </div>
  <div>
    <button class="toggle-btn"><i class="fa fa-black-tie" style="font-size:36px">  Internships</i></button>
	   <form class="form" method="post" action="stusubmit.php" enctype="multipart/form-data">
       <div id="internship_repeat">
        <label>Title:</label><input type="text" placeholder="Title" name="inttitle[]" value="<?php echo $inttitle[0]; ?>"><br><br>
        <textarea rows=5 cols=100 placeholder="Description" name="intdesc[]"><?php echo $intdesc[0]; ?></textarea><br><br>
        <div class="uploaded">
          <label>Certificate:</label><a href="download_certi.php?Int_Certificate=<?php echo $intcerti[0]; ?>" target="_blank"><?php echo $intcerti[0]; ?></a>
        </div>

        <button name="edit" class="edit" type="button"><i class="fa fa-pencil"></i></button>
        <div class="uploader"  style="display:none">
          <label>Upload Certificate:</label><input type="file" name="intcerti[]"><br><br>
        </div>

      </div>
      <br>
      <input type="button"  class="btn btn-primary btn-lg" value="+Add Internships" id="internship"><br><br>
      <input type="submit" name="intp" class="btn btn-success btn-lg" value="Submit">
    </form>
  </div>
</div>
 <script>
    //form toggle
    $(function(){
    $(".toggle-btn").click(function(){
      $(this).siblings('.form').slideToggle(500);
    });
    $(".edit").click(function(){
      $(this).siblings('div.uploader').toggle();
    });
    });

		//Add degree
		$("#acad").click(function(){
			$("#acad_repeat").append('<div class="acad_div"><label>Degree:</label><input type="text" name="degree[]" ><br><br><label>Institute Name:</label><input type="text" name="instname[]" ><br><br><label>Year of passing:</label><input type="month" name="iyear[]"><br><br><label>Percentage or CGPA:</label><input type="text" name="grade[]"><br><br><input type="button" value="Remove" class="acad_remove btn btn-danger btn-lg"/><br></div>');
		});
		//Remove degree
		$('body').on('click','.acad_remove',function() {
			$(this).parent('div.acad_div').remove();
		});
		//Add skills
		$("#skill").click(function(){
			$("#skill_repeat").append('<div class="skill_div"><input type="text" name="skill[]">&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="Remove" class="skill_remove btn btn-danger"/><br><br></div>');
		});
		//Remove skills
		$('body').on('click','.skill_remove',function() {
			$(this).parent('div.skill_div').remove();
		});
    //Add Project
		$("#project").click(function(){
			$("#project_repeat").append('<div class="project_div"><label>Title:</label><input type="text" placeholder="Title" name="ptitle[]"><br><br><textarea rows=5 cols=100 placeholder="Description" name="pdesc[]"></textarea><br><br><label>Project Link:</label><input type="text" placeholder="Project Link" name="plink[]"><br><br><input type="button" value="Remove" class="project_remove btn btn-danger btn-lg"/><br><br></div>');
		});
		//Remove project
		$('body').on('click','.project_remove',function() {
			$(this).parent('div.project_div').remove();
		});
    //Add internship
		$("#internship").click(function(){
			$("#internship_repeat").append('<div class="internship_div"><label>Title:</label><input type="text" placeholder="Title" name="inttitle[]"><br><br><textarea rows=5 cols=100 placeholder="Description" name="intdesc[]"></textarea><br><br><label>Upload Certificate:</label><input type="file" name="intcerti[]"><br><br><input type="button" value="Remove" class="internship_remove btn btn-danger btn-lg"/><br><br></div>');
		});
		//Remove internship
		$('body').on('click','.internship_remove',function() {
			$(this).parent('div.internship_div').remove();
		});


	</script>
<?php
  //Print multiple acad,skills,project and intenships in student profile form
  for($i=1;$i<count($degree);$i++)
  {
    echo	'<script>$("#acad_repeat").append(\'<div class="acad_div"><label>Degree:</label><input type="text" name="degree[]" value="'.$degree[$i].'"><br><br><label>Institute Name:</label><input type="text" name="instname[]" value="'.$instname[$i].'"><br><br><label>Year of passing:</label><input type="month" name="iyear[]" value="'.$iyear[$i].'"><br><br><label>Percentage or CGPA:</label><input type="text" name="grade[]" value="'.$grade[$i].'"><br><br><input type="button" value="Remove" class="acad_remove btn btn-danger btn-lg"/><br></div>\');</script>';
  }
  for($i=1;$i<count($skill);$i++)
  {
    echo '<script>$("#skill_repeat").append(\'<div class="skill_div"><input type="text" name="skill[]" value="'.$skill[$i].'">&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="Remove" class="skill_remove btn btn-danger"/><br><br></div>\');</script>';
  }
  for($i=1;$i<count($ptitle);$i++)
  {
    echo	'<script>$("#project_repeat").append(\'<div class="project_div"><label>Title:</label><input type="text" placeholder="Title" name="ptitle[]" value="'.$ptitle[$i].'"><br><br><textarea rows=5 cols=100 placeholder="Description" name="pdesc[]">'.$pdesc[$i].'</textarea><br><br><label>Project Link:</label><input type="text" placeholder="Project Link" name="plink[]" value="'.$plink[$i].'"><br><br><input type="button" value="Remove" class="project_remove btn btn-danger btn-lg"/><br><br></div>\');</script>';
  }
  for($i=1;$i<count($inttitle);$i++)
  {
    echo	'<script>$("#internship_repeat").append(\'<div class="internship_div"><label>Title:</label><input type="text" placeholder="Title" name="inttitle[]" value="'.$inttitle[$i].'"><br><br><textarea rows=5 cols=100 placeholder="Description" name="intdesc[]">'.$intdesc[$i].'</textarea><br><br><div class="uploaded"><label>Certificate:</label><a  href="download_certi.php?Int_Certificate='.$intcerti[$i].'"  target="_blank">'.$intcerti[$i].'</a></div><button name="edit" class="edit" type="button"><i class="fa fa-pencil"></i></button><div class="uploader"  style="display:none"><label>Upload Certificate:</label><input type="file" name="intcerti[]"><br><br></div><br><br><input type="button" value="Remove" class="internship_remove btn btn-danger btn-lg"/><br><br></div>\');</script>';
// <a href="download_certi.php?Int_Certificate=$intcerti[0]" target="_blank"><?php echo $intcerti[0];</a>
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
        url:"stusubmit.php",
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

<?php
	session_start();
  require '../dbconfig/config.php';
  ?>

<?php
	if(isset($_SESSION['email']))
	{
		$sql="SELECT * FROM `corousal`";
		$result = $con->query($sql);
		if ($result->num_rows > 0)
		{
			$image_arr=[];
			while($row = $result->fetch_assoc()) {
				 array_push($image_arr,$row['Image']);
			}
		}

	}
 ?>
<html>
<head>
	<title>"Edit home"</title>
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
background-color:#960090;
	background-repeat: no-repeat;
  background-size: cover;
  width: 100%;
    height: 100%;
	background-attachment:fixed;
  }
  .container{
background-color:white;
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
	#img_repeat,.img_repeat{
		border:1px solid black;
		margin:30px;
	}

	icon {
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
	/*delete icon*/
	.d:hover {
	  background-color:#ff1a1a;
	}
	/*edit icon*/
	.e:hover {
	  background-color:#2eb82e;
	}
  </style>
</head>
<body>
<div class="topnav" id="myTopnav">
  <a href="index.php" class="active"><i class="fa fa-home"></i> Home</a>
  <a href="../displayintp.php"><i class="fa fa-black-tie"></i> Internship</a>
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
						  //echo '<a name="edit" id="edit"  href="studentprofile.php?email='.$email.'"><i class="fa fa-user"></i> My Profile </a>';
              echo "<a name='logout' id='logout'  href='../logout.php' style='float:right'><i class='fa fa-sign-out'></i> Sign Out </a>";
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
	<div class="card-panel hoverable">
	<div>
			<?php
				$sql="SELECT * FROM `corousal`";
				$result = $con->query($sql);
				if ($result->num_rows > 0) {
					$i=0;
					while($row = $result->fetch_assoc()) {
						echo '<form action="homeform.php" method="post"><div class="display_img_div"><img src="images/slider/'.$row['Image'].'" width=400px height=250px alt="Image not found">
						<input type="file" name="img" value="'.$row['Image'].'">
						<label>title</label>
						<input type="text" value="'.$row['Title'].'" name="title" class="title">
						<br>
						<label>description</label>
						<input type="text" name="desc" value="'.$row['Description'].'">
						<button type="submit" name="Edit" value="Edit" class="icon" disabled><i class="fa fa-pencil e"></i></button>
						<button type="submit" name="delete" value="Delete" class="icon"><i class="fa fa-trash d"></i></button></div></form>';
					}
				}
			?>
			<!---<input type="submit" name="edit" value="Edit"><br>-->

		<button class="toggle-btn"><i class="fa fa-picture-o" style="font-size:36px">Add Image for Carousel</i></button>
		<form class="form" method="post" action="homeform.php" enctype="multipart/form-data">
			<div id="img_repeat">
				<input type="file" name="img[]"><br><br>
				<table style="width:100%">
				  <tr>
					<th><label>Title</label></th><th><input type="text" name="title[]"></th>
				  </tr>
				  <tr>
					<th><label>Description</label></th><th><textarea name="desc[]" rows='2' cols='50'></textarea></th>
				  </tr>
				</table>
			</div>
			<input type="button"  class="btn btn-primary btn-lg" value="+Add images" id="img"><br><br>
			<input type="submit" name="corousal" class="btn btn-success btn-lg" value="Submit">
		</form>
	</div>
	<script>
	//toggle function
		$(function(){
    $(".toggle-btn").click(function(){
      $(this).siblings('.form').slideToggle(500);
    });
    });
	//add img
		$("#img").click(function(){
			$("#img_repeat").append('<div class="img_div"><input type="file" name="img[]"><table style="width:100%"><tr><th><label>Title</label></th><th><input type="text" name="title[]"></th></tr><tr><th><label>Description</label></th><th><textarea name="desc[]" rows="2" cols="50"></textarea></th></tr></table>&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="Remove" class="img_remove btn btn-danger"/><br><br></div>');
		});
		//Remove img
		$('body').on('click','.img_remove',function() {
			$(this).parent('div.img_div').remove();
		});
	</script>
	<?php
	  if(isset($_SESSION['email']))
	  {
		$email=$_SESSION['email'];
		if(isset($_POST['corousal']))
		{
			$title=$_POST['title'];
			$desc=$_POST['desc'];
			$file_name_array=$_FILES['img']['name'];
			$file_tmp_array=$_FILES['img']['tmp_name'];
			for($i=0;$i<count($file_tmp_array);$i++)
			{
			  $file_name_array[$i] = time().'_'.$file_name_array[$i];
			  $target='images/slider/'.$file_name_array[$i];
			  if(move_uploaded_file($file_tmp_array[$i],$target)){
				$query="INSERT INTO corousal VALUES ('$file_name_array[$i]','$title[$i]','$desc[$i]')";
				$result=mysqli_query($con,$query);
			  }
			}
			echo "<script type='text/javascript'>alert('Images uploaded')</script>";

		}

	  }
	?>

	<?php
		if(isset($_POST["delete"]))
		{
			$title=$_POST['title'];
			$query="DELETE FROM `corousal` WHERE `Title` = '$title'";
			$result=mysqli_query($con,$query);
			if($result)
			{
				$sql="SELECT `Image` FROM `corousal` WHERE `Title`='$title' ";
				$result = $con->query($sql);
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						$path = "images/slider/".$row['Image'];
						echo "<script type='text/javascript'>alert('".$path."')</script>";
					}
					if(unlink($path))
					{
						echo "<script type='text/javascript'>alert('Image deleted successfully')</script>";
					}
					else{
						echo "<script type='text/javascript'>alert('Failed to delete image')</script>";
					}
				}
				//header('location:refresh.php');

				/*while ($file = readdir($dirHandle))
				{
					if($file==$data) {
						unlink($dir.'/'.$file);
					}
				}*/
			}
			else
			{
				echo "<script type='text/javascript'>alert('Failed to delete image')</script>";
			}
		}
		else if(isset($_POST["Edit"]))
		{
			$eimg=time().'_'.$_FILES['img']['name'];
			$target='images/slider/'.$eimg;
			$title=$_POST['title'];
			$desc=$_POST['desc'];
			if(move_uploaded_file($_FILES['img']['tmp_name'],$target)){
			  $query="UPDATE `corousal` SET `Image`='$eimg',`Description`='$desc' WHERE `Title`='$title'";
			}
			else{
			  echo "<script type='text/javascript'>alert('Failed to edit data ')</script>";
			}
		}
	?>
</div>
</div>
</body>
</html>

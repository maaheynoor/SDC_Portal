<?php
  session_start();
  require 'dbconfig/config.php';
  if(isset($_SESSION['email']))
  {
    $email=$_SESSION['email'];

    if(isset($_POST['pinfo']))
    {
      $name=$_POST['name'];
      $about=$_POST['about'];
      $dept=$_POST['dept'];
      $desig=$_POST['desig'];
      $query="UPDATE `faculty` SET `Name`='$name',`About`='$about',`Department`='$dept',`Designation`='$desig' WHERE `Email`='$email'";
    }
    else if(isset($_POST['courses']))
    {
      $course=implode(", ",$_POST["course"]);
      echo "<script type='text/javascript'>alert('".$course." ')</script>";
      $query="UPDATE `faculty` SET `Course`='$course' WHERE `Email`='$email'";
    }
    else if(isset($_POST['research_btn']))
    {
      $research=implode(", ",$_POST["research"]);
      echo "<script type='text/javascript'>alert('".$research." ')</script>";
      $query="UPDATE `faculty` SET `Course`='$research' WHERE `Email`='$email'";
    }
    else if(isset($_POST['acad']))
    {
      $degree=implode(", ",$_POST["degree"]);
      $instname=implode(", ",$_POST["instname"]);
      $iyear=implode(", ",$_POST["iyear"]);
      echo "<script type='text/javascript'>alert('".$degree." ')</script>";
      $query="UPDATE `faculty` SET `Edu_Degree`='$degree',`Edu_Inst`='$instname',`Edu_Year`='$iyear' WHERE `Email`='$email'";
    }
    else if(isset($_POST['publication']))
    {
      $pubtitle=implode(", ",$_POST["pubtitle"]);
      $pubdesc=implode(", ",$_POST["pubdesc"]);
      $publink=implode(", ",$_POST["publink"]);
      $query="UPDATE `faculty` SET `Pub_Title`='$pubtitle',`Pub_Desc`='$pubdesc',`Pub_Link`='$publink' WHERE `Email`='$email'";
    }
    else if(isset($_POST['image']))
    {

      $profile = $_POST['image'];
      $image_array_1 = explode(';', $profile);
      $image_array_2 = explode(',', $image_array_1[1]);
      $profile = base64_decode($image_array_2[1]);
      $name=explode('@',$email);
      $image_name = time().$name[0].'.png';
        if(file_put_contents('image/'.$image_name, $profile)){
          $query="UPDATE `faculty` SET `Profile_Image`='$image_name' WHERE `Email`='$email'";
        }
        else{
          echo "<script type='text/javascript'>alert('Failed to Upload Profile Picture ')</script>";
        }
    }
    else if(isset($_POST['password']))
    {
      $curr_pass=$_POST['curr_pass'];
      $new_pass=$_POST['new_pass'];
      $cnew_pass=$_POST['cnew_pass'];
      $query1="SELECT * FROM `usertable` WHERE `email`='$email' AND `password`='$curr_pass'";
      $result1=mysqli_query($con,$query1);
			if((mysqli_num_rows($result1))>0)
			{
        if($new_pass==$cnew_pass)
        {
          $query="UPDATE `usertable` SET `password`='$new_pass' WHERE `email`='$email'";
        }
        else
        {
          echo "<script type='text/javascript'>alert('Passwords do not match')</script>";
        }

      }
      else {
        echo "<script type='text/javascript'>alert('Incorrect password')</script>";
      }
    }
    $result=mysqli_query($con,$query);
    if($result)
    {
      echo "<script type='text/javascript'>alert('Profile Updated successfully')</script>";
    }
    else
    {
      echo "<script type='text/javascript'>alert('Profile Updation failed ')</script>";
    }
  }
header("location:facultyform.php");
?>

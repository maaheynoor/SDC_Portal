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
      $sem=$_POST['sem'];
      $city=$_POST['city'];
      $query="UPDATE `student` SET `Name`='$name',`About`='$about',`Department`='$dept',`Semester`='$sem',`City`='$city' WHERE `Email`='$email'";
    }
    else if(isset($_POST['social']))
    {
      $linkedin=$_POST['linkedin'];
      $github=$_POST['github'];
      $website=$_POST['website'];
      $query="UPDATE `student` SET `Linkedin`='$linkedin',`Github`='$github',`Website`='$website' WHERE `Email`='$email'";
    }
    else if(isset($_POST['acad']))
    {
      $degree=implode(", ",$_POST["degree"]);
      $instname=implode(", ",$_POST["instname"]);
      $iyear=implode(", ",$_POST["iyear"]);
      $grade=implode(", ",$_POST["grade"]);
      echo "<script type='text/javascript'>alert('".$degree." ')</script>";
      $query="UPDATE `student` SET `Edu_Degree`='$degree',`Edu_Inst_Name`='$instname',`Edu_Year`='$iyear',`Edu_Grade`='$grade' WHERE `Email`='$email'";
    }
    else if(isset($_POST['skills']))
    {
      $skill=implode(", ",$_POST["skill"]);
      echo "<script type='text/javascript'>alert('".$skill." ')</script>";
      $query="UPDATE `student` SET `Skills`='$skill' WHERE `Email`='$email'";
    }
    else if(isset($_POST['project']))
    {
      $ptitle=implode(", ",$_POST["ptitle"]);
      $pdesc=implode(", ",$_POST["pdesc"]);
      $plink=implode(", ",$_POST["plink"]);
      $query="UPDATE `student` SET `Project_Title`='$ptitle',`Project_Detail`='$pdesc',`Project_Link`='$plink' WHERE `Email`='$email'";
    }
    else if(isset($_POST['intp']))
    {
      $inttitle=implode(", ",$_POST["inttitle"]);
      $intdesc=implode(", ",$_POST["intdesc"]);
      //array of names/sizes of all the uploaded files
      $file_name_array=$_FILES['intcerti']['name'];
      $file_tmp_array=$_FILES['intcerti']['tmp_name'];
      $file_size_array=$_FILES['intcerti']['size'];
      //Get the initial data of files from database
      $query_student="SELECT Int_Certificate FROM student WHERE `email`='$email'";
      $result_student=mysqli_query($con,$query_student);
      if($result_student)
      {
        if(mysqli_num_rows($result_student)>0)
        {
          $row1=mysqli_fetch_array($result_student,MYSQLI_ASSOC);
          $intcerti=explode(", ",$row1["Int_Certificate"]);
        }
      }
      $initial_file_uploaded=$intcerti;
        for($i=0;$i<count($file_tmp_array);$i++)
        {
          //if new file is not uploaded the previous file is not changed
          if($file_size_array[$i]==0)
          {
            $file_name_array[$i]=$initial_file_uploaded[$i];
          }
          else{
            $file_name_array[$i] = time().'_'.$file_name_array[$i];
            $target='intp_certificate/'.$file_name_array[$i];
            if(move_uploaded_file($file_tmp_array[$i],$target)){
              echo "<script type='text/javascript'>alert('Uploaded in folder')</script>";
            }
          }
        }
      $intcerti=implode(", ",$file_name_array);
      $query="UPDATE `student` SET `Int_Name`='$inttitle',`Int_Detail`='$intdesc',`Int_Certificate`='$intcerti' WHERE `Email`='$email'";
    }
    else if(isset($_POST['image']))
    {
      $profile = $_POST['image'];
      $image_array_1 = explode(';', $profile);
      $image_array_2 = explode(',', $image_array_1[1]);
      $profile = base64_decode($image_array_2[1]);
      $name=explode('@',$email);
      $image_name = time().$name[0].'.png';

      // $profile = $_POST['image'];
      // list($type, $profile) = explode(';', $profile);
      // list(, $profile) = explode(',', $profile);
      // $profile = base64_decode($profile);
      // $image_name = time().'.jpg';
        if(file_put_contents('image/'.$image_name, $profile)){
          $query="UPDATE `student` SET `Profile_Image`='$image_name' WHERE `Email`='$email'";
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
header("location:stuform.php");
?>

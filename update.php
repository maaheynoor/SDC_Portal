<?php

//Database connection
require 'dbconfig/config.php';
//Add internship details using form
if(isset($_POST['add']))
{
	//To add new internships
	if($_POST['add']=='Insert')
	{
		$intname=$_POST["internship_name"];
		//multiple faculty and students separated by comma
		$fname=implode(", ",$_POST["faculty_name"]);
		$femail=implode(", ",$_POST["faculty_email"]);
		$sname=implode(", ",$_POST["student_name"]);
		$sroll=implode(", ",$_POST["student_roll_no"]);
		$semail=implode(", ",$_POST["student_email"]);
		$date=$_POST["date"];
		$desc=$_POST["desc"];
		$query="INSERT INTO internshiptable VALUES('$intname','$fname','$femail','$sname','$sroll','$semail','$date','$desc')";
		$result=mysqli_query($con,$query);
		if($result)
		{
			echo "<script type='text/javascript'>alert('Internship data inserted successfully')</script>";
		}
		else
		{
			echo "<script type='text/javascript'>alert('Internship data insertion failed ')</script>";
		}
	}
	//To edit existing internship
	else if($_POST['add']=='Edit')
	{
		$intname=$_POST["internship_name"];
		$sdc_intp=$intname;
		$sdc_intp_arr=array();
		$fname=implode(", ",$_POST["faculty_name"]);
		$femail=implode(", ",$_POST["faculty_email"]);
		$sname=implode(", ",$_POST["student_name"]);
		$sroll=implode(", ",$_POST["student_roll_no"]);
		$semail=implode(", ",$_POST["student_email"]);
		$date=$_POST["date"];
		$desc=$_POST["desc"];
		$old_int_name=$_SESSION['int_name'];
		$query="UPDATE `internshiptable` SET `Internship Name`='$intname',`Faculty Name`='$fname',`Faculty Email`='$femail',`Student Name`='$sname',`Student Roll No`='$sroll',`Student Email`='$semail',`Start Date`='$date',`Description`='$desc' WHERE `Internship Name`='$old_int_name'";
		$result=mysqli_query($con,$query);
		if($result)
			{
				echo "<script type='text/javascript'>alert('Internship data updated successfully')</script>";
			}
		else
			{
				echo "<script type='text/javascript'>alert('Internship data updation failed')</script>";
			}
		}
		//create account of faculty and student
		$fac_name_arr = explode (", ", $fname);
		$fac_email_arr = explode (", ", $femail);
		for($i=0;$i<count($fac_name_arr);$i++)
		{
			//check if faculty account exists
			$query_user_exists="SELECT `Intp_name` FROM faculty WHERE `Email`='$fac_email_arr[$i]'";
			$result=$con->query($query_user_exists);
			if($result->num_rows > 0)
			{
					$row=$result->fetch_assoc();
					//if account exists append new internship only
					$sdc_intp_arr = explode (", ",$row['Intp_name']);
					if(!in_array($intname,$sdc_intp_arr))			//check if internship already present in profile
					{
						//old internship name found then remove from array
						if (($key = array_search($old_int_name,$sdc_intp_arr)) !== false) {
							//unset($messages[$key]);
							\array_splice($sdc_intp_arr, $key, 1);
						}
						// append new internship
						array_push($sdc_intp_arr,$intname);
						$sdc_intp=implode(", ",$sdc_intp_arr);
						$query_account_update="UPDATE faculty SET `Intp_name`='$sdc_intp'  WHERE `Email`='$fac_email_arr[$i]'";
						$result_account_update=mysqli_query($con,$query_account_update);
					}
			}
			//user doesn't exist create account and add sdc internship
			else
			{
				$sdc_intp=$intname;
				$query_account="INSERT INTO faculty (`Name`,`Email`,`Intp_name`) VALUES('$fac_name_arr[$i]','$fac_email_arr[$i]','$sdc_intp')";
				$result_account=mysqli_query($con,$query_account);
			}
			//to create account in usertable
			$query_user="INSERT INTO usertable VALUES('$fac_email_arr[$i]','password','faculty')";
			$result_user=mysqli_query($con,$query_user);
		}
		//faculty insert code here

		$stu_name_arr = explode (", ", $sname);
		$stu_roll_arr = explode (", ", $sroll);
		$stu_email_arr = explode (", ", $semail);
		for($i=0;$i<count($stu_name_arr);$i++)
		{
			//check if student account exists
			$query_user_exists="SELECT `SDC_Int_Name` FROM student WHERE `Email`='$stu_email_arr[$i]'";
			$result=$con->query($query_user_exists);
			if($result->num_rows > 0)
			{
					$row=$result->fetch_assoc();
					//if account exists append new internship only
					$sdc_intp_arr = explode (", ",$row['SDC_Int_Name']);
					if(!in_array($intname,$sdc_intp_arr))			//check if internship already present in profile
					{
						if (($key = array_search($old_int_name,$sdc_intp_arr)) !== false) {
							//unset($messages[$key]);
							\array_splice($sdc_intp_arr, $key, 1);

						}
						array_push($sdc_intp_arr,$intname);
						$sdc_intp=implode(", ",$sdc_intp_arr);
						$query_account_update="UPDATE student SET `SDC_Int_Name`='$sdc_intp'  WHERE `Email`='$stu_email_arr[$i]'";
						$result_account_update=mysqli_query($con,$query_account_update);
					}
			}
			//user doesn't exist create account and add sdc internship
			else
			{
				$sdc_intp=$intname;
				$query_account="INSERT INTO student (`Name`, `Roll_no`,`Email`,`SDC_Int_Name`) VALUES('$stu_name_arr[$i]','$stu_roll_arr[$i]','$stu_email_arr[$i]','$sdc_intp')";
				$result_account=mysqli_query($con,$query_account);
			}
			//to create account in usertable
			$query_user="INSERT INTO usertable VALUES('$stu_email_arr[$i]','password','student')";
			$result_user=mysqli_query($con,$query_user);

		}

			/*if($result_account_update)
			{
				echo "<script type='text/javascript'>alert('New Internship added to account')</script>";
			}
			else {
				echo "<script type='text/javascript'>alert('Internship not added to account')</script>";
			}*/

			/*if($result_account)
			{
				echo "<script type='text/javascript'>alert('New account created')</script>";
			}
			else {
				echo "<script type='text/javascript'>alert('Account not created')</script>";
			}*/


}
//deleting internship
else if(isset($_POST["delete"]))
{
  $intname=$_POST['delete'];
  $query="DELETE FROM `internshiptable` WHERE `internshiptable`.`Internship Name` = '$intname'";
  $result=mysqli_query($con,$query);
  if($result)
  {
    echo "<script type='text/javascript'>alert('Internship data deleted successfully')</script>";
  }
  else
  {
    echo "<script type='text/javascript'>alert('Internship data deletion failed')</script>";
  }
}
//on clicking edit-pencil display form and submit buttons change to edit
else if(isset($_POST["edit"]))
{
	//Edit button for each internship
	$intname=$_POST['edit'];
	$query="SELECT * FROM internshiptable WHERE `Internship Name`='$intname'";
	$result=mysqli_query($con,$query);
	if($result)
	{
		if(mysqli_num_rows($result)>0)
		{
			echo "<script>
			var form=document.getElementById('content');
			form.style.display='block';
			var submit=document.getElementsByName('add');
			submit[0].value='Edit';
			var b= document.getElementById('addi');
			b.innerHTML='<i class=\'fa fa-pencil\'></i> Edit Internship';
			</script>";
		}
		else
		{
			echo "<script type='text/javascript'>alert('Invalid Internship Name')</script>";
		}
	}
	else
	{
			echo "<script type='text/javascript'>alert('Internship data access failed')</script>";
	}
}
//echo "<script>window.location('displayintp.php')</script>";
//header('location:displayintp.php');
 ?>

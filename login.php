<?php

	session_start();

	require 'dbconfig/config.php';

?>



<html>

<head>

<title>LOGIN PAGE</title>



<!-- Latest compiled and minified CSS -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">



<!-- jQuery library -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>



<!-- Latest compiled JavaScript -->

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</script>

</head>



<body>

<div class="container" style="font-size:15px; padding:5px 5px; width:25%;">

<form method="POST" action='login.php'>

<fieldset><legend>Login</legend>

<div class="form-group">

    <label for="email">Email:</label>

    <input type="email" class="form-control" name="email" id="email" required>

  </div>

  <div class="form-group">

    <label for="pwd">Password:</label>

    <input type="password" class="form-control" name="password" id="pwd" required>

  </div>

  

  <button type="submit" name='login' class="btn btn-outline-primary">Login</button>



</fieldset>

<div class="col s12 m6 offset-m3 center-align">

    <a class="oauth-container btn darken-4 white black-text" href="/users/google-oauth/" style="text-transform:none;">

        <div class="left" style="font-size:15px; border:1px solid black; border-radius:5px; padding:5px 5px;">

            <img width="20px" height="20px" style="margin-right:10px;" alt="Google sign-in" 

                src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" /> Login with Google

        </div>    

    </a>

</div>

</form>



</div>

	<?php

		if(isset($_POST["login"]))

		{

			$email=$_POST['email'];

			$password=$_POST['password'];

			$query="SELECT * FROM usertable WHERE email='$email' AND password='$password'";

			$result=mysqli_query($con,$query);

			if((mysqli_num_rows($result))>0)

			{

				$_SESSION['email']=$email;

				header('location:adminAccount.php');

			}

			else

			{

				echo '<script type="text/javascript">alert("Invalid cridentials")</script>';

			}

		}

	?>

</body>

</html>
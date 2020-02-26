<?php
session_start();
session_destroy();
echo "<script type='text/javascript'>alert('Logged out successfully')</script>";
header('Location:home page/index.php');
exit;
?>

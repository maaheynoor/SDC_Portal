<?php
//to preview certificate and download
session_start();
require 'dbconfig/config.php';
if(isset($_GET['Int_Certificate']))
{
  $intcerti=$_GET['Int_Certificate'];
  $file='intp_certificate/'.$intcerti;
//   $filename=basename($file);
//   if(file_put_contents( $filename,file_get_contents($file))) {
//     echo "File downloaded successfully";
// }
// else {
//     echo "File downloading failed.";
// }
  header('Content-type:application/pdf');
  header('Content-Disposition:inline;filename="'.$file.'"');
  header('Content-Tansfer-Encoding:binary');
  header('Accept-Ranges:bytes');
  @readfile($file);
}


?>

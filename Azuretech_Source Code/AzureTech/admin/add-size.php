<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
require_once 'phpqrcode/qrlib.php';
$path = 'images/';
$qrcode = $path.time().".png";
$qrimage = time().".png";

if(isset($_POST['submit']))
  {
    $size=$_POST['cname'];
    $stock=$_POST['stock'];
    $id=$_POST['ID'];
    $query=mysqli_query($con, "insert into tblsize(SizeName,Stock,qrimage) value('$size','$stock','$qrimage')");

    if ($query) {
    $msg="Size has been added.";
  }
  else
    {
      $msg="Something Went Wrong. Please try again";
    }
}
QRcode :: png($size, $qrcode, 'L',8 , 8);
header('location: manage-size.php');

  ?>

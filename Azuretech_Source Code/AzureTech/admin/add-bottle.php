

<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['submit']))
  {
    $companyname=$_POST['cname'];
    $bottlesize=$_POST['size'];
    $price=$_POST['price'];
  	$bimg=$_FILES["images"]["name"];
  	$imgid=$_GET['imageid'];
     $bimg=$_FILES["images"]["name"];
     $extension = substr($bimg,strlen($bimg)-4,strlen($bimg));
// allowed extensions
$allowed_extensions = array(".jpg","jpeg",".png",".gif");
// Validation for allowed extensions .in_array() function searches an array for a specific value.

//r
$bottleimg=md5($bimg).$extension;
     move_uploaded_file($_FILES["images"]["tmp_name"],"images/".$bottleimg);
    $query=mysqli_query($con, "insert into tblwaterbottle(CompanyName,BottleSize,Price,Image) value('$companyname','$bottlesize','$price','$bottleimg')");
    if ($query) {
    $msg="Water Bottle details has been submitted.";
  }
  else
    {
      $msg="Something Went Wrong. Please try again";
    }

  }


header('location: manage-bottle.php');

  ?>

<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['submit']))
  {
    $type=$_POST['cname'];
  
    $query=mysqli_query($con, "insert into tblcompany(CompanyName) value('$type')");
    if ($query) {
    $msg="Type has been added.";
  }
  else
    {
      $msg="Something Went Wrong. Please try again";
    }
}

header('location: manage-watertype.php');

  ?>

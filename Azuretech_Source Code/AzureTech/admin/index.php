<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['login']))
  {
    $adminuser=$_POST['username'];
    $password=md5($_POST['password']);
    $query=mysqli_query($con,"select ID from tbladmin where  UserName='$adminuser' && Password='$password' ");
    $ret=mysqli_fetch_array($query);
    if($ret>0){
      $_SESSION['wsmsaid']=$ret['ID'];
     header('location:dashboard.php');
    }
    else{
    $msg="Invalid Details.";
    }
  }
  ?>
<!DOCTYPE HTML>
<html>
<head>
<title>Sign In</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'>
<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

      <link rel="stylesheet" href="css/login.css">

</head> 
<body>
  <div class="container">			

  <div class="info">
    <h2 style = "font-weight: bold; font-size: 25px; font-family: 'Montserrat', sans-serif;" >Admin Panel </h2>
 
</div>
<div class="form">
  <div class="thumbnail"><img src="images/manager.png"/></div>
  <span style="color:red;"><?php echo $msg; ?></span>
  <form class="login-form" action="index.php" method="post">
    <input type="text" name="username" class="name" placeholder="Username" required="true">
    <input type="password" name="password" class="password" placeholder="Password" required="true">
   <input type="submit" class="login" name="login" value="Sign In">

  </form>
  <!--<div style="margin-top: 10px;"><a href="forgot-password.php">Forgot Password?</a></div>-->
</div>
<div style="margin-top: 20px; text-align: center"><?php include_once('includes/footer.php');?></div>
	</div>
	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
 
</body>
</html>
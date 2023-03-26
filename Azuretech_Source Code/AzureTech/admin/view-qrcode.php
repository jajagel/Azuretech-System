<?php
session_start();
error_reporting(0);
include_once('includes/dbconnection.php');
if (strlen($_SESSION['wsmsaid']==0)) {
  header('location:logout.php');
  } else{ 

 

    ?>
<script language="javascript" type="text/javascript">
function f2()
{
window.close();
}
function f3()
{
window.print(); 
}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/morris.css" type="text/css"/>
<!-- Graph CSS -->
<link href="css/font-awesome.css" rel="stylesheet"> 

<title>QR Code</title>
</head>
<body style="overflow: hidden; background-color:white ;">

<div>

<?php  
$oid=$_GET['oid'];
$query=mysqli_query($con,"select * from tblsize where ID='$oid'");
?>


<?php  
while ($row=mysqli_fetch_array($query)) {
  ?>
<h4 align="center" style="margin-bottom:0px;"><?php echo $row['SizeName']?> #<?php echo $row['ID']?></h4>
<div align="center"><img src="images/<?php echo $row['qrimage']?>" ></div>

  
 <div align="center">
     
      <input class="btn" name="Submit2" type="submit" class="txtbox4" value="Close" onClick="return f2();" style="cursor: pointer;"/> 

      <a href="images/<?php echo $row['qrimage']?>" download="<?php echo $row['SizeName']?>_<?php echo $row['qrimage']?>" class="btn btn-primary" style="margin-left: 10px;"><i class="fa fa-download"></i> Download</a>
    
    <?php } ?>  
</div>
</div>

</body>
</html>

  <?php } ?>   
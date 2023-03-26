<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['wsmsaid']==0)) {
  header('location:logout.php');
  }
  else{

if(isset($_POST['submit']))
  {
   	$inputQty=$_POST['qty'];
	
	$name=$_POST['name'];
	$type=$_POST['requesttype'];
	$query=mysqli_query($con,"select * from tblsize where SizeName='$name'");
	$row=mysqli_fetch_array($query);

	if($type=='Bottle In'){
		$newQty=$row['StockOut']-$inputQty;
	}
	if($type=='Bottle Out'){
		$newQty=$row['StockOut']+$inputQty;
	}
	echo $newQty;

	$sql = "update tblsize set StockOut ='$newQty' where SizeName='$name'";
	$result=mysqli_query($con,$sql);

	if($result){	
		header('location:inventory.php');
	}else{
		die(mysqli_error($con));
	}
  }
  ?>

<!DOCTYPE HTML>
<html>
<head>
<title>Update Inventory</title>

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/morris.css" type="text/css"/>
<!-- Graph CSS -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<script src="js/jquery-2.1.4.min.js"></script>
<!-- //jQuery -->
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<!-- lined-icons -->
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
<!-- //lined-icons -->
</head> 
<body>
   <div class="page-container">
   <!--/content-inner-->
<div class="left-content">
	   <div class="mother-grid-inner">
              <!--header start here-->
				<?php include_once('includes/header.php');?>
<!--heder end here-->
	<ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a><i class="fa fa-angle-right"></i><a href="inventory.php">Inventory</a><i class="fa fa-angle-right"></i>Update Inventory
            </ol>
		<!--grid-->
 	<div class="grid-form">
 


  <div class="grid-form1">
  	<?php $text=$_POST['text']; ?>
  	       
								 		
  <?php
$text=$_POST['text'];
	$query=mysqli_query($con,"select * from tblsize where SizeName='$text'");
	
	while ($row=mysqli_fetch_array($query)) { 
	
?>
<h3>Bottle Size ID #<?php  echo $row['ID'];?></h3>
  	         <div class="tab-content">
						<div class="tab-pane active" id="horizontal-form">
							<form class="form-horizontal" method="post"  enctype="multipart/form-data">
<table border="2" class="table table-bordered"  style="width: 40em;">
			<tr>
				<th class="col-sm-2 control-label">Size Name </th>
				<td style="padding-left: 10px"><?php  echo $row['SizeName'];?></td>
			</tr>
			<tr>
				<th class="col-sm-2 control-label">Stock In </th>
				<td style="padding-left: 10px"><?php  echo $row['Stock'];?></td>
			</tr>
			<tr>
				<th class="col-sm-2 control-label">Stock Out </th>
				<td style="padding-left: 10px"><?php  echo $row['StockOut'];?></td>
			</tr>
			<tr>
				<th class="col-sm-2 control-label">Onhand </th>
				<td style="padding-left: 10px"><?php  echo $row['Stock']-$row['StockOut'];?></td>
			</tr>
		</table>
	
		<input type="hidden" name="name" id="name" class="form-control" style="width:30em;" value="<?php  echo $row['SizeName'];?>" required='true'>
		
		<input type="hidden" name="id" id="id" class="form-control" style="width:30em;" value="<?php  echo $row['ID'];?>" required='true'>

		<div class=form-group style="padding-top: 20px">
		<label for="smallinput" class="col-sm-2 control-label label-input-sm"> Quantity of Bottles</label>
			<input type="number" name="qty" id="qty" class="form-control" style="width:30em;" placeholder="Enter Quantity" required='true'>
	</div>

	<div class="form-group">
									<label for="mediuminput" style="font-size: 16px;" class="col-sm-2 control-label">Request Type</label>
									<div class="col-sm-8">
							
										<input class="inputabs" id="tab1" type="radio" name="requesttype" checked="checked" value="Bottle In">Bottle In
									  <input class="inputabs" id="tab2" type="radio" name="requesttype" value="Bottle Out">Bottle Out
					</div>
					</div>
							
<?php } ?>
								
						
						</div>
					</div>
      <div class="panel-footer">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<button class="btn-primary btn" type="submit" name="submit">Update</button>
				
			</div>
		</div>
	 </div>
    </form>
  </div>
 	</div>
 	<!--//grid-->

<!-- script-for sticky-nav -->
		<script>
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
			 
		});
		</script>
		<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block">

</div>
<!--inner block end here-->
<?php include_once('includes/footer.php');?>
</div>
</div>
 <?php include_once('includes/sidebar.php');?>
							  <div class="clearfix"></div>		
							</div>
							<script>
							var toggle = true;
										
							$(".sidebar-icon").click(function() {                
							  if (toggle)
							  {
								$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
								$("#menu span").css({"position":"absolute"});
							  }
							  else
							  {
								$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
								setTimeout(function() {
								  $("#menu span").css({"position":"relative"});
								}, 400);
							  }
											
											toggle = !toggle;
										});
							</script>
<!--js -->
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.min.js"></script>
   <!-- /Bootstrap Core JavaScript -->	   

</body>
</html>
<?php } ?>
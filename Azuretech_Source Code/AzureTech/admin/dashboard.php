<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['wsmsaid']==0)) {
  header('location:logout.php');
  } 
     ?>
<!DOCTYPE html>
<html lang = "en">
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<title>Dashboard</title>
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Icons -->
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
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
	<style>
  #alert_popover
  {
   display:block;
   position:fixed;
  }
  .wrapper {
    display: table-cell;
    vertical-align: bottom;
    height: auto;
    width:415px;
  }
  .alert_default
  {
   color: #0a58ca;
   font-size: 18px;
   background-color: #cfe2ff;
   border-color: #9ec5fe;
  }
  </style>
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
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a> <i class="fa fa-angle-right"></i></li>
            </ol>
<!--four-grids here-->
		<div class="four-grids">
					<div class="col-md-3 four-grid">
						<?php $query=mysqli_query($con,"Select * from tblorderaddresses");
$totalorder=mysqli_num_rows($query);
?>

						<div class="four-agileits" onclick="location.href='all-orders.php';" style="cursor: pointer;">

							<div class="icon">
								<i class="glyphicon glyphicon-list-alt" aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<h3><a class="text-muted text-uppercase m-b-20" href="all-orders.php" style="font-size: 18px"><strong style="color: white">Total Orders</strong></a></h3>
								<h4> <?php echo $totalorder;?>  </h4>
								
							</div>
							
						</div>
					</div>
					<div class="col-md-3 four-grid">
						<?php $query1=mysqli_query($con,"Select * from tblorderaddresses where OrderFinalStatus is null");
$neworder=mysqli_num_rows($query1);
?>
						<div class="four-agileits " onclick="location.href='new-order.php';" style="cursor: pointer;">
							<div class="icon">
								
								<i class="glyphicon glyphicon-list-alt" aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<h3><a class="text-muted text-uppercase m-b-20" href="new-order.php" style="font-size: 18px"><strong style="color: white">New Orders</strong></a></h3>
								<h4><?php echo $neworder;?></h4>

							</div>
							
						</div>
					</div>
					<div class="col-md-3 four-grid">
						<?php $query2=mysqli_query($con,"Select * from tblorderaddresses where OrderFinalStatus='Order Accept'");
						$acceptorder=mysqli_num_rows($query2);
						?>
						<div class="four-agileits " onclick="location.href='accept-order.php';" style="cursor: pointer;">
							<div class="icon">
								<i class="glyphicon glyphicon-folder-open" aria-hidden="true"></i>
							</div>
							<div class="four-text">
							<h3><a class="text-muted text-uppercase m-b-20" href="accept-order.php" style="font-size: 18px"><strong style="color: white">Accepted Orders</strong></a></h3>
								<h4><?php echo $acceptorder;?></h4>
								
							</div>
							
						</div>
					</div>
					<div class="col-md-3 four-grid">
						<?php $query3=mysqli_query($con,"Select * from tblorderaddresses where OrderFinalStatus='Order On its Way'");
$onthewayorder=mysqli_num_rows($query3);
?>
						<div class="four-agileits " onclick="location.href='order-onthway.php';" style="cursor: pointer;">
							<div class="icon">
								<i class="glyphicon glyphicon-list-alt" aria-hidden="true"></i>
							</div>
							<div class="four-text">
							<h3><a class="text-muted text-uppercase m-b-20" href="order-onthway.php" style="font-size: 18px"><strong style="color: white">Out for Delivery</strong></a></h3>
								<h4><?php echo $onthewayorder;?></h4>
								
							</div>
							
						</div>
					</div>
					<div class="clearfix"></div>
				</div>

              	<div class="four-grids">
					<div class="col-md-3 four-grid">
						<?php $query4=mysqli_query($con,"Select * from tblorderaddresses where OrderFinalStatus='Bottle Delivered'");
$orderdel=mysqli_num_rows($query4);
?>

						<div class="four-agileits" onclick="location.href='order-delivered.php';" style="cursor: pointer;">

							<div class="icon">
								<i class="glyphicon glyphicon-list-alt" aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<h3><a class="text-muted text-uppercase m-b-20" href="order-delivered.php" style="font-size: 18px"><strong style="color: white">Delivered Orders</strong></a></h3>
								<h4> <?php echo $orderdel;?>  </h4>
								
							</div>
							
						</div>
					</div>
					<div class="col-md-3 four-grid">
						<?php $query5=mysqli_query($con,"Select * from tblorderaddresses where OrderFinalStatus='Order Cancelled'");
$cancelorder=mysqli_num_rows($query5);
?>
						<div class="four-agileits " onclick="location.href='order-cancelled.php';" style="cursor: pointer;">
							<div class="icon">
								
								<i class="glyphicon glyphicon-list-alt" aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<h3><a class="text-muted text-uppercase m-b-20" href="order-cancelled.php" style="font-size: 18px"><strong style="color: white">Cancelled Orders</strong></a></h3>
								<h4><?php echo $cancelorder;?></h4>

							</div>
							
						</div>
					</div>
					<div class="col-md-3 four-grid">
						<?php $query6=mysqli_query($con,"Select * from tbluser");
$usercount=mysqli_num_rows($query6);
?>

						<div class="four-agileits  " onclick="location.href='manage-users.php';" style="cursor: pointer;">
							<div class="icon">
								<i class="glyphicon glyphicon-user" aria-hidden="true"></i>
							</div>
							<div class="four-text">
							<h3><a class="text-muted text-uppercase m-b-20" href="manage-users.php" style="font-size: 18px"><strong style="color: white">Total Customers</strong></a></h3>
								<h4><?php echo $usercount;?></h4>
								
							</div>
							
						</div>
					</div>
					<!--<div class="col-md-3 four-grid">
						<?php $query7=mysqli_query($con,"Select * from tblcompany");
$compcount=mysqli_num_rows($query7);
?>
						<div class="four-wthree">
							<div class="icon">
								<i class="glyphicon glyphicon-briefcase" aria-hidden="true"></i>
							</div>
							<div class="four-text">
							<h3><a class="text-muted text-uppercase m-b-20" href="manage-company.php" style="font-size: 20px"><strong style="color: white">Total Company</strong></a></h3>
								<h4><?php echo $compcount;?></h4>
								
							</div>
							
						</div>
					</div>-->
					<div class="clearfix"></div>
				</div>
          
	
	

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

	<div id="alert_popover">
    <div class="wrapper">
     <div class="content">

     </div>
    </div>
   </div> 
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

</body>
<script>
$(document).ready(function(){

	setInterval(function(){
	load_last_notification();
	}, 5000);

	function load_last_notification(){
		$.ajax({
		url:"fetch.php",
		method:"POST",
		success:function(data){
		$('.content').html(data);
		}
		
	})
	}


});
</script>
</html>
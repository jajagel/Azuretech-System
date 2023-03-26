<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['wsmsaid']==0)) {
  header('location:logout.php');
  } else{



  ?>
<!DOCTYPE HTML>
<html>
<head>
<title>Customer Profile</title>

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
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a><i class="fa fa-angle-right"></i><a href="manage-users.php">Customers</a><i class="fa fa-angle-right"></i>Customer Profile</li>
            </ol>
		<!--grid-->
 	<div class="grid-form">
 


  <div class="grid-form1">
  	       <h3>Customer Profile</h3>
  	         <div class="tab-content">
						<div class="tab-pane active" id="horizontal-form">
							<form class="form-horizontal" method="post">
							<p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
  <?php
  $uid=$_GET['viewid'];

$ret=mysqli_query($con,"select * from tbluser where ID='$uid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
								
								<table border="2" class="table table-bordered"  style="width: 40em;">
								<tr>
									<th class="col-sm-2 control-label">Full Name </th>
									<td style="padding-left: 10px"><?php  echo $row['FullName'];?></td>
								</tr>
								<tr>
									<th class="col-sm-2 control-label">Mobile Number </th>
									<td style="padding-left: 10px"><?php  echo $row['MobileNo'];?></td>
								</tr>
								<tr>
									<th class="col-sm-2 control-label">Email </th>
									<td style="padding-left: 10px"><?php  echo $row['Email'];?></td>
								</tr>
								<tr>
									<th class="col-sm-2 control-label">Address </th>
									<td style="padding-left: 10px"><?php  echo $row['Address'];?></td>
								</tr>
								<tr>
									<th class="col-sm-2 control-label">Location </th>
									<td style="padding-left: 10px">
										<div id="mapp" style="height:300px; width: 100%;" class="my-3"></div>

									</td>
								</tr>
								<tr>
									<th class="col-sm-2 control-label">Landmark </th>
									<td style="padding-left: 10px"><?php  echo $row['Landmark'];?></td>
								</tr>
								<tr>
									<th class="col-sm-2 control-label">Registration Date </th>
									<td style="padding-left: 10px"><?php  echo $row['RegDate'];?></td>
								</tr>
								</table>
							</div>
								
						
						
						</div>
			
 <?php 
 $lat=$row['Latitude'];
 $lng=$row['Longitude'];
} ?>
    
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
<script>
                    let map;

                    function initMap() {
                        map = new google.maps.Map(document.getElementById("mapp"), {
                            center: { lat: <?php Print($lat); ?>, lng: <?php Print($lng); ?> }, 
                            zoom: 8,
                            scrollwheel: true,
                        });
                        const uluru = { lat: <?php Print($lat); ?>, lng: <?php Print($lng); ?> };
                        let marker = new google.maps.Marker({
                            position: uluru,
                            map: map,
                            draggable: false
                        });
                       
                        map.setZoom(15);
                    }

                </script>
                <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCy5e4PTG0mVDPWmxnYJdGgh8PRxe8MxI4&callback=initMap"
                        type="text/javascript"></script>
</body>
</html>
<?php } ?>
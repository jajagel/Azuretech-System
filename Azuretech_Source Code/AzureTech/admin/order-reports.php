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
<title>Reports</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script>
    $(document).ready(function(){
      if(localStorage.selected) {
        $('#' + localStorage.selected ).attr('checked', true);
      }
      $('.inputabs').click(function(){
        localStorage.setItem("selected", this.id);
      });
    });

</script>
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
<!-- tables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" />
<link rel="stylesheet" type="text/css" href="css/table-style.css" />

<!-- //tables -->
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
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a><i class="fa fa-angle-right"></i>Order report
            </ol>


		<!--grid-->
 	<div class="grid-form">
 


  <div class="grid-form1">
  	       <h3>Order report</h3>
  	         <div class="tab-content">
						<div class="tab-pane active" id="horizontal-form">
							<form class="form-horizontal" method="post" name="bwdatesreport"  action="order-reports.php" enctype="multipart/form-data">
								 <p style="font-size:16px; color:red" align="left"> <?php if($msg){
    echo $msg;
  }  ?> </p>			
					<div class="form-group">
									<label for="mediuminput" class="col-sm-2 control-label">From Date</label>
									<div class="col-sm-8">
										<input type="date" class="form-control" name="fromdate" id="fromdate" value="<?php echo isset($_POST['fromdate']) ? htmlspecialchars($_POST['fromdate'], ENT_QUOTES) : ''; ?>" required='true'style="width: 30em;">
									</div>
								</div>
								<div class="form-group">
									<label for="mediuminput" class="col-sm-2 control-label">To Date</label>
									<div class="col-sm-8">
										<input type="date" class="form-control" name="todate" id="todate" value="<?php echo isset($_POST['todate']) ? htmlspecialchars($_POST['todate'], ENT_QUOTES) : ''; ?>" required='true'style="width: 30em;" required='true' style="width: 30em;">
									</div>
								</div>
								<div class="form-group">
									<label for="mediuminput" class="col-sm-2 control-label">Delivery Status</label>
									<div class="col-sm-8">
										<input class="inputabs" id="tab1" type="radio" name="requesttype" checked="true" value="all">All
									  <input class="inputabs" id="tab2" type="radio" name="requesttype" value="Order Accept">Accepted
									  <input class="inputabs" value="Order On its Way" id="tab3" type="radio" name="requesttype">Out for Delivery
									  <input class="inputabs" id="tab4" type="radio" name="requesttype" value="Bottle Delivered">Delivered
									  <input class="inputabs" id="tab5" type="radio" name="requesttype" value="Order Cancelled">Cancelled
									</div>
								</div>		


							
								
						
						</div>
					</div>

      <div class="panel-footer">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<button class="btn-primary btn" type="submit" name="submit">Submit</button>
				
			</div>
		</div>
	 </div>
    </form>

    	<!-- TABLE -->
 	 <?php
$fdate=$_POST['fromdate'];
$tdate=$_POST['todate'];
$rtype=$_POST['requesttype'];
?>
<?php if($rtype=="all"){
				$sql="select * from tblorderaddresses where date(OrderTime) between '$fdate' and '$tdate'";

				  	if ($result = mysqli_query($con, $sql)){
			    	$rowcount = mysqli_num_rows( $result );}?>
					<h4 align="center" style="color:#1b93e1;"> All Orders </h4>
					<h5 align="center" style="color:black">Report from <?php echo $fdate?> to <?php echo $tdate?></h5>
				<hr />
				<div class="col-sm-6">
				<h5> Total number of orders:	<?php echo $rowcount;?></h5></div><div class="col-sm-6">
				<div  align="right" style="padding-bottom:20px;">
				<a href="allpdf.php?fdate=<?php echo $fdate;?>&tdate=<?php echo $tdate;?>&total=<?php echo $rowcount;?>" target="_blank" class="btn-primary btn" type="submit" name="report">View PDF</a>
				</div>
			</div>
				  <table id="tblOrder" >
					<thead>
                <tr>
                  <th></th>
                  <th>Order Number</th>
                  <th>Order Date</th>
                  <th>Total</th>
                  <th>Action</th>
                  
                </tr>
              </thead>
					
					<?php
$ret=mysqli_query($con,"select * from tblorderaddresses where date(OrderTime) between '$fdate' and '$tdate'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
              
                <tr>
                  <td><?php echo $cnt;?></td>
            	
                 
                  <td><?php  echo $row['Ordernumber'];?></td>
                  <td><?php  echo $row['OrderTime'];?></td>
                  <td>₱<?php  echo $row['Total'];?>.00</td>
                  
                  <td><a target="_blank" href="view-order.php?orderid=<?php echo $row['Ordernumber'];?>">View Details</a>
                </tr>
                <?php 
$cnt=$cnt+1;
}?>
				  </table>
				  <?php } if($rtype=="Order Accept"){
				  	$sql="select * from tblorderaddresses where OrderFinalStatus ='Order Accept' && date(OrderTime) between '$fdate' and '$tdate'";

				  	if ($result = mysqli_query($con, $sql)) {
			    	$rowcount = mysqli_num_rows( $result );}?>
				  	<h4 align="center" style="color:#1b93e1;"> Accepted Orders </h4>
				  	<h5 align="center" style="color:black">Report from <?php echo $fdate?> to <?php echo $tdate?></h5>
				<hr />
				<div class="col-sm-6">
				<h5> Total number of orders:	<?php echo $rowcount;?></h5></div><div class="col-sm-6">
				<div  align="right" style="padding-bottom:20px;">
				<a href="acceptedpdf.php?fdate=<?php echo $fdate;?>&tdate=<?php echo $tdate;?>&total=<?php echo $rowcount;?>" target="_blank" class="btn-primary btn" type="submit" name="report">View PDF</a>
				</div>
			</div>
				  <table id="tblOrder" >
					<thead>
                <tr>
                  <th></th>
                  <th>Order Number</th>
                  <th>Order Date</th>
                  <th>Total</th>
                  <th>Action</th>
                </tr>
              </thead>
					
					<?php
$ret=mysqli_query($con,"select * from tblorderaddresses where OrderFinalStatus='Order Accept' && date(OrderTime) between '$fdate' and '$tdate'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
              
                <tr>
                  <td><?php echo $cnt;?></td>
            
                 
                  <td><?php  echo $row['Ordernumber'];?></td>
                  <td><?php  echo $row['OrderTime'];?></td>
                  <td>₱<?php echo $row['Total'];?>.00</td>
                  <td><a target="_blank" href="view-order.php?orderid=<?php echo $row['Ordernumber'];?>">View Details</a>
                </tr>
                <?php 
$cnt=$cnt+1;
}?>

				  </table>

				  <?php } if($rtype=="Order On its Way"){

				  	$sql="select * from tblorderaddresses where OrderFinalStatus ='Order On its Way' && date(OrderTime) between '$fdate' and '$tdate'";

				  	if ($result = mysqli_query($con, $sql)) {
			    	$rowcount = mysqli_num_rows( $result );
					 }?>
				  	<h4 align="center" style="color:#1b93e1;"> Out for Delivery Orders </h4>
				  	<h5 align="center" style="color:black">Report from <?php echo $fdate?> to <?php echo $tdate?></h5>
				<hr />
					<div class="col-sm-6">
				<h5> Total number of orders:	<?php echo $rowcount;?></h5></div><div class="col-sm-6">
				<div  align="right" style="padding-bottom:20px;">
				<a href="outfordeliverypdf.php?fdate=<?php echo $fdate;?>&tdate=<?php echo $tdate;?>&total=<?php echo $rowcount;?>" target="_blank" class="btn-primary btn" type="submit" name="report">View PDF</a>
				</div>
			</div>
				  <table id="tblOrder" >
					<thead>
                <tr>
                  <th></th>
                  <th>Order Number</th>
                  <th>Order Date</th>
                  <th>Total</th>
                  <th>Action</th>
                </tr>
              </thead>
					
					<?php
$ret=mysqli_query($con,"select * from tblorderaddresses where OrderFinalStatus ='Order On its Way' && date(OrderTime) between '$fdate' and '$tdate'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
              
                <tr>
                  <td><?php echo $cnt;?></td>
            
                 
                  <td><?php  echo $row['Ordernumber'];?></td>
                  <td><?php  echo $row['OrderTime'];?></td>
                  <td>₱<?php echo $row['Total'];?>.00</td>
                  <td><a target="_blank" href="view-order.php?orderid=<?php echo $row['Ordernumber'];?>">View Details</a>
                </tr>
                <?php 
$cnt=$cnt+1;
}?>
				  </table>


			<?php } if($rtype=="Bottle Delivered"){
					
				$sql="select * from tblorderaddresses where OrderFinalStatus ='Bottle Delivered' && date(OrderTime) between '$fdate' and '$tdate'";

			    if ($result = mysqli_query($con, $sql)) {
			    $rowcount = mysqli_num_rows( $result );
				 }?>

			
				<h4 align="center" style="color:#1b93e1;"> Delivered Orders </h4>
				<h5 align="center" style="color:black">Report from <?php echo $fdate?> to <?php echo $tdate?></h5>
				<hr />
				<div class="col-sm-6">
				<h5> Total number of orders:	<?php echo $rowcount;?></h5></div><div class="col-sm-6">
				<div  align="right" style="padding-bottom:20px;">
				<a href="deliveredpdf.php?fdate=<?php echo $fdate;?>&tdate=<?php echo $tdate;?>&total=<?php echo $rowcount;?>" target="_blank" class="btn-primary btn" type="submit" name="report">View PDF</a>
				</div>
			</div>
				  <table id="tblOrder" >
					<thead>
                <tr>
                  <th></th>
                  <th>Order Number</th>
                  <th>Order Date</th>
                  <th>Total</th>
                  <th>Action</th>
                </tr>
              </thead>
					
					<?php
$ret=mysqli_query($con,"select * from tblorderaddresses where OrderFinalStatus ='Bottle Delivered' && date(OrderTime) between '$fdate' and '$tdate'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
              
                <tr>
                  <td><?php echo $cnt;?></td>
            
                 
                  <td><?php  echo $row['Ordernumber'];?></td>
                  <td><?php  echo $row['OrderTime'];?></td>
                  <td>₱<?php echo $row['Total'];?>.00</td>
                  <td><a target="_blank" href="view-order.php?orderid=<?php echo $row['Ordernumber'];?>">View Details</a>
                </tr>
                <?php 
$cnt=$cnt+1;
}?>
				  </table>
				  
				  <?php } if($rtype=="Order Cancelled"){
				  	$sql="select * from tblorderaddresses where OrderFinalStatus ='Order Cancelled' && date(OrderTime) between '$fdate' and '$tdate'";

				  	if ($result = mysqli_query($con, $sql)) {
			    	$rowcount = mysqli_num_rows( $result );}?>
				  	<h4 align="center" style="color:#1b93e1;"> Cancelled Orders </h4>
				  	<h5 align="center" style="color:black">Report from <?php echo $fdate?> to <?php echo $tdate?></h5>
				<hr />
				<div class="col-sm-6">
				<h5> Total number of orders:	<?php echo $rowcount;?></h5></div><div class="col-sm-6">
				<div  align="right" style="padding-bottom:20px;">
				<a href="cancelledpdf.php?fdate=<?php echo $fdate;?>&tdate=<?php echo $tdate;?>&total=<?php echo $rowcount;?>" target="_blank" class="btn-primary btn" type="submit" name="report">View PDF</a>
				</div>
			</div>
				  <table id="tblOrder" >
					<thead>
                <tr>
                  <th></th>
                  <th>Order Number</th>
                  <th>Order Date</th>
                  <th>Total</th>
                  <th>Action</th>
                </tr>
              </thead>
					
					<?php
$ret=mysqli_query($con,"select * from tblorderaddresses where OrderFinalStatus ='Order Cancelled' && date(OrderTime) between '$fdate' and '$tdate'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
              
                <tr>
                  <td><?php echo $cnt;?></td>
            
                 
                  <td><?php  echo $row['Ordernumber'];?></td>
                  <td><?php  echo $row['OrderTime'];?></td>
                  <td>₱<?php echo $row['Total'];?>.00</td>
                  <td><a target="_blank" href="view-order.php?orderid=<?php echo $row['Ordernumber'];?>">View Details</a>
                </tr>
                <?php 
$cnt=$cnt+1;
}?>
				  </table>
			<?php } ?>	

 	<!-- END OF TABLE -->
  </div>
 	</div>
 	<!--//grid-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
<script>
jQuery(document).ready(function($) {
    $('#tblOrder').DataTable();
} );
</script>
 

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
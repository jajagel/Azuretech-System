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
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a><i class="fa fa-angle-right"></i>Sales reports
            </ol>
		<!--grid-->
 	<div class="grid-form">
 


  <div class="grid-form1">
  	       <h3>Sales reports</h3>
  	         <div class="tab-content">
						<div class="tab-pane active" id="horizontal-form">
							<form class="form-horizontal" method="post" name="bwdatesreport"  action="sales-reports.php" enctype="multipart/form-data">
								 <p style="font-size:16px; color:red" align="left"> <?php if($msg){
    echo $msg;
  }  ?> </p>			
					<div class="form-group">
									<label for="mediuminput" class="col-sm-2 control-label">From Date</label>
									<div class="col-sm-8">
										<input type="date" class="form-control" name="fromdate" id="fromdate" value="<?php echo isset($_POST['fromdate']) ? htmlspecialchars($_POST['fromdate'], ENT_QUOTES) : ''; ?>" required='true'style="width: 30em;" required='true' style="width: 30em;">
									</div>
								</div>
								<div class="form-group">
									<label for="mediuminput" class="col-sm-2 control-label">To Date</label>
									<div class="col-sm-8">
										<input type="date" class="form-control" name="todate" id="todate" value="<?php echo isset($_POST['todate']) ? htmlspecialchars($_POST['todate'], ENT_QUOTES) : ''; ?>" required='true' style="width: 30em;">
									</div>
								</div>
								<div class="form-group">
									<label for="mediuminput" class="col-sm-2 control-label">Request Type</label>
									<div class="col-sm-8">
										
										<!--<input type="radio" name="requesttype" value="dlywise" checked="true">Daily
										<input type="radio" name="requesttype" value="wlywise">Weekly
										<input type="radio" name="requesttype" value="mtwise">Monthly
                  				<input type="radio" name="requesttype" value="yrwise">Yearly-->

										<input class="inputabs" id="tab1" type="radio" name="requesttype" checked="checked" value="dlywise">Daily
									  <input class="inputabs" id="tab2" type="radio" name="requesttype" value="wlywise">Weekly
									  <input class="inputabs" value="mtwise" id="tab3" type="radio" name="requesttype">Monthly
									  <input class="inputabs" id="tab4" type="radio" name="requesttype" value="yrwise">Yearly
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
<?php if($rtype=='mtwise'){

	$sql="select month(OrderTime) as lmonth,year(OrderTime) as lyear,sum(Total) as totalprice from tblorderaddresses where (date(tblorderaddresses.OrderTime) between '$fdate' and '$tdate') and (OrderFinalStatus='Bottle Delivered') group by lmonth,lyear";

	$result = mysqli_query($con, $sql); 
	while($row=mysqli_fetch_array($result)){
	$fprice = $row['totalprice'];
	$sum += $fprice;
	}

$month1=strtotime($fdate);
$month2=strtotime($tdate);
$m1=date("F",$month1);
$m2=date("F",$month2);
$y1=date("Y",$month1);
$y2=date("Y",$month2);
    ?>


<h4 align="center" style="color:#1b93e1;"> Monthly Sales Report </h4>
<h5 align="center" style="color:black">Report from <?php echo $m1."-".$y1;?> to <?php echo $m2."-".$y2;?></h5>
<hr />


<div class="col-sm-6">
<h5> Total Sales:	₱<?php echo $sum;?>.00</h5></div>
<div class="col-sm-6">
	<div  align="right" style="padding-bottom:20px;">
				<a href="monthlypdf.php?fdate=<?php echo $fdate;?>&tdate=<?php echo $tdate;?>&total=<?php echo $sum;?>" target="_blank" class="btn-primary btn" type="submit" name="report">View PDF</a>
				</div>
			</div>

				  <table id="tblOrder" >
				 <thead>
<tr>
<th></th>
<th>Month/Year </th>
<th>Sales</th>
</tr>
</thead>
					
					<?php
$ret=mysqli_query($con,"select month(OrderTime) as lmonth,year(OrderTime) as lyear,sum(Total) as totalprice from tblorderaddresses where (date(tblorderaddresses.OrderTime) between '$fdate' and '$tdate') and (OrderFinalStatus='Bottle Delivered') group by lmonth,lyear");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
              
                <tr>
                    <td><?php echo $cnt;?></td>
                  <td><?php  echo $row['lmonth']."/".$row['lyear'];?></td>
              <td>₱<?php  echo $total=$row['totalprice'];?>.00</td>
             
                    </tr>
                <?php
$ftotal+=$total;
$cnt++;
}?>

				  </table>
				 
					<!-- DAILY -->
				<?php } if($rtype=='dlywise'){
					$sql="select day(OrderTime) as lday,month(OrderTime) as lmonth,year(OrderTime) as lyear,sum(Total) as totalprice from tblorderaddresses where (date(tblorderaddresses.OrderTime) between '$fdate' and '$tdate') and (OrderFinalStatus='Bottle Delivered') group by lday,lmonth";

	$result = mysqli_query($con, $sql); 
	while($row=mysqli_fetch_array($result)){
	$fprice = $row['totalprice'];
	$sum += $fprice;
	}

					$year1=strtotime($fdate);
					$year2=strtotime($tdate);
					$d1=date("d",$year1);
					$d2=date("d",$year2);
					$m1=date("F",$year1);
					$m2=date("F",$year2);
					$y1=date("Y",$year1);
					$y2=date("Y",$year2);
    ?>
<h4 align="center" style="color:#1b93e1;"> Daily Sales Report </h4>
<h5 align="center" style="color:black">Report from <?php echo $m1."-".$d1."-".$y1;?> to <?php echo $m2."-".$d2."-".$y2;?></h5>
<hr />
<div class="col-sm-6">
<h5> Total Sales:	₱<?php echo $sum;?>.00</h5></div>
<div class="col-sm-6">
	<div  align="right" style="padding-bottom:20px;">
				<a href="dailypdf.php?fdate=<?php echo $fdate;?>&tdate=<?php echo $tdate;?>&total=<?php echo $sum;?>"target="_blank"class="btn-primary btn" name="report">View PDF</a>
				</div>
			</div>
				  <table id="tblOrder" >
				 <thead>
<tr>
<th></th>
<th>Month/Day/Year </th>
<th>Sales</th>
</tr>
</thead>
					
					<?php
$ret=mysqli_query($con,"select day(OrderTime) as lday,month(OrderTime) as lmonth,year(OrderTime) as lyear, sum(Total) as totalprice from tblorderaddresses where (date(tblorderaddresses.OrderTime) between '$fdate' and '$tdate') and (OrderFinalStatus='Bottle Delivered') group by lday,lmonth");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
		              
		                <tr>
		                    <td><?php echo $cnt;?></td>
		                  <td><?php  echo $row['lmonth']."/".$row['lday']."/".$row['lyear'];?></td>
		              <td>₱<?php  echo $total=$row['totalprice'];?>.00</td>
		             
		                    </tr>
		                 </tr>
		                <?php
		$ftotal+=$total;
		$cnt++;
		}?>
   
   
				  </table>

		
					<!-- //DAILY -->
					<!-- WEEKLY -->
				<?php } if($rtype=='wlywise'){
					$sql="select week(OrderTime) as lweek, month(OrderTime) as lmonth,year(OrderTime) as lyear, sum(Total) as totalprice from tblorderaddresses where (date(tblorderaddresses.OrderTime) between '$fdate' and '$tdate') and (OrderFinalStatus='Bottle Delivered') group by lweek";

					$result = mysqli_query($con, $sql); 
					while($row=mysqli_fetch_array($result)){
					$fprice = $row['totalprice'];
					$sum += $fprice;
					}

					$year1=strtotime($fdate);
					$year2=strtotime($tdate);
					$d1=date("d",$year1);
					$d2=date("d",$year2);
					$m1=date("F",$year1);
					$m2=date("F",$year2);
					$y1=date("Y",$year1);
					$y2=date("Y",$year2);
					 ?>
					 <h4 align="center" style="color:#1b93e1;"> Weekly Sales Report </h4>
					<h5 align="center" style="color:black">Report from <?php echo $m1."-".$d1."-".$y1;?> to <?php echo $m2."-".$d2."-".$y2;?></h5>
					    <hr/>
					 <div class="col-sm-6">
<h5> Total Sales:	₱<?php echo $sum;?>.00</h5></div>
<div class="col-sm-6">
	<div  align="right" style="padding-bottom:20px;">
				<a href="weeklypdf.php?fdate=<?php echo $fdate;?>&tdate=<?php echo $tdate;?>&total=<?php echo $sum;?>" target="_blank" class="btn-primary btn" type="submit" name="report">View PDF</a>
				</div>
			</div>
									  <table id="tblOrder" >
										<thead>
					<tr>
					<th></th>
					<th> Week Date </th>
					<th>Sales</th>
					</tr>
					</thead>
										
					<?php
					$ret=mysqli_query($con,"select week(OrderTime) as lweek, month(OrderTime) as lmonth,year(OrderTime) as lyear, sum(Total) as totalprice from tblorderaddresses where (date(tblorderaddresses.OrderTime) between '$fdate' and '$tdate') and (OrderFinalStatus='Bottle Delivered') group by lweek");
					$cnt=1;
					while ($row=mysqli_fetch_array($ret)) {
						$week_start = new DateTime();
						$week_start->setISODate($row['lyear'],$row['lweek']);

						$week_end = new DateTime();
						$week_end->setISODate($row['lyear'],$row['lweek']);
						$week_end->modify('+5 days');
					?>
              
                <tr>
                    <td><?php echo $cnt;?></td>

                  <td><?php $add= $week_start->modify('-1 day');echo $week_start->format('m-d-Y').' to '.$week_end->format('m-d-Y');?></td>
              <td>₱<?php  echo $total=$row['totalprice'];?>.00</td>
             
                    </tr>
                 </tr>
                <?php
$ftotal+=$total;
$cnt++;
}?>
   
				  </table>
					
					<!--YEARLY-->
					<?php } if($rtype=='yrwise'){
					$sql="select year(OrderTime) as lyear,sum(Total) as totalprice from tblorderaddresses  where (date(tblorderaddresses.OrderTime) between '$fdate' and '$tdate') and (tblorderaddresses.OrderFinalStatus='Bottle Delivered') group by lyear";

					$result = mysqli_query($con, $sql); 
					$num=1;
					while($row=mysqli_fetch_array($result)){
					$fprice = $row['totalprice'];
					$sum += $fprice;
					}
					$year1=strtotime($fdate);
					$year2=strtotime($tdate);
					$y1=date("Y",$year1);
					$y2=date("Y",$year2);
					 ?>
 		<h4 align="center" style="color:#1b93e1;"> Yearly Sales Report </h4>
		<h5 align="center" style="color:black">Report from <?php echo $y1;?> to <?php echo $y2;?></h5>
		    <hr/>
		 <div class="col-sm-6">
<h5> Total Sales:	₱<?php echo $sum;?>.00</h5></div>
<div class="col-sm-6">
	<div  align="right" style="padding-bottom:20px;">
				<a href="yearlypdf.php?fdate=<?php echo $fdate;?>&tdate=<?php echo $tdate;?>&total=<?php echo $sum;?>"target="_blank"class="btn-primary btn" name="report">View PDF</a>
				</div>
			</div>
						  <table id="tblOrder" >
							<thead>
		<tr>
		<th></th>
		<th> Year </th>
		<th>Sales</th>
		</tr>
		</thead>
							<?php
		$ret=mysqli_query($con,"select year(OrderTime) as lyear,sum(Total) as totalprice from tblorderaddresses  where (date(tblorderaddresses.OrderTime) between '$fdate' and '$tdate') and (tblorderaddresses.OrderFinalStatus='Bottle Delivered') group by lyear");
		$cnt=1;
		while ($row=mysqli_fetch_array($ret)) {

		?>
		              
		                <tr>
		                    <td><?php echo $cnt;?></td>
		                  <td><?php  echo $row['lyear'];?></td>
		              <td>₱<?php  echo $total=$row['totalprice'];?>.00</td>
		             
		                    </tr>
		                 </tr>
		                <?php
		$ftotal+=$total;
		$cnt++;
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
<?php } 


?>


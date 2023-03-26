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
<title>Inventory</title>
<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
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
<!-- tables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" />
<link rel="stylesheet" type="text/css" href="css/table-style.css" />

<!-- //tables -->
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
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a><i class="fa fa-angle-right"></i>Inventory</li>
            </ol>
<div class="agile-grids">	
				<!-- tables -->
				
				<div class="agile-tables">
					<div class="w3l-table-info">
					 
					   
		
				  <h3>Inventory</h3>
				  <div align="right">
					<button  data-toggle="modal" data-target="#bottlein" class="btn btn-primary" style="margin-bottom:20px;"><i style="margin-right:5px;"class="fa fa-qrcode" aria-hidden="true"></i>
					 scan bottle
					</button>
					</div>
				  <table id="tblOrder">
					 <thead>
                                        <tr>
                                            <tr>
                  <th></th>                 
                    <th>Bottle Size</th>
                    <th>In</th>
                    <th>Out</th>  
                    <th>Onhand </th>      
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                                        </tr>
        
					</thead>


					<?php
$ret=mysqli_query($con,"select * from  tblsize");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
              
                <tr>
                  <td><?php echo $cnt;?></td>                
                  <td><?php  echo $row['SizeName'];?></td>
                  <td><?php  echo $row['Stock'];?></td>
                  <td><?php  echo $row['StockOut'];?></td>
                  <td><?php  echo $onhand=$row['Stock']-$row['StockOut'];?></td>
                  <td>
                  	<?php 
                  	if($onhand>=1){
                  		echo 'In Stock';
                  	}else{
                  		echo 'Out of Stock';
                  		}?>
                  </td>          
	                  <td>
	                  		<a href="edit-inventory.php?editid=<?php echo $row['ID'];?>">Edit Details</a>
	                  	<!-- Button trigger modal 
						<a class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
					  Edit
					</a>--> 

<!-- scan qr -->
<div class="modal fade" style="display:none;" id="bottlein" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">Scan Bottle</h3>
       
      </div>
      <div class="modal-body">
        	<div style="padding-bottom:10px; margin-left:30px;" ><video id="preview" width="500px"></video></div>
			
				<form action="update-inventory.php" method="post" class="form-horizontal">
					<!--<label>Bottle Size</label>
					<input type="text" name="text" id="text" placeholder="scan qrcode" class="form-control">
					<div class="modal-body" style="padding-bottom:20px; padding-top:25px;">-->
					<div class="form-group " style=" padding-top:10px;">
						<label for="mediuminput" style="font-size: 16px;" class="col-sm-3 control-label">QR Code</label>
						<div class=" col-sm-8">
							<input type="text" name="text" id="text" placeholder="Scan QR Code" class="form-control">
						</div>
					</div>
						
					
				</form>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

 </td>
                </tr>
                
                <?php 
$cnt=$cnt+1;


}?>
				  </table>

				</div>
				<!-- //tables -->
			</div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script>
			let scanner = new Instascan.Scanner({video: document.getElementById('preview')});
			Instascan.Camera.getCameras().then(function(cameras){
				if (cameras.length > 0 ){
					scanner.start(cameras[0]);
				}else{
					alert('No cameras found');
				}
			}).catch(function(e){
				console.error(e);
			});

			scanner.addListener('scan',function(c){
				document.getElementById('text').value=c;
				document.forms[0].submit();
			});
		</script>

</body>
</html>
<?php }  ?>
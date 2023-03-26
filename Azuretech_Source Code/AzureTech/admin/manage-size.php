<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['wsmsaid']==0)) {
  header('location:logout.php');
  } else{

if(isset($_GET['delid'])){
	$id=$_GET['delid'];

	$sql="delete from tblsize where ID = '$id'";
	$result=mysqli_query($con,$sql);
	if($result){
		header('location:manage-size.php');
	}else
		die(mysqli_error($con));
}

  ?>
<!DOCTYPE HTML>
<html>
<head>
<title>Manage Bottle Size</title>

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
<!--<link rel="stylesheet" type="text/css" href="css/basictable.css" />
<script type="text/javascript" src="js/jquery.basictable.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $('#table').basictable();

      $('#table-breakpoint').basictable({
        breakpoint: 768
      });

      $('#table-swap-axis').basictable({
        swapAxis: true
      });

      $('#table-force-off').basictable({
        forceResponsive: false
      });

      $('#table-no-resize').basictable({
        noResize: true
      });

      $('#table-two-axis').basictable();

      $('#table-max-height').basictable({
        tableWrapper: true
      });
    });
</script>-->
<script language="javascript" type="text/javascript">
var popUpWin=0;
function popUpWindow(URLStr, left, top, width, height)
{
 if(popUpWin)
{
if(!popUpWin.closed) popUpWin.close();
}
popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+300+',height='+390+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
}

</script>
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
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a><i class="fa fa-angle-right"></i>Manage Bottle Size</li>
            </ol>
<div class="agile-grids">	
				<!-- tables -->
				
				<div class="agile-tables">
					<div class="w3l-table-info">
					 
					   
		
				  <h3>Manage Bottle Size</h3>
				  <!-- Button trigger modal -->
				<div align="right">
					<button style="margin-bottom:20px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">
					 add bottle size					</button></div>
				  <table id="tblOrder">
					 <thead>
                                        <tr>
                                            <tr>
                  <th></th>
            
                 
                    <th>Bottle Size</th>
                   
                          <th>Action</th>
                          <th>QR Code</th>

                </tr>
                                        </tr>
                                        </thead>
					</thead>
					<?php
$ret=mysqli_query($con,"select *from  tblsize");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
              
                <tr>
                  <td><?php echo $cnt;?></td>
            
                 
                  <td><?php  echo $row['SizeName'];?></td>
                  
                  <td>
                  	<a href="edit-size-detail.php?editid=<?php echo $row['ID'];?>">Edit Details</a>
                  	<a title="Delete" href="manage-size.php?delid=<?=$row['ID']?>" class="trash" onclick="return confirm('Do you really want to delete?');"><i class="fa fa-trash fa-delete" aria-hidden="true" style="color:#007bff; padding-left: 20px; "></i></a>
                  </td>
                  <td>
									<?php    

									$link = "http"; 
									$link .= "://"; 
									$link .= $_SERVER['HTTP_HOST']; 
									?>
									 <a href="javascript:void(0);" onClick="popUpWindow('view-qrcode.php?oid=<?php echo htmlentities($row['ID']);?>');" title="Track order">View QR Code</a></li></td>
								</tr>
                <?php 
$cnt=$cnt+1;
}?>
				  </table>

<!-- Modal -->
<form method="POST" action="add-size.php">
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">Add Bottle Size <?php echo $row['ID']; ?></h3>
       
      </div>
      <div class="modal-body" style="padding-bottom:20px; padding-top:25px;">
        	<div class="form-group center">
									<label for="mediuminput" style="font-size: 16px;" class="  col-sm-3 control-label">Size Name</label>
									<div class=" col-sm-8">
										<input type="text" class="form-control" name="cname" id="cname" value="" required='true' style="width:100%;">
									</div>
								</div>

      </div>
      <div class="modal-body" style="padding-bottom:42px;">
        	<div class="form-group center">
									<label for="mediuminput"  style="font-size: 16px;" class="  col-sm-3 control-label">Stock</label>
									<div class=" col-sm-8">
										<input type="number" class="form-control" name="stock" id="stock" value="" required='true' style="width:100%;">
									</div>
								</div>

      </div>
       
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</form>				

<!-- Modal -->
<form method="POST" action="add-size.php">
<div class="modal fade" id="scan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">Add Bottle Size <?php echo $row['ID']; ?></h3>
       
      </div>
      <div class="modal-body" style="padding-bottom:20px; padding-top:25px;">
        	<div class="form-group center">
									<label for="mediuminput" style="font-size: 16px;" class="  col-sm-3 control-label">Size Name</label>
									<div class=" col-sm-8">
										<input type="text" class="form-control" name="cname" id="cname" value="" required='true' style="width:100%;">
									</div>
								</div>

      </div>
      <div class="modal-body" style="padding-bottom:42px;">
        	<div class="form-group center">
									<label for="mediuminput"  style="font-size: 16px;" class="  col-sm-3 control-label">Stock</label>
									<div class=" col-sm-8">
										<input type="number" class="form-control" name="stock" id="stock" value="" required='true' style="width:100%;">
									</div>
								</div>

      </div>

       
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</form>				
<!-- end Modal -->				 

				

				
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

</body>
</html>
<?php }  ?>
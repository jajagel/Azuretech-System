<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['wsmsaid']==0)) {
  header('location:logout.php');
  } else{

if(isset($_GET['delid'])){
	$id=$_GET['delid'];

	$sql="delete from tblwaterbottle where ID = '$id'";
	$result=mysqli_query($con,$sql);
	if($result){
		header('location:manage-bottle.php');
	}else
		die(mysqli_error($con));
}

  ?>
<!DOCTYPE HTML>
<html>
<head>
<title>Manage Product</title>

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
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a><i class="fa fa-angle-right"></i>Manage Products</li>
            </ol>
<div class="agile-grids">	
				<!-- tables -->
				
				<div class="agile-tables">
					<div class="w3l-table-info">
					 
					   
		
				  <h3>Manage Products</h3>
				  <!-- Button trigger modal -->
				<div align="right">
					<button style="margin-bottom:20px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">
					 add product 
					</button></div>
				  <table id="tblOrder" >
					 <thead>
                                        <tr>
                                            <tr>
                  <th></th>
            
                 
                    <th>Water Type</th>
                    <th>Bottle Size</th>
                   <th>Price</th>
                          <th>Action</th>
                </tr>
                                        </tr>
                                        </thead>
					</thead>
					<?php
$ret=mysqli_query($con,"select *from  tblwaterbottle");
$cnt=1;

while ($row=mysqli_fetch_array($ret)) {

?>
              
                <tr>
                  <td><?php echo $cnt;?></td>
            
                 
                  <td><?php  echo $row['CompanyName'];?></td>
                   <td><?php  echo $row['BottleSize'];?></td>
                   <td><?php  echo $row['Price'];?></td>
                  
                  <td>
                  	<a href="edit-bottle-detail.php?editid=<?php echo $row['ID'];?>">Edit Details</a> 

                  	<a title="Delete" href="manage-bottle.php?delid=<?=$row['ID']?>" class="trash" onclick="return confirm('Do you really want to delete?');"><i class="fa fa-trash fa-delete" aria-hidden="true" style="color:#007bff; padding-left: 20px; "></i></a>
                  </td>

                </tr>
                <?php 
$cnt=$cnt+1;
}?>
				  </table>
<!-- Modal -->
<form method="POST" enctype="multipart/form-data" action="add-bottle.php">
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">Add Product</h3>
       
      </div>
      <!--water type-->
      <div class="modal-body" style="padding-bottom:70px; padding-top:25px;">
        	<div class="form-group" style="margin-bottom: 49px;">
									<label for="smallinput" style="font-size: 16px;" class="col-sm-3 control-label">Water Type</label>
									<div class="col-sm-8 " >
										<select class="col-sm-12 form-control" name="cname" id="cname" required="true" style="width:100%;">
                                <option value="">Choose Water Type</option>
                                <?php $query=mysqli_query($con,"select * from tblcompany");
              while($row=mysqli_fetch_array($query))
              {
              ?>    
              <option value="<?php echo $row['CompanyName'];?>"><?php echo $row['CompanyName'];?></option>
                  <?php } ?> 
                            </select>
									</div>
								</div>

					<!--bottle size-->
      <div class="form-group" style="margin-bottom: 98px;">
									<label for="mediuminput" style="font-size: 16px;" class="col-sm-3 control-label">Bottle Size</label>
									<div class="col-sm-8">
										<select class="col-sm-12 form-control" name="size" id="size" required="true" style="width:100%;">
                                <option value="">Choose Bottle Size</option>
                                <?php $query=mysqli_query($con,"select * from tblsize");
              while($row=mysqli_fetch_array($query))
              {
              ?>    
              <option value="<?php echo $row['SizeName'];?>"><?php echo $row['SizeName'];?></option>
                  <?php } ?> 
                            </select>
									</div>
								</div>
						<!--price-->
						<div class="form-group" style="margin-bottom: 147px;">
									<label for="mediuminput" style="font-size: 16px;" class="col-sm-3 control-label">Price</label>
									<div class="col-sm-8">
										<input type="number" class="form-control" name="price" id="price" value="" required='true' style="width:100%;">
									</div>
								</div>
						<!--image-->
						<div class="form-group">
									<label for="mediuminput" style="font-size: 16px;" class="col-sm-3 control-label">Image</label>
									<div class="col-sm-8">
										<input type="file" class="form-control" name="images" id="images" value="" required='true' style="width:100%;">
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
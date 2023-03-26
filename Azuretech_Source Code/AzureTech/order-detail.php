<?php
session_start();
error_reporting(0);
include_once('includes/dbconnection.php');
if (strlen($_SESSION['wsmsuid']==0)) {
  header('location:logout.php');
  } else{ 

 

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Order Details</title>

<link rel="stylesheet" type="text/css" href="styles/bootstrap-4.1.2/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="styles/contact.css">
<script language="javascript" type="text/javascript">
var popUpWin=0;
function popUpWindow(URLStr, left, top, width, height)
{
 if(popUpWin)
{
if(!popUpWin.closed) popUpWin.close();
}
popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+600+',height='+600+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
}

</script>
</head>
<body>

<div class="super_container">
	<div class="super_overlay"></div>
	
	<?php include_once('includes/header.php');?>
	<!-- Home -->

	<div class="home">
		<div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="images/water.jpg" data-speed="0.8"></div>
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="home_content text-center">
						<div class="home_title">Order Details</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Contact -->

	<div class="contact">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title_container text-center">

						<div class="section_title"><h3>
#<?php echo $oid=$_GET['orderid'];?> Order Details
	</h3></div>
					</div>
				</div>
			</div>
<div class="row">
 <div class="col-lg-12">
<?php
//Getting Url
$link = "http"; 
$link .= "://"; 
$link .= $_SERVER['HTTP_HOST']; 

// Getting order Details
$userid= $_SESSION['wsmsuid'];
$ret=mysqli_query($con,"select OrderTime,OrderFinalStatus from tblorderaddresses where UserId='$userid' and Ordernumber='$oid'");
while($result=mysqli_fetch_array($ret)) {
?>

<p style="color:#000"><b>Order # : </b><?php echo $oid?></p>
<p style="color:#000"><b>Order Date : </b><?php echo $od=$result['OrderTime'];?></p>
<p style="color:#000"><b>Order Status :</b> <?php if($result['OrderFinalStatus']==""){
	echo "Waiting for confirmation";
} else {
echo $result['OrderFinalStatus'];
}?> &nbsp;
(<a href="javascript:void(0);" onClick="popUpWindow('trackorder.php?oid=<?php echo $oid;?>');" title="Track order" style="color:#000"> Track order
</a>)</p>

<?php } ?>
<div align="right">
<p>
 <a href="javascript:void(0);" onClick="popUpWindow('invoice.php?oid=<?php echo $oid;?>&&odate=<?php echo $od;?>');" title="Order Invoice" class="btn btn-outline-primary mb-3"> View Invoice</a></p></div>


 </div>
 </div>	

			<div class="row" style="margin-top:1%">
 <div class="col-lg-12">

		<?php 
 $query=mysqli_query($con,"select tblwaterbottle.Image,tblwaterbottle.CompanyName,tblwaterbottle.BottleSize,tblwaterbottle.Price,tblcart.Fprice, tblcart.Quantity,tblcart.BottleId,tblcart.OrderNumber from tblcart join tblwaterbottle on tblwaterbottle.ID=tblcart.BottleId where tblcart.UserId='$userid' and tblcart.OrderNumber=$oid");
$num=mysqli_num_rows($query);
if($num>0){
	$cnt=1;

?>

<table border="1" class="table">
	<tr>
<th></th>
<th>Product Image</th>	
<th>Type</th>	
<th>Size</th>	
<th>Quantity</th>
<th>Price</th>
<th>Total</th>

</tr>
<?php	
while ($row=mysqli_fetch_array($query)) {
	?>



<tr>
<!--<td><?php echo $cnt;?></td>-->
<td><?php echo $cnt;?></td>
<td>
<img class="b-goods-f__img img-scale" src="admin/images/<?php echo $row['Image'];?>" alt="<?php echo $row['Image'];?>" width='200' height='170'></td>
<td><?php echo $row['CompanyName'];?></td>	
<td><?php echo $row['BottleSize'];?>  </td>
<td><?php echo $row['Quantity'];?></td>		
<td>₱<?php echo $row['Fprice'];?>.00</td>
<td>₱<?php echo $total=$row['Fprice']*$row['Quantity'];?>.00</td>
	<?php 
$grandtotal+=$total;
$cnt=$cnt+1; 
                    }        
 ?>
</td>
	
</tr>
<?php } ?>

<tr>
<th colspan="6" style="text-align: center;"></th>	
<th>₱<?php echo number_format($grandtotal,2);?></th>
</tr>
</table>

<?php $ret=mysqli_query($con,"select OrderFinalStatus from tblorderaddresses where Ordernumber='$oid'");
		$row1=mysqli_fetch_array($ret);
		if($row1['OrderFinalStatus']==null){
?>
    <p style="color:red">
        <a href="javascript:void(0);" onClick="popUpWindow('cancelorder.php?oid=<?php echo $oid;?>');" title="Cancel this order" style="color:red">Cancel this order </a>
    </p>
<?php } ?>

				</div>
			</div>
			
		</div>
	</div>

	
	<?php include_once('includes/footer.php');?>
</div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="styles/bootstrap-4.1.2/popper.js"></script>
<script src="styles/bootstrap-4.1.2/bootstrap.min.js"></script>
<script src="plugins/greensock/TweenMax.min.js"></script>
<script src="plugins/greensock/TimelineMax.min.js"></script>
<script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="plugins/greensock/animation.gsap.min.js"></script>
<script src="plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
</body>
</html>
<?php } ?>
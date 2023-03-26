<?php
session_start();
error_reporting(0);
include_once('includes/dbconnection.php');
if (strlen($_SESSION['wsmsuid']==0)) {
  header('location:logout.php');
  } else{ 

  	// Code for deleting product from cart
if(isset($_GET['delid']))
{
$rid=intval($_GET['delid']);
$query=mysqli_query($con,"delete from tblcart where ID='$rid'"); 
  echo "<script>window.location.href = 'cart.php'</script>";     


}
if(isset($_GET['delno']))
{
$rid=intval($_GET['delno']);
$query=mysqli_query($con,"delete from tblcart where UserId='$rid' and IsOrderPlaced is null");
   
  echo "<script>window.location.href = 'cart.php'</script>";     
}

//placing order
if(isset($_POST['delete'])){
$query=mysqli_query($con,"delete from tblcart where ID='$rid'");
}
if(isset($_POST['submit'])){
//getting address
$grtotal=$_POST['gtotal'];
//$fprice=$_POST['fprice'];
$userid=$_SESSION['wsmsuid'];
//genrating order number
$orderno= mt_rand(100000000, 999999999);
$query="update tblcart set OrderNumber ='$orderno',IsOrderPlaced='1' where UserId='$userid' and IsOrderPlaced is null;";
$query.="insert into tblorderaddresses(UserId,Ordernumber,Total) values('$userid','$orderno','$grtotal');";
$result = mysqli_multi_query($con, $query);
if ($result) {
 $msg="Your order $orderno has been successfully placed.";
echo "<script>window.location.href='my-order.php'</script>";

}
}


    ?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Cart</title>

<link rel="stylesheet" type="text/css" href="styles/bootstrap-4.1.2/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="styles/contact.css">
<!--<script src="src/bootstrap-input-spinner.js"></script>
<script>
    $("input[type='number']").inputSpinner();
</script>-->
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
						<div class="home_title">Cart</div>
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
					
					</div>
				</div>
			</div>
			<div class="row">

 <div class="col-lg-12">
	
		<?php  
		$userid= $_SESSION['wsmsuid'];
 $query=mysqli_query($con,"select tblcart.OrderNumber, tblcart.ID,tblwaterbottle.Image,tblwaterbottle.CompanyName,tblwaterbottle.BottleSize,tblcart.Fprice,tblcart.Quantity,tblwaterbottle.Price,tblcart.BottleId from tblcart join tblwaterbottle on tblwaterbottle.ID=tblcart.BottleId where tblcart.UserId='$userid' and tblcart.IsOrderPlaced is null");
?>

<?php
$num=mysqli_num_rows($query);
if($num>0){
	$cnt=1;

?>
<div align="right">
	<a href="cart.php?delno=<?php echo $_SESSION['wsmsuid'];?>" onclick="return confirm('Do you really want to empty your cart?');" type="button" class="btn btn-outline-primary mb-4">Empty Cart</a></div>


<table border="1" class="table">
	<tr>
<!--<th>#</th>-->
<th>Product Image</th>	
<th>Type</th>	
<th>Size</th>
<th>Quantity</th>		
<th>Price</th>	
<th>Total</th>
<th>Action</th>
</tr>
<?php	
while ($row=mysqli_fetch_array($query)) {
	?>

<tr>
	<!--<td><?php echo $cnt;?></td>-->
<td><img class="b-goods-f__img img-scale" src="admin/images/<?php echo $row['Image'];?>" alt="<?php echo $row['Image'];?>" width='150' height='150'></td>
<td><?php echo $row['CompanyName'];?></td>	
<td><?php echo $row['BottleSize'];?>  </td>
<td><?php echo $row['Quantity'];?></td>	
<td>₱<?php echo $row['Fprice'];?>.00</td>
<td>₱<?php echo $total=$row['Fprice']* $row['Quantity'];?>.00</td>
<td><a href="cart.php?delid=<?php echo $row['ID'];?>" onclick="return confirm('Do you really want to Delete ?');"><i class="fa fa-trash fa-delete" aria-hidden="true"></i></a></td>		
</tr>
<?php $cnt++; 
$gtotal+=$total;
} ?>

<tr>
<th colspan="5" style="text-align:center;"></th>
<th colspan="2">₱<?php echo number_format($gtotal,2);?></th>
</tr>
</table>


<div class="row contact_form_row">
				<div class="col">
					<div class="contact_form_container">
						<form action="#" class="contact_form text-center" id="contact_form" method="post" name="">
						
						
			
							<input type="hidden" readonly name="gtotal" id="gtotal" value="<?php echo $gtotal;?>">
							<!--<input type="hidden" readonly name="fprice" id="fprice" value="<?php echo $total; ?>">-->
							<button class="contact_button btn" type="submit" name="submit">submit</button>
							
						</form>
					</div>
				</div>
			</div>
				</div>
		<?php } else {?>
<hr/>
<h3 align="center" style="padding: 30px">No products ordered.</h3>
<?php } ?>	</div>
			
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
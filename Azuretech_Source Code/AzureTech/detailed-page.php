<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(isset($_POST['submit']))
{
$bottleid=$_POST['bottleid'];
$quantity=$_POST['quantity'];
$fprice=$_POST['fprice'];
$userid= $_SESSION['wsmsuid'];
$query=mysqli_query($con,"insert into tblcart(UserId,BottleId,Quantity,Fprice) values('$userid','$bottleid','$quantity','$fprice') ");
if($query)
{
 
$msg="Product successfully added to cart.";
} else {
 echo "<script>alert('Something went wrong.');</script>";      
}
}


  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Products</title>

<link rel="stylesheet" type="text/css" href="styles/bootstrap-4.1.2/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.3.4/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.3.4/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.3.4/animate.css">
<link rel="stylesheet" type="text/css" href="styles/listings.css">

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
						<div style = "margin-top: 30px;" class="home_title">Products</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="listings">
		<div class="container">
			<p align="center" style="margin-bottom:10px; font-size:16px; color:#1c843c"><?php if($msg){
    echo $msg;
  }  ?> </p>
			<div class="row">
				<div class="col">
					

					<div class="featured">
		<div class="container">
			
			<div class="row featured_row" style="margin-bottom:20px;">
				<?php 
					 $query=mysqli_query($con,"select * from tblwaterbottle");
					 while ($row=mysqli_fetch_array($query)) {
 				?>
				<div class="col-lg-6">

					<div class="listing">

						<div class="listing_image">
							<div class="listing_image_container">
								<img class="b-goods-f__img img-scale" src="admin/images/<?php echo $row['Image'];?>" alt="<?php echo $row['Image'];?>" width='300' height='250'/>
							</div>
							
							<div class="mt-3 center tag_price listing_price"style="display:flex; flex-direction: row; justify-content: center; align-items: center" ><?php echo $row['CompanyName'];?> <?php echo $row['BottleSize'];?> at   ₱<?php echo $row['Price'];?>.00</div>
						</div>
						<div class="center">
							
								<?php if($_SESSION['wsmsuid']==""){?>\
									<div style="display:flex; flex-direction: row; justify-content: center; align-items: center">
									<a href="signin.php" class="btn btn-primary my-4 ">Add to Order</a></div>
									<?php } else {?>
									<form method="post"> 
									    <input type="hidden" name="bottleid" value="<?php echo $row['ID'];?>">  
									    <input type="hidden" name="fprice" value="<?php echo $row['Price'];?>">  
									    <div class="pt-4 pb-4" style="display:flex; flex-direction: row; justify-content: center; align-items: center">
									    <div class="pr-4"><button type="submit" name="submit" class="btn btn-primary my-4">Add to Order</button></div>

									    <h5 class="pr-4" for="quantity">QTY: </h5><input class="form-control" id="quantity" name="quantity" type="number" min="1" required value="1" size="2" style="width:5em;"></div>

											

									</form>
   <?php }?>
							
							
						</div>
					</div>
				</div>

				

				
<?php } ?>
			</div>
		</div>
	</div>
					
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
<script src="plugins/OwlCarousel2-2.3.4/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="js/listings.js"></script>
</body>
</html>
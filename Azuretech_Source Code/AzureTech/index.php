<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(isset($_POST['submit']))
{
$bottleid=$_POST['bottleid'];
$userid= $_SESSION['wsmsuid'];
$query=mysqli_query($con,"insert into tblcart(UserId,BottleId) values('$userid','$bottleid') ");
if($query)
{
 echo "<script>alert('Product has been added in to the cart');</script>";   
} else {
 echo "<script>alert('Something went wrong.');</script>";      
}
}


  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Home</title>

<link rel="stylesheet" type="text/css" href="styles/bootstrap-4.1.2/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.3.4/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.3.4/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.3.4/animate.css">
<link rel="stylesheet" type="text/css" href="styles/main_styles.css">

</head>
<body>
<div id="link_wrapper">

		</div>
<div class="super_container">
	
	<div class="super_overlay"></div>
	
	<?php include_once('includes/header.php');?>
	<div class="home">
		
		<!-- Home Slider -->
		<div class="home_slider_container">
			
				
			 	
			 	<!-- Slide 
			 	<div class="slide">
			 		<div class="background_image" style="background-image:url(images/wsms2.jpg)"></div>
			 		
			 	</div>-->

			 	<!-- Slide 
			 	<div class="slide">
			 		<div class="background_image" style="background-image:url(images/wsms2.jpg)"></div>
			 		
			 	</div>-->

			 	<!-- Background Pic -->
			 	<div class="slide">

			 		<div class="background_image" style="background-image:url(images/water.jpg)">
			 			<div class="center">
				 			<h2 class="menu_nav" style="color:white;">Water Refilling Station</h2>
				 			<a href="detailed-page.php" onMouseOut="this.style.backgroundColor ='#adc867'" onMouseOver="this.style.backgroundColor ='#007bff'" style ="background-color: #adc867; margin-top:50px; padding:10px; padding-left:30px;  padding-right:30px;" class="btn btn-primary">Order Now</a>
			 			</div>
			 		</div>
			 

			 </div>

			 
		</div>
	
	</div>

	
	<!-- Featured 

	<div class="featured">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title_container text-center">
						<div class="section_subtitle">the best deals</div>
						<div class="section_title"><h1>Water Bottle</h1></div>
					</div>
				</div>
			</div>
			<div class="row featured_row">
				<?php 
 $query=mysqli_query($con,"select * from tblwaterbottle order by rand() limit 6");
 while ($row=mysqli_fetch_array($query)) {


 ?>
				<div class="col-lg-4">

					<div class="listing">

						<div class="listing_image">
							<div class="listing_image_container">
								<img class="b-goods-f__img img-scale" src="admin/images/<?php echo $row['Image'];?>" alt="<?php echo $row['Image'];?>" width='300' height='250'/>
							</div>
							
							<div class="tag_price listing_price"><?php echo $row['CompanyName'];?> <?php echo $row['BottleSize'];?> at PHP <?php echo $row['Price'];?>.00</div>
						</div>
						<div class="listing_content">
							<div class="prop_location listing_location d-flex flex-row align-items-start justify-content-start">
								<?php if($_SESSION['wsmsuid']==""){?>
<a href="signin.php" class="btn btn-primary theme-btn-dash pull-right">Add to Cart</a>
<?php } else {?>
								<form method="post"> 
    <input type="hidden" name="bottleid" value="<?php echo $row['ID'];?>">   
<button type="submit" name="submit" class="btn btn-primary theme-btn-dash pull-right">Add to Cart</button>

  </form>
  <?php }?>
							</div>
							
						</div>
					</div>
				</div>

			

				
<?php } ?>
		
	</div>
		</div>
	





	</div>
-->


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

</body>
</html>

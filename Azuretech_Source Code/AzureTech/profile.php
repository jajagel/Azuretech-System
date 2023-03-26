<?php 
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['wsmsuid']==0)) {
  header('location:logout.php');
  } else{
if(isset($_POST['submit']))
  {
    $uid=$_SESSION['wsmsuid'];
    $fullname=$_POST['fullname'];
    $mobilenumber="+63".$_POST['mobilenumber'];
    $email=$_POST['email'];
    $address=$_POST['address'];
    $barangay=$_POST['barangay'];
    $city=$_POST['city'];
    $landmark=$_POST['landmark'];
   
   function getAddress($latitude, $longitude)
			{

			    $url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.$latitude.','.$longitude.'&key=AIzaSyCy5e4PTG0mVDPWmxnYJdGgh8PRxe8MxI4';
			    $jsons = @file_get_contents($url);
			    $data = json_decode($jsons,true);
			    $location = $data['results'][0]['formatted_address'];
			     return $location;
			  
			}
			$latitude=$_POST['lat'];
			$longitude=$_POST['lng'];
			$location=getAddress($latitude, $longitude);

    $query=mysqli_query($con, "update tbluser set FullName='$fullname', MobileNo='$mobilenumber', Email='$email', Address='$address', Landmark='$landmark', Location='$location', Latitude='$latitude', Longitude='$longitude' where ID='$uid'");


    if ($query) {
    $msg="Your profile has been updated";
  }
  else
    {
      $msg="Something Went Wrong. Please try again";
    }

}

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>Profile</title>

<link rel="stylesheet" type="text/css" href="styles/bootstrap-4.1.2/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="styles/contact.css">
</head>
<body>

<div class="super_container">
	<div class="super_overlay"></div>
	
	<?php include_once('includes/header.php');?>
	<!-- Home -->

	<div class="homee">
		<div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="images/water.jpg" data-speed="0.8"></div>
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="home_content text-center">
						<div class="home_title">Profile</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Contact -->
<div class="card mb-5 card-1 text-md-center mx-auto" style="width: 40rem;">
	<div class="contact">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title_container text-center">
						
						<!--<div class="section_subtitle">the best deals of water</div>
						<div class="section_title"><h2>Profile</h2></div>-->
					</div>
				</div>
			</div>
			
			<div class="row contact_form_row">
				<div class="col">
					<div class="contact_form_container">
						<form action="#" class="contact_form text-center" id="contact_form" method="post" name="signup">
							<p style="font-size:16px; color:#1c843c" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
   <?php
 $uid=$_SESSION['wsmsuid'];
$ret=mysqli_query($con,"select * from tbluser where ID='$uid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>  	
  						<div class="form-group row">
    					<label for="fullname" >Full Name</label>
									<input class="form-control" type="text" value="<?php  echo $row['FullName'];?>" id="fullname" name="fullname" required="true">
								</div>

			
							<div class="form-group row">
    					<label for="fullname" >Mobile Number</label>
									<input class="form-control" type="text" value="<?php  echo $row['MobileNo'];?>" id="mobilenumber" name="mobilenumber" required="true" maxlength="10" title="e.g. 9123456122" pattern="[9][0-9]+">
								</div>
					
						
							<div class="form-group row">
    					<label for="fullname" >Email</label>
									<input class="form-control" type="email" value="<?php  echo $row['Email'];?>" id="email" name="email">
								</div>
						

							<div class="form-group row">
    					<label for="fullname" >Address</label>
									<input class="form-control" type="text" value="<?php  echo $row['Address'];?>" id="address" name="address" required="true">
								</div>
								
								<div class="form-group row">
    					<label for="fullname" >Landmark</label>
									<input class="form-control" type="text" value="<?php  echo $row['Landmark'];?>" id="landmark" name="landmark" required="true">
								</div>					

							<div align="left"class="mapform" >
									<label for="fullname" >Location</label>
                <div class="form-group row">
                		
                    <div class="col-6">
                        <input type="text" class="form-control" value="<?php  echo $lat=$row['Latitude'];?>" name="lat" id="lat" required readonly>
                    </div>
                    <div class="col-6">
                        <input type="text" class="form-control" value="<?php  echo $lng=$row['Longitude'];?>" name="lng" id="lng" required readonly>
                    </div>
                   
                </div>

                <div id="map" style="height:400px; width: 100%;" class="my-3"></div>

             
            </div>

					<!--	<div class="form-group row">
    					<label for="fullname" >Barangay</label>
									<input class="form-control" type="text" value="<?php  echo $row['Barangay'];?>" id="barangay" name="barangay" required="true">
								</div>

						<div class="form-group row">
    					<label for="fullname" >City/Municipality</label>
									<input class="form-control" type="text" value="<?php  echo $row['City'];?>" id="city" name="city" required="true">
								</div>-->

						
								

<div class="row" style="margin-top:2%" align="left">
								<div class="col-lg-12" >
						<b>Profile Reg. Date : </b>  <?php  echo $row['RegDate'];?>
								</div>
							</div>

							<button class="contact_button" type="submit" name="submit">Update</button>
							<?php } ?> 
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

	
	<?php include_once('includes/footer.php');?>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="styles/bootstrap-4.1.2/popper.js"></script>
<script src="styles/bootstrap-4.1.2/bootstrap.min.js"></script>
<script src="plugins/greensock/TweenMax.min.js"></script>
<script src="plugins/greensock/TimelineMax.min.js"></script>
<script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="plugins/greensock/animation.gsap.min.js"></script>
<script src="plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>

<script>
                    let map;

                    function initMap() {
                        map = new google.maps.Map(document.getElementById("map"), {
                            center: { lat: <?php Print($lat); ?>, lng: <?php Print($lng); ?> }, 
                            zoom: 8,
                            scrollwheel: true,
                        });
                        const uluru = { lat: <?php Print($lat); ?>, lng: <?php Print($lng); ?> };
                        let marker = new google.maps.Marker({
                            position: uluru,
                            map: map,
                            draggable: true
                        });
                        google.maps.event.addListener(marker,'position_changed',
                            function (){
                                let lat = marker.position.lat()
                                let lng = marker.position.lng()
                         
                                $('#lat').val(lat)
                                $('#lng').val(lng)

                            })
                        google.maps.event.addListener(map,'click',
                        function (event){
                            pos = event.latLng
                            marker.setPosition(pos)
                        })
                        map.setZoom(15);
                    }

                </script>
                <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCy5e4PTG0mVDPWmxnYJdGgh8PRxe8MxI4&callback=initMap"
                        type="text/javascript"></script>
</body>
</html>
<?php  } ?>
<?php 
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(isset($_POST['btn2']))
  {
    $fname=$_POST['fullname'];
    $mobno="+63".$_POST['mobilenumber'];
    $email=$_POST['email'];
    $address=$_POST['address'];
    $barangay=$_POST['barangay'];
    $city=$_POST['city'];
    $landmark=$_POST['landmark'];
    $password=md5($_POST['password']);

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


    $ret=mysqli_query($con, "select Email from tbluser where Email='$email' || MobileNo='$mobno'");
    $result=mysqli_fetch_array($ret);
    if($result>0){
$msg="This email or contact number is already associated with another account";
    }
    else{
    $query=mysqli_query($con, "insert into tbluser(FullName, MobileNo, Email, Address, Location, Latitude, Longitude, Landmark, Password) value('$fname', '$mobno', '$email', '$address', '$location', '$latitude', '$longitude','$landmark', '$password')");
    if ($query) {
    $msg="You have successfully registered";
  }
  else
    {
      $msg="Something Went Wrong. Please try again";
    }
}
}




 ?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Sign Up</title>

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
						<div class="home_title">Sign Up</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Contact -->
<div class="card mb-5 card-1 text-md-center mx-auto" style="width: 45rem;">
	<div class="contact">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title_container text-center">
						<!--<div class="section_subtitle">the best deals of water</div>
						<div class="section_title"><h2>Sign Up</h2></div>-->
					</div>
				</div>
			</div>
			<div class="row contact_row">

				<!-- Contact - About -->
				

				<!-- Contact - Image 
				<div class="col-lg-4 contact_col">
					<div class="contact_image d-flex flex-column align-items-center justify-content-center">
						<img src="images/signup.png" alt="">
					</div>
				</div>-->

			</div>
			<div class="row contact_form_row">
				<div class="col">
					<div class="contact_form_container">
						<form action="#" class="contact_form text-center" id="contact_form" method="post" name="signup">
							<p class="mb-2" style="font-size:16px; color:#408140" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
							<div class="row">
								<div class="col-lg-12">
									<input type="text" class="form-control" placeholder="Full Name" id="fullname"name="fullname" required="true" st>
								</div>
					
							</div>
							<div class="row" style="margin-top:2%">
								<div class="col-lg-12">
									<input type="email" class="form-control"  placeholder="Email" id="email" name="email" required="true">
								</div>
					
							</div>
							<div class="row" style="margin-top:2%">
								<div class="col-lg-2">
									 <input readonly type="text" class="form-control"  value="+63">
								</div>
								<div class="col-lg-10">
									 <input type="text" class="form-control"  placeholder="Contact Number" id="mobilenumber" name="mobilenumber" required="true" maxlength="10" title="e.g. 9123456122" pattern="[9][0-9]+">
								</div>
					
							</div>
							<div class="row" style="margin-top:2%">
								<div class="col-lg-12">
									<input class="form-control" placeholder="Address Details" type="text" id="address" name="address" required="true">
								</div>
							</div>
							<div class="row" style="margin-top:2%">
								<div class="col-lg-12">
									<input class="form-control" placeholder="Landmark" type="text" id="landmark" name="landmark" required="true">
								</div>
							</div>

							<div class="row" align="center" style="margin-top:2%">
							
						
							<div class="mapform col-lg-12" >
                <div class="row">
                	<div class="col-lg-2">
									 <a style="font-size: 12pt;">Location</a>
								</div>
                    <div class="col-5">
                        <input type="text" class="form-control" placeholder="lat" name="lat" id="lat" required readonly>
                    </div>
                    <div class="col-5">
                        <input type="text" class="form-control" placeholder="lng" name="lng" id="lng" required readonly>
                    </div>
                   
                </div>

                <div id="map" style="height:400px; width: 100%;" class="my-3"></div>

             
            </div>
						
					
							</div>
							
								


							

						<!--<div class="row" style="margin-top:2%">
								<div class="col-lg-12">
									<input class="form-control" placeholder="Barangay" type="text" id="barangay" name="barangay" required="true">
								</div>
							</div>

						<div class="row" style="margin-top:2%">
								<div class="col-lg-12">
									<input class="form-control" placeholder="City/Municipality" type="text" id="city" name="city" required="true">
								</div>
							</div>

						-->

						<div class="row" style="margin-top:2%">
								<div class="col-lg-12">
									<input type="password" class="form-control"  placeholder="Password" required="true" id="password" name="password">
								</div>
					
							</div>	

							
							<button class="contact_button btn btn-primary" form="contact_form" type="submit" name="btn2">Submit</button>
							<div class="row m-t-50">
                                <div class="col-sm-12 text-center">
                                    <p class="text-muted mt-2">Already have an account?  <a href="signin.php" class="text-dark m-l-5"><b>Sign In</b></a></p>
                                </div>
                            </div>
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

   <script>
                    let map;
                    function initMap() {
                        map = new google.maps.Map(document.getElementById("map"), {
                            center: { lat: 16.4171526, lng: 120.593238 }, 
                            zoom: 8,
                            scrollwheel: true,
                        });
                        const uluru = { lat: 16.4171526, lng: 120.593238 };
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
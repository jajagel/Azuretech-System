<footer class="footer">
		<div class="footer_content">
			<div class="container">
				<div class="row">
					
					<!-- Footer Column -->
					<div class="col-xl-3 col-lg-6 footer_col">
						<div class="footer_about">
							<div class="footer_title"><!--<a href="index.php">--><span>Operating Hours</span></div>
							<div class="footer_text">
								<?php 
 $query=mysqli_query($con,"select * from  tblpage where PageType='aboutus'");
 while ($row=mysqli_fetch_array($query)) {


 ?>
						<p style="color: white"><?php  echo $row['PageDescription'];?></p>
						<?php } ?>
							</div>
							
							
						</div>
					</div>

					<!-- Footer Column -->
					<div class="col-xl-3 col-lg-6 footer_col">
						<div class="footer_column">
							<div class="footer_title">Contact Information</div>
							<div class="footer_info">
								<?php 
 $query=mysqli_query($con,"select * from  tblpage where PageType='contactus'");
 while ($row=mysqli_fetch_array($query)) {


 ?>
								<ul>
									<!-- Phone -->
									<li class="d-flex flex-row align-items-center justify-content-start">
										<div><img src="images/phone-call.svg" alt=""></div>
										<span><?php  echo $row['MobileNumber'];?></span>
									</li>
									
									
									<!-- Email -->
									<li class="d-flex flex-row align-items-center justify-content-start">
										<div><img src="images/envelope.svg" alt=""></div>
										<span><?php  echo $row['Email'];?></span>
									</li>
								</ul>
								<?php } ?>
							</div>
							<!--<div class="footer_links usefull_links">
								<div class="footer_title">Usefull Links</div>
								<ul>
									<li><a href="about.php">About Us</a></li>
									<li><a href="contact.php">Contact Us</a></li>
									<li><a href="detailed-page.php">Water Bottle Detailed</a></li>
									
								</ul>
							</div>
						</div>
					</div>-->


					<!-- Footer Column -->
					<div class="col-xl-3 col-lg-6 footer_col">
						
						<div class="listing_small"><?php 
 $query=mysqli_query($con,"select * from tblwaterbottle order by rand() limit 1");
 while ($row=mysqli_fetch_array($query)) {


 ?>
							
							</div>
							
						</div>
					</div>
<?php } ?>
				</div>
			</div>
		</div>
		
	</footer>
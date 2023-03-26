<header class="header">
    
    <!-- Header Bar -->
    <div class="header_bar d-flex flex-row align-items-center justify-content-start">
      <div class="header_list">
        <?php 
 $userid= $_SESSION['wsmsuid'];
 $ret=mysqli_query($con,"select sum(Quantity) as qty from  tblcart where UserId='$userid' and IsOrderPlaced is null");
 $row=mysqli_fetch_assoc($ret);
 $count=$row['qty'];
 $query=mysqli_query($con,"select * from  tblpage where PageType='contactus'");
  
 while ($row=mysqli_fetch_array($query)) {


 ?>
        <ul class="d-flex flex-row align-items-center justify-content-start">
          <!-- Phone -->
          <li class="d-flex flex-row align-items-center justify-content-start">
            <div><img src="images/phone-call.svg" alt=""></div>
            <span><?php echo $row['MobileNumber'];?></span>
          </li>
          <!-- Address -->
          <li class="d-flex flex-row align-items-center justify-content-start">
            <div><img src="images/placeholder.svg" alt=""></div>
            <span><?php  echo $row['PageDescription'];?></span>
          </li>
          <!-- Email -->
          <li class="d-flex flex-row align-items-center justify-content-start">
            <div><img src="images/envelope.svg" alt=""></div>
            <span><?php  echo $row['Email'];?></span>
          </li>
        </ul>
        <?php } ?>

      </div>
     
    </div>

    <!-- Header Content -->
    <div class="header_content d-flex flex-row align-items-center justify-content-start">
      <div class="logo"><a href="index.php"><span style="color: black; font-size: 20px;">AzureTech</span></a></div>
      <nav class="main_nav">
        <ul class="d-flex flex-row align-items-start justify-content-start">
          <li><a href="index.php">Home</a></li>
          <!--<li><a href="about.php">About us</a></li>-->
          <li><a href="detailed-page.php">Products</a></li>
          
          
          <li><a href="cart.php">My Cart<span class="badge" style="margin-left:7px; color:black; background-color: #edeff0;"><?php echo $count;?></span></a></li>
           <li><a href="my-order.php">All Orders</a></li>
         
           <!--<li><a href="contact.php">Contact</a></li> -->
        
          
        </ul>
      </nav>
       <div class="ml-auto d-flex flex-row align-items-center justify-content-start">
       <ul class="d-flex flex-row align-items-start justify-content-start">
           
          </ul>
        <div class="log_reg d-flex flex-row align-items-center justify-content-start mr-3">
           
          <ul class="d-flex flex-row align-items-start justify-content-start">
           <?php if (strlen($_SESSION['wsmsuid']==0)) {?>

            <li><a href="signin.php" class="underline btn mr-1">Login</a></li>
            <li><a href="signup.php" class="underline btn ml-1">Sign Up</a></li>
           <?php }else{ ?>
          </ul>
          
        </div>
      </div>
      
        <div class="dropdown mr-3">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown">
          My Account
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item dark" href="profile.php">Profile</a>
          <a class="dropdown-item dark" href="change-password.php">Change Password</a>
          <a class="dropdown-item dark" href="logout.php">Logout</a>
        </div>
      </div>

     
            <!--<div class="submit ml-auto btn btn-primary dropdown-toggle" style="padding: 16px;" type="button" data-toggle="dropdown"> My Account</div>
    <ul class="dropdown-menu" style="text-align: center;">
    <li><a href="profile.php">My Profile</a></li>
     
    <li><a href="cart.php">My Cart</a></li>
    <li><a href="my-order.php">All Orders</a></li>
    
    <li><a href="change-password.php">Change Password</a></li>
    <li><a href="logout.php">Logout</a></li>
  </ul>-->
           <?php } ?>
      
    </div>




  </header>

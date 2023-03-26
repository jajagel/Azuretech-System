<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['wsmsaid']==0)) {
  header('location:logout.php');
  } 
     ?>
<div class="header-main">
          <div class="logo-w3-agile">
                <h1><a href="dashboard.php"><span style="color: white; font-size: 1.7vw;">AzureTech</span></a></h1>
              </div>
              <div class="profile_details w3l">   
                <ul>
                  <li class="dropdown profile_details_drop">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                      <div class="profile_img"> 
                        <span class="prfil-img"><img src="images/prof.png" height="150" width="100" alt=""> </span> 
                        <div class="user-name">
                           <?php
                              $aid=$_SESSION['wsmsaid'];
                              $ret=mysqli_query($con,"select AdminName from tbladmin where ID='$aid'");
                              $row=mysqli_fetch_array($ret);
                              $name=$row['AdminName'];
                              ?>
                          <p><?php echo $name; ?></p>
                          <span>Administrator</span>
                        </div>
                        <i class="fa fa-angle-down"></i>
                        <i class="fa fa-angle-up"></i>
                        <div class="clearfix"></div>  
                      </div>  
                    </a>
                    <ul class="dropdown-menu drp-mnu">
                      <li> <a href="admin-profile.php"><i class="fa fa-user"></i> Profile</a> </li> 
                      <li> <a href="change-password.php"><i class="fa fa-cog"></i> Password</a> </li> 
                      <li> <a href="index.php"><i class="fa fa-sign-out"></i> Logout</a> </li>
                    </ul>
                  </li>
                </ul>
              </div>
              
             <div class="clearfix"> </div>  
        </div>

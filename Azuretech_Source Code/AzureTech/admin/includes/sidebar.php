<div class="sidebar-menu">
          <header class="logo1">
            <a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> 
          </header>
            <div style="border-top:1px ridge rgba(255, 255, 255, 0.15)"></div>
                           <div class="menu">
                  <ul id="menu" >
                    <li><a href="dashboard.php"><i class="fa fa-tachometer"></i> <span>Dashboard</span><div class="clearfix"></div></a></li>

                    <li><a href="manage-watertype.php"><i class="fa fa-cogs" aria-hidden="true"></i> <span>Water Type</span><div class="clearfix"></div></a></li>

                    <li><a href="manage-size.php"><i class="fa fa-cogs" aria-hidden="true"></i> <span>Bottle Size</span><div class="clearfix"></div></a></li>

                    <li><a href="manage-bottle.php"><i class="fa fa-list-ul" aria-hidden="true"></i> <span>Products</span><div class="clearfix"></div></a></li>
                  

                  
                  
                  
                  
                  <li><a href="#"><i class="fa fa-check-square-o nav_icon"></i><span>Orders</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
                    <ul>
                    <?php $query1=mysqli_query($con,"Select * from tblorderaddresses where OrderFinalStatus is null");
                    $neworder=mysqli_num_rows($query1);?>
                    <li><a href="new-order.php">New (<?php echo $neworder;?>)</a></li>

                    <?php $query2=mysqli_query($con,"Select * from tblorderaddresses where OrderFinalStatus='Order Accept'");
                    $accept=mysqli_num_rows($query2);?>
                    <li><a href="accept-order.php">Accepted (<?php echo $accept;?>)</a></li>

                    <?php $query3=mysqli_query($con,"Select * from tblorderaddresses where OrderFinalStatus='Order On its Way'");
                    $otw=mysqli_num_rows($query3);?>
                   <li><a href="order-onthway.php">Out for Delivery (<?php echo $otw;?>)</a></li>

                   <?php $query4=mysqli_query($con,"Select * from tblorderaddresses where OrderFinalStatus='Bottle Delivered'");
                    $del=mysqli_num_rows($query4);?>
                    <li><a href="order-delivered.php">Delivered (<?php echo $del;?>)</a></li>

                    <?php $query5=mysqli_query($con,"Select * from tblorderaddresses where OrderFinalStatus = 'Order Cancelled'");
                    $cancel=mysqli_num_rows($query5);?>
                     <li><a href="order-cancelled.php">Cancelled (<?php echo $cancel;?>)</a></li>

                     <?php $query6=mysqli_query($con,"Select * from tblorderaddresses");
                    $allorder=mysqli_num_rows($query6);?>
                     <li><a href="all-orders.php">All Orders (<?php echo $allorder;?>)</a></li>
                  </ul>
                  </li>
                  
                  <li id="menu-academico" ><a href="inventory.php"><i class="fa fa-list-ul" aria-hidden="true"></i><span>Inventory</span></a></li>


                  <li><a href="manage-users.php"><i class="fa fa-users"></i> <span>Customers</span><div class="clearfix"></div></a></li>

                 <li><a href="#"><i class="fa fa-newspaper-o"></i><span>Reports</span> <span class="fa fa-angle-right" style="float: right"><div class="clearfix"></div></a>
                    <ul>
                    <li><a href="order-reports.php"> Order Reports</a></li>
                    <!--<li><a href="requestcount-reports-ds.php">Order Count</a></li>-->
                    <li><a href="sales-reports.php">Sales Reports</a></li>

                  </ul>
                  </li>

                   <!--<li><a href="#"><i class="fa fa-newspaper-o"></i><span>Latest News/Updates</span> <span class="fa fa-angle-right" style="float: right"><div class="clearfix"></div></a>
                    <ul>
                    <li><a href="add-latestnews.php"> Add</a></li>
                    <li><a href="manage-latestnews.php">Manage</a></li>
                  </ul>
                  </li>-->

                    <!--<li id="menu-academico" ><a href="#"><i class="fa fa-file-text-o"></i>  <span>Pages</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
                     <ul id="menu-academico-sub" >
                      <li id="menu-academico-boletim" ><a href="aboutus.php">About Us</a></li>
                      <li id="menu-academico-avaliacoes" ><a href="contactus.php">Contact Us</a></li>
                    
                      </ul>
                   </li>-->


                  </ul>
                </div>
                </div>
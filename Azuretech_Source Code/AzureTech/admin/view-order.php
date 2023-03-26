<?php
require __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['wsmsaid']==0)) {
   header('location:logout.php');
  } else{

if(isset($_POST['submit']))
  {
    
    $oid=$_GET['orderid'];
    $bcsta=$_POST['status'];
    $mobile=$_POST['mobile'];
    $fname=$_POST['fname'];
    $gtotal=$_POST['gtotal'];
   //$stock=$_POST['stock'];
    //$size=$_POST['size'];
    $remark=$_POST['remark'];
    
 
    
    $query=mysqli_query($con,"insert into tbltracking(OrderId,remark,status) value('$oid','$remark','$bcsta')");
      
   $query=mysqli_query($con, "update tblorderaddresses set OrderFinalStatus='$bcsta' where Ordernumber='$oid'");
    if ($query) {
    $msg="Order Has been updated";
  }
  else
    {
      $msg="Something Went Wrong. Please try again";
    }

if($bcsta=='Order On its Way'){

$account_sid = 'AC0c4538f8b406027b11e6e8414cb0eae4';
$auth_token = '0c42b0ee6e0dcc477f50a28c33d58dbf';

$twilio_number = "+15672352478";

try{
$client = new Client($account_sid, $auth_token);
$client->messages->create(
    "$mobile",
    array(
        'from' => $twilio_number,
        'body' => "$fname your water refill order $oid is out for delivery. Please prepare cash payment of PHP$gtotal."
    )
);
}catch(Exception $e){
  
}

}
  
}
  

  ?>

<!DOCTYPE HTML>
<html>
<head>
<title>View Order Details</title>

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/morris.css" type="text/css"/>
<!-- Graph CSS -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<script src="js/jquery-2.1.4.min.js"></script>
<!-- //jQuery -->
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<!-- lined-icons -->
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
<!-- //lined-icons -->
</head> 
<body>
   <div class="page-container">
   <!--/content-inner-->
<div class="left-content">
     <div class="mother-grid-inner">
              <!--header start here-->
        <?php include_once('includes/header.php');
         $id = $_GET['orderid'];
          $query=mysqli_query($con, "select * from tblorderaddresses where Ordernumber ='$id'");
          while($row=mysqli_fetch_array($query)){
            if($row['OrderFinalStatus']=="Order Accept"){
              $stats="accept-order.php";
              $text="Accepted Orders";
            }elseif ($row['OrderFinalStatus']=="Order On its Way") {
              $stats="order-onthway.php";
              $text="Out for Delivery Orders";
            }elseif ($row['OrderFinalStatus']=="Bottle Delivered") {
              $stats="order-delivered.php";
              $text="Delivered Orders";
            }elseif ($row['OrderFinalStatus']=="Order Cancelled") {
              $stats="order-cancelled.php";
              $text="Cancelled Orders";
            }else{
              $stats="new-order.php";
              $text="New Orders";
            }
          }
         
        ?>
<!--heder end here-->
  <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="dashboard.php">Home</a><i class="fa fa-angle-right"></i> <a href="<?php echo $stats?>"><?php echo $text?></a><i class="fa fa-angle-right"></i>Order Details
                </li>
            </ol>
    <!--grid-->
  <div class="grid-form">
 


  <div class="grid-form1">
          <h3>Order #<?php echo $_GET['orderid'];?></h3>
             <div class="tab-content">
            <div class="tab-pane active" id="horizontal-form">
                                         <?php
 $oid=$_GET['orderid'];
$ret=mysqli_query($con,"select * from tblorderaddresses join tbluser on tbluser.ID=tblorderaddresses.UserId where tblorderaddresses.Ordernumber='$oid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
<div class="row">
  <div class="col-12">
     <p style="font-size:16px; color:#408140; text-align: center"><?php if($msg){
    echo $msg;
  }  ?> </p>
<table border="1" class="table table-bordered mg-b-0 center" style="width: 50em;">
 <tr align="center">
<td colspan="2" style="font-size:20px;color:#1b93e1">
 Customer Details</td></tr>

    <!--<tr>
   <th>Order Number</th>
    <td><?php  echo $row['Ordernumber'];?></td>
  </tr>-->
  <tr>
    <th>Full Name</th>
    <td><?php  echo $fname=$row['FullName'];?></td>
  </tr>
 
  <!--<tr>
    <th>Email</th>
    <td><?php  echo $row['Email'];?></td>
  </tr>
  <tr>-->

  <th>Mobile Number</th>
    <td><?php  echo $mobile=$row['MobileNo'];?></td>
  </tr>
  <!--<tr>
    <th>Flat no./buldng no.</th>
    <td><?php  echo $row['Flatnobuldngno'];?></td>
  </tr>
  <tr>-->
    <tr>
    <th>Address</th>
    <td><?php  echo $row['Address'];?></td>
  </tr>
    <tr>
      <th class="col-sm-2 control-label">Location </th>
      <td style="padding-left: 10px">
        <div id="mapp" style="height:300px; width: 100%;" class="my-3"></div>

      </td>
    </tr>
  <tr>
    <th>Landmark</th>
    <td><?php  echo $row['Landmark'];
  $lat=$row['Latitude'];
 $lng=$row['Longitude'];?></td>
  </tr>

  <!--<tr>
    <th>City</th>
    <td><?php  echo $row['City'];?></td>
  </tr>
  <tr>
    <th>Order Date</th>
    <td><?php  echo $row['OrderTime'];?></td>
  </tr>
  <tr>
    <th>Order Final Status</th>
    <td> <?php  
    $orserstatus=$row['OrderFinalStatus'];
if($row['OrderFinalStatus']=="Order Accept")
{
  echo "Order Accepted";
}

if($row['OrderFinalStatus']=="Order On its Way")
{
  echo "Order On its Way";
}

if($row['OrderFinalStatus']=="Bottle Delivered")
{
  echo "Order Delivered";
}
if($row['OrderFinalStatus']=="")
{
  echo "Wait for approval";
}
if($row['OrderFinalStatus']=="Order Cancelled")
{
  echo "Order Cancelled";
}


     ;?></td>
  </tr>-->
</table>
                  </div>
                  <div class="col-12" style="margin-top:3%">
  <?php  
$query=mysqli_query($con,"select  tblwaterbottle.Image,tblwaterbottle.CompanyName,tblcart.Fprice, tblcart.Quantity, tblwaterbottle.BottleSize,tblwaterbottle.Price, tblcart.BottleId from tblcart join tblwaterbottle on tblwaterbottle.ID=tblcart.BottleId where tblcart.IsOrderPlaced=1 and tblcart.OrderNumber='$oid'");
$num=mysqli_num_rows($query);
$cnt=1;?>
<table border="1" class="table table-bordered mg-b-0 center" style="width: 50em;">
 <tr align="center">
<td colspan="7" style="font-size:20px;color:#1b93e1">
 Order  Details</td></tr> 

 <tr>
 <th></th>
<th>Image </th>
<th>Type</th>
<th>Size</th>
<th>Quantity</th>
<th>Price</th>
<th>Total</th>
</tr>
<?php  
while ($row1=mysqli_fetch_array($query)) {
  ?>
<tr>
  <td><?php echo $cnt;?></td>
 <td><img src="images/<?php echo $row1['Image']?>" width="60" height="40" alt=""></td> 
  <td><?php  echo $row1['CompanyName'];?></td> 
  <td><?php  echo $row1['BottleSize'];?></td>
  <td><?php echo $row1['Quantity'];?></td>
  <td>₱<?php  echo $total=$row1['Fprice'];?>.00</td> 
   <td>₱<?php  echo $total=$row1['Fprice']*$row1['Quantity'];?>.00</td> 
</tr>
<?php 
$gtotal=$row['Total'];
$cnt=$cnt+1;} ?>
<tr>
  <th colspan="6" style="text-align:center"> </th>
<th>₱<?php  echo number_format($row['Total'],2);?></th>
</tr> 


</table>  
                </div>
                
            
            </div>
<table class="table mb-0 center " style="width: 50em; margin-top: 2em;">

<?php

  if($orserstatus=="Order Accept" || $orserstatus=="Order On its Way" ||  $orserstatus=="" ){ ?>

<?php 
if(isset($_POST["submit"])){
if($orserstatus=="Order Accept"){
$array=array();
$query=mysqli_query($con,"select * from tblcart join tblwaterbottle on tblcart.BottleId = tblwaterbottle.ID join tblsize on tblwaterbottle.BottleSize = tblsize.SizeName where tblcart.OrderNumber='$oid';");
while ($row=mysqli_fetch_array($query)) { 
  $stock=$row['Quantity'];
  $size=$row['BottleSize'];
  $array[]=array($stock,$size);
}  


      if(is_array($array))  
      {  
        $del = "DELETE FROM tblstock";  
                mysqli_query($con, $del);  
           foreach($array as $row => $value)  
           {  
                $qty = mysqli_real_escape_string($con, $value[0]);  
                $size = mysqli_real_escape_string($con, $value[1]);   
                $sql = "INSERT INTO tblstock(Quantity,SizeName) VALUES ('".$qty."', '".$size."')";  
                mysqli_query($con, $sql);  
           }
           $query=mysqli_query($con,"select sum(Quantity) as stockout, SizeName as size from tblstock group by SizeName");

           /*$query = mysqli_query($con,"update tblsize set StockOut='$stockout' where SizeName='$sizename'");*/
           while($row1=mysqli_fetch_array($query)){
            $stockout=$row1['stockout'];
            $sizename=$row1['size'];
            
           

            $array1[]=array($sizename,$stockout);
            
           }
      }  

      if(is_array($array1)){
       foreach($array1 as $roww => $valuee)  
           {  


                $sizee = mysqli_real_escape_string($con, $valuee[0]);  
               $result=mysqli_query($con,"SELECT * from tblsize where SizeName = '".$sizee."'");
               $data=mysqli_fetch_assoc($result);
                $stockk = mysqli_real_escape_string($con, $valuee[1])+$data['StockOut'];

                 
              mysqli_query($con, "UPDATE tblsize set StockOut='".$stockk."' where SizeName='".$sizee."'"); 
                   
             
           }
         }


 ;

}
}
?>

<form name="submit" method="post"> 
<!--<tr>
    <th>Remark :</th>
    <td>
    <textarea name="remark" placeholder="" rows="12" cols="14" class="form-control wd-450" required="true"></textarea></td>
  </tr>-->
 
  <input type="hidden" name="fname" value="<?php echo $fname;?>">
  <input type="hidden" name="mobile" value="<?php echo $mobile;?>">
  <input type="hidden" name="gtotal" value="<?php echo $gtotal;?>">
  <tr>
    <th>Status :</th>
    <td>
   <select name="status" class="form-control wd-450 center" required="true" >
     <option value="Order Accept" selected="true">Order Accept</option>
          
     <option value="Order On its Way">Order On its Way</option>
     
     <option value="Bottle Delivered">Bottle Delivered</option>
     <option value="Order Cancelled">Order Cancelled</option>
   </select></td>
  </tr>
    <tr align="center">
    <td colspan="2"><button type="submit" name="submit" class="btn btn-primary">Update order</button></td>
  </tr>
</form>
  <?php } ?>
 


</table>
<?php } ?>
<?php  if($orserstatus!=""){
$ret=mysqli_query($con,"select tbltracking.OrderCanclledByUser,tbltracking.remark,tbltracking.status as fstatus,tbltracking.StatusDate from tbltracking where tbltracking.OrderId ='$oid'");
$cnt=1;

 echo $cancelledby=$row['OrderCanclledByUser'];
 ?>
<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
  <tr align="center">
   <th colspan="4" >Tracking History</th> 
  </tr>
  <tr>
    <!--<th>#</th>-->
<!--<th>Remark</th>-->
<th>Status</th>
<th>Time</th>
</tr>
<?php  
while ($row=mysqli_fetch_array($ret)) { 
  ?>
<tr>
  <!--<td><?php echo $cnt;?></td>-->
 <!--<td><?php  echo $row['remark'];?></td> -->
  <td><?php  echo $row['fstatus'];
/*if($cancelledby=='1' &&  $row['fstatus']=='Order Cancelled')
{
echo "("."by user".")";
} 
if($cancelledby=="" and  $row['fstatus']=='Order Cancelled')
{

echo "("."by Company".")";
}
*/
  ?></td> 
   <td><?php  echo $row['StatusDate'];?></td> 
</tr>
<?php $cnt=$cnt+1;} ?>
</table>



<?php  }  
?>

          </div>

      <div class="panel-footer">
    
   </div>
    
  </div>
  </div>
  <!--//grid-->
<script>
                    let map;

                    function initMap() {
                        map = new google.maps.Map(document.getElementById("mapp"), {
                            center: { lat: <?php Print($lat); ?>, lng: <?php Print($lng); ?> }, 
                            zoom: 8,
                            scrollwheel: true,
                        });
                        const uluru = { lat: <?php Print($lat); ?>, lng: <?php Print($lng); ?> };
                        let marker = new google.maps.Marker({
                            position: uluru,
                            map: map,
                            draggable: false
                        });
                       
                        map.setZoom(15);
                    }

                </script>
                <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCy5e4PTG0mVDPWmxnYJdGgh8PRxe8MxI4&callback=initMap"
                        type="text/javascript"></script>
<!-- script-for sticky-nav -->
    <script>
    $(document).ready(function() {
       var navoffeset=$(".header-main").offset().top;
       $(window).scroll(function(){
        var scrollpos=$(window).scrollTop(); 
        if(scrollpos >=navoffeset){
          $(".header-main").addClass("fixed");
        }else{
          $(".header-main").removeClass("fixed");
        }
       });
       
    });
    </script>
    <!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block">

</div>
<!--inner block end here-->
<?php include_once('includes/footer.php');?>
</div>
</div>
 <?php include_once('includes/sidebar.php');?>
                <div class="clearfix"></div>    
              </div>
              <script>
              var toggle = true;
                    
              $(".sidebar-icon").click(function() {                
                if (toggle)
                {
                $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
                $("#menu span").css({"position":"absolute"});
                }
                else
                {
                $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
                setTimeout(function() {
                  $("#menu span").css({"position":"relative"});
                }, 400);
                }
                      
                      toggle = !toggle;
                    });
              </script>
<!--js -->

<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.min.js"></script>
   <!-- /Bootstrap Core JavaScript -->     

</body>
</html>
<?php } ?>
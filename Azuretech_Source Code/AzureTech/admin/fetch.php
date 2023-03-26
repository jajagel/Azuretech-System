<?php
//fetch.php;
include('includes/dbconnection.php');
$query=mysqli_query($con,"select * from `tblorderaddresses` where SeenStatus='0' order by Ordernumber desc");
$output = '';
while($row=mysqli_fetch_array($query)){
$output .= '
	<div class="alert alert_default">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<p><strong>You have a new order! </strong> Order #'.$row['Ordernumber'].'</p> <a style="text-decoration: underline;"href="view-order.php?orderid='.$row['Ordernumber'].'">View Order<a/>
	</div>
	';
}

mysqli_query($con,"update `tblorderaddresses` set SeenStatus='1' where SeenStatus='0'");
echo $output;

?>
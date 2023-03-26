<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['submit']))
  {
   	$inputQty=$_POST['qty'];
	
	$name=$_POST['name'];
	$query=mysqli_query($con,"select * from tblsize where SizeName='$name'");
	$row=mysqli_fetch_array($query);
	$newQty=$row['StockOut']-$inputQty;
	echo $newQty;

	$sql = "update tblsize set StockOut ='$newQty' where SizeName='$name'";
	$result=mysqli_query($con,$sql);

	if($result){
		header('location:inventory.php');
	}else{
		die(mysqli_error($con));
	}
  }

 	$text=$_POST['text'];
	$query=mysqli_query($con,"select * from tblsize where SizeName='$text'");
	
	while ($row=mysqli_fetch_array($query)) { 
	
?>

		<form method="POST" class="form-horizontal">
		
		<div class=form-group>
		<label for="smallinput" class="col-sm-2 control-label label-input-sm">Size Name</label>
		<input type="text" name="name" id="name" class="form-control" style="width:30em;" value="<?php  echo $row['SizeName'];?>" required='true'>
		</div>

		<div class=form-group>
		<label for="smallinput" class="col-sm-2 control-label label-input-sm">Size ID</label>
		<input type="number" name="id" id="id" class="form-control" style="width:30em;" value="<?php  echo $row['ID'];?>" required='true'>
		</div>

		<div class=form-group>
		<label for="smallinput" class="col-sm-2 control-label label-input-sm"> Qty of Bottles Returned</label>
			<input type="number" name="qty" id="qty" class="form-control" style="width:30em;" placeholder="Enter Quantity" required='true'>
		</div>
							
<?php } ?>

		<button class="btn-primary btn" type="submit" name="submit">Update</button>
	</form>	


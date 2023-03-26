<?php
	session_start();
	include_once('includes/dbconnection.php');
 
	if(isset($_POST['submit'])){
		
		try{
			$id = $_GET['id'];
			$stockin = $_POST['in'];
			$stockout = $_POST['out'];
 
			$sql = "UPDATE tblsize SET Stock = '".$stockin."', StockOut = '".$stockout."' WHERE ID = '".$id."'";

			//if-else statement in executing our query
			mysqli_query($con,$sql); 
		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}
 
		
	}
	else{
		$_SESSION['message'] = 'Fill up edit form first';
	}
 
	header('location: inventory.php');
 
?>


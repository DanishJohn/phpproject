<?php 
	require_once '../database/databaseConnect.php';
	require_once '../Constants/constants.php';

	session_start();
 	$conn = DatabaseConnect::connect();
 	$showProduct = "";
    if($conn != null){
        $getProduct = DatabaseConnect::getResult("select * from customer where customer_username like '".$_POST['username']."' and customer_password like '".$_POST['password']."'", $conn); 
        DatabaseConnect::closeConnect($conn);
        if(count($getProduct) == 0){
        	echo "<script>alert('Error Login');</script>";
        }
        else{
        	$_SESSION['username'] = $_POST['username'];
        	echo "<script>alert('Login success');</script>";	
        	echo "<script>location.reload();</script>";
        }
    }
?>
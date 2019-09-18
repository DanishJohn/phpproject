<?php
	require_once '../database/databaseConnect.php';
    require_once '../Constants/constants.php';
    session_start();
    $conn = DatabaseConnect::connect();

    if(!isset($_POST[Constants::$PASSWORD])){
    	if(strcmp($_POST[Constants::$BIRTHDAY], "") == 0){
		$dob = null;
		}
		else{
			$dob = "'".$_POST[Constants::$BIRTHDAY]."'";
		}
		if(isset($_POST[Constants::$GENDER])){
			if(strcmp($_POST[Constants::$GENDER], "Male") == 0){
				$gender = 0;
			}
			else{
				$gender = 1;
			}	
		}
		else{
			$gender = null;
		}
		
		DatabaseConnect::updateCustomerInfo("update customer set customer_name = '".$_POST[Constants::$FULLNAME]."',
																 customer_mobile = '".$_POST[Constants::$PHONENUMBER]."',
																 customer_email = '".$_POST[Constants::$EMAIL]."',
																 customer_dob = ".$dob.",
																 customer_gender = ".$gender."
																 where customer_username like '".$_SESSION["username"]."'", $conn);
		if($conn != null){
			DatabaseConnect::closeConnect($conn);
		}
		header("Location: customer_info.php");	
	}
	else{
		$result = DatabaseConnect::getResult("select * from customer where customer_username like '".$_SESSION['username']."'", $conn);
		$password = $result[0]["customer_password"];
		$oldpassword = $_POST[Constants::$OPASSWORD];
		$newpassword = $_POST[Constants::$PASSWORD];
		$renewpassword = $_POST[Constants::$CPASSWORD];

		if(strcmp($password,$oldpassword) == 0){
			if(strcmp($newpassword,$renewpassword) == 0){
				DatabaseConnect::updateCustomerInfo("update customer set customer_password = '".$newpassword."'", $conn);
				$_SESSION[Constants::$STATUS_SUCCESS_CHANGEPASSWORD] = Constants::$STATUS_SUCCESS_CHANGEPASSWORD;
				header("Location: customer_info.php");
			}
		}
		else{
			$_SESSION[Constants::$STATUS_ERROR_CHANGEPASSWORD] = Constants::$STATUS_ERROR_CHANGEPASSWORD;
			header("Location: customer_changepass.php");
		}
		if($conn != null){
			DatabaseConnect::closeConnect($conn);
		}
	}	
 ?>	

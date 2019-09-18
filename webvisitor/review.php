<?php 
	require_once '../database/databaseConnect.php';
	require_once '../Constants/constants.php';

	session_start();
 	$conn = DatabaseConnect::connect();
    if($conn != null){
        $sql_rating = "INSERT INTO product_rating (product_id, customer_id, rating,rating_content) VALUES ('".$_REQUEST['product_id']."', '".$_SESSION['username']."', ".$_REQUEST['num_star'].",'".$_REQUEST['content']."')";
        $conn->exec($sql_rating);
        DatabaseConnect::closeConnect($conn);
    }
?>
<?php

include '../connect.inc';
$id = $_POST['id'];
$query = "update product_rating set rating_content = '' where id = $id";
if (mysqli_query($link, $query)) {
    $query = "select rating_content from product_rating where id = $id";
    $res = mysqli_query($link, $query);
  	while($row = mysqli_fetch_row($res)){
  		echo $row[0];
  	}
  	echo "<script>alert('Deleted Success');</script>";
}   
else{
	echo "<script>alert('Error');</script>";
}
?>

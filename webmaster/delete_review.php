<?php
session_start();
include_once '../connect.inc';
$customerid = $_GET['customer'];
$content = $_GET['content'];
$deleteSQL = "delete from product_rating where customer_id = '$customerid' and rating_content = '$content'";
if(mysqli_query($link, $deleteSQL)) {
    $_SESSION['delete_success']="";
    header("location: admin_review_list.php");
}
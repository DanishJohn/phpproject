<?php
session_start();
include_once '../connect.inc';
$id = $_GET['prodlist'];
$delQuery = "delete from products where prod_id = '$id'";
$result = mysqli_query($link, $delQuery);
if($result != 0){
    $_SESSION['del_success'] = "";
    header("location: admin_product_dashboard.php");
    exit;
}
else{
    $_SESSION['del_unsuccess'] = "";
    header("location: admin_product_dashboard.php");
    exit;
}

        
<?php
session_start();
include_once '../connect.inc';
$name = $_GET["name"];
$getStats = $_GET["status"];
$getOrder = "select order_status from customer_order where customer_username = '$name' and order_status!='Delivered'";
$getOrderRes = mysqli_query($link, $getOrder);
$numrow = mysqli_num_rows($getOrderRes);
if ($numrow == 0) {
    if ($getStats == "active") {
        $disableAcc = "update customer set customer_status = 0 where customer_username = '$name'";
        if (mysqli_query($link, $disableAcc)) {
            header("location: admin_account_dashboard.php");
        } else {
            echo "<script>alert(\"Failed to change account status\")</script>";
        }
    } else {
        $enableAcc = "update customer set customer_status = 1 where customer_username = '$name'";
        if (mysqli_query($link, $enableAcc)) {
            header("location: admin_account_dashboard.php");
        } else {
            echo "<script>alert(\"Failed to change account status\")</script>";
        }
    }
} else {
    $_SESSION['change_fail']= "";
    header("location: admin_account_dashboard.php");
}
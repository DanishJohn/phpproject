<?php

include_once '../connect.inc';
$status = $_GET['status'];
$customer = $_GET['cust'];
if ($status == 0) {
    $updateStatus = "update review set review_status = 1 where customer_id = '$customer'";
    if (!mysqli_query($link, $updateStatus)) {
        echo "<script>alert(\"Cant change status\");</script>";
    }
    else {
        header("location: admin_review_list.php");
    }
} else if ($status == 1) {
    $updateStatus = "update review set review_status = 0 where customer_id = '$customer'";
    if (!mysqli_query($link, $updateStatus)) {
        echo "<script>alert(\"Cant change status\");</script>";
    }
    else {
        header("location: admin_review_list.php");
    }
}
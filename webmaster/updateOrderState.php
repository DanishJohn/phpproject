<?php

include_once '../connect.inc';
$id = $_GET['q'];
$status = $_GET['state'];
$updateState = "update customer_order set order_status = '$status' where order_id = $id";
mysqli_query($link, $updateState);
if ($status == "Delivered") {
    $orderQuantQuery = "select quantity, prod_id from order_item where order_id = $id";
    $quantRes = mysqli_query($link, $orderQuantQuery);
    while ($row = mysqli_fetch_row($quantRes)) {
        $reduceStock = "update products set quantity = IF(quantity - $row[0]<0,0,quantity-$row[0]) where prod_id = $row[1]";
        mysqli_query($link, $reduceStock);
    }
}
echo "$status";
?>


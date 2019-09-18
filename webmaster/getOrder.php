<?php

include_once '../connect.inc';
$orderSQL = 'select a.order_id, a.order_status, a.customer_username, a.customer_email,a.customer_tel,a.delivery_address,a.delivery_note, a.created_date, sum(b.quantity) from customer_order a, order_item b where a.order_id = b.order_id group by a.order_id';
$orderRes = mysqli_query($link, $orderSQL);
while ($row = mysqli_fetch_row($orderRes)) {
    // $modalQuery = "select a.product"

    echo "<tr>";
    if ($row[1] != "Delivered") {
        echo "<td><button type='button' class='btn btn-info btn-sm' data-toggle='modal' data-target='#order-$row[0]'>Resolve Order</button></td>";
    } else {
        echo "<td>Order Resolved</td>";
    }
    echo "<td>$row[0]</td>";
    echo "<td><div id='$row[0]'>$row[1]</div></td>";
    for ($i = 2; $i < count($row); $i++) {
        echo "<td>$row[$i] </td>";
    }
    echo "<td><button type='button' class='btn btn-info btn-md' data-toggle='modal' data-target='#modal-$row[0]'>Order Detail</button></td>";
}
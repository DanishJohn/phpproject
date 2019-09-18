<?php
include_once '../connect.inc';
$getAcc = 'select customer_username, customer_name, customer_email, customer_mobile, customer_dob, customer_status, created_date from customer';
$queryRes = mysqli_query($link, $getAcc);
while ($row = mysqli_fetch_row($queryRes)) {
    $status='';
    if ($row[5] == 1) {
        $status = "active";
    }
    else {
        $status = "disabled";
    }
    echo "<tr>";
    echo "<td>$row[0]</td>";
    echo "<td>$row[1] </td>";
    echo "<td>$row[2] </td>";
    echo "<td>$row[3] </td>";
    echo "<td>$row[4] </td>";
    echo "<td>$status</td>";
    echo "<td>$row[6]</td>";
    if ($status == "active") {
        echo "<td><a href='change_account_status.php?name=$row[0]&status=$status'>Disable</a></td>";
    }
    else {
        echo "<td><a href='change_account_status.php?name=$row[0]&status=$status'>Enable</a></td>";
    }
    echo "</tr>";
}
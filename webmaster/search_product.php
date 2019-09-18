<?php

include_once '../connect.inc';

$searchResult = $_GET['q'];

    $selectProduct = "select * from products where prod_name like '%$searchResult%'";
    $res = mysqli_query($link, $selectProduct);
    while ($row = mysqli_fetch_row($res)) {
        echo "<tr>";
        echo "<td><a href='admin_edit.php?prodlist=$row[0]'>Edit</a> | <a href='admin_delete.php?prodlist=$row[0]' id='del$row[0]' onclick='return confirm(\"Do you want to delete?\")'>Delete </a></td>";
        echo "<td>$row[0]</td>";
        echo "<td>$row[1]</td>";
        echo "<td>$row[2]</td>";
        echo "<td>$row[8]</td>";
        echo "<td>$row[9]</td>";
        echo "<td>$row[10]</td>";
        echo "<td><a class='btn btn-primary btn-md' data-toggle='modal' data-target='#detail-$row[0]'><b>Click to see details</b></a></td>";
        echo "</tr>";
    
}


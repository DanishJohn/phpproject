<?php

include_once '../connect.inc';
$selectProduct = "select * from products";
$res = mysqli_query($link, $selectProduct);
$productrow = mysqli_num_rows($res);
$rowperpage = 5;
$totalPage = ceil($productrow / $rowperpage);
if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
    $currentpage = (int) $_GET['currentpage'];
} else {
    $currentpage = 1;
}
if ($currentpage > $totalPage) {
    $currentpage = $totalPage;
}
$offset = ($currentpage - 1) * $rowperpage;
$selectProductPagination = "select * from products limit $rowperpage offset $offset";
$res2 = mysqli_query($link, $selectProductPagination);

echo '<nav aria-label = "Page navigation example">';
echo '<ul class = "pagination">';
for ($i = 1; $i <= $totalPage; $i++) {
    if ($i == $currentpage) {
        echo "<li class = 'page-item'><a class = 'page-link' href = '?currentpage=$i'><b>$i</b></a></li>";
    } else {
        echo "<li class = 'page-item'><a class = 'page-link' href = '?currentpage=$i'>$i</a></li>";
   }
}
echo '</ul>';
echo '</nav>';

while ($row = mysqli_fetch_row($res2)) {
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
?>
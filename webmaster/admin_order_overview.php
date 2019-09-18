<?php
session_start();
include_once '../connect.inc';
if (!isset($_SESSION['registered_admin'])) {
    header("location: admin_login.php");
}

?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Administrator Dashboard</title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- Custom styles for this template -->
        <link href="../frameworks/sidebar.css" rel="stylesheet" type="text/css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </head>

    <body>
        <?php include_once '../connect.inc'; ?>

        <div class="d-flex" id="wrapper">

            <!-- Sidebar -->
            <div class="bg-light border-right" id="sidebar-wrapper">
                <div class="sidebar-heading">Admin Dashboard</div>
                <div class="list-group list-group-flush">
                    <a href="admin_dashboard.php" class="list-group-item list-group-item-action bg-light">Homepage</a>
                    <a href="admin_product_dashboard.php" class="list-group-item list-group-item-action bg-light">Products Overview</a>
                    <a href="admin_account_dashboard.php" class="list-group-item list-group-item-action bg-light">Accounts Overview</a>
                    <a href="admin_order_overview.php" class="list-group-item list-group-item-action bg-light">Order Overview</a>
                    <a href="admin_feedback.php" class="list-group-item list-group-item-action bg-light">Feedback List</a>
                    <a href="admin_review_list.php" class="list-group-item list-group-item-action bg-light">Review List</a>
                </div>
            </div>
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper">

                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="#">Welcome <?php
                                    if (isset($_SESSION['registered_admin'])) {
                                        echo $_SESSION['registered_admin'];
                                    }
                                    ?></a>
                            </li>
                            <li class="nav-item">
                                <a class='nav-link' href='admin_logout.php'><?php
                                    if (isset($_SESSION['registered_admin'])) {
                                        echo "Log out";
                                    }
                                    ?> </a>
                            </li>

                        </ul>
                    </div>
                </nav>

                <div class="container">
                    <div class='card text-white bg-dark mb-3'>
                        <div class='card-title'> <h1>Order Overview</h1></div>
                        <div class='card-body'>

                        </div>
                    </div>
                    <table class="table table-sm table-responsive">
                        <thead>
                        <th>Resolve order</th>
                        <th>Order ID</th>
                        <th>Order's Status</th>
                        <th>Customer's username</th>
                        <th>Customer's Email</th>
                        <th>Customer's Telephone</th>
                        <th>Delivery's Address</th>
                        <th>Delivery's note</th>
                        <th>Order Date</th>
                        <th>Quantity</th>
                        <th>Order Details</th>
                        </thead>
                        <tbody id='order-body'>
                            <?php
                            include './getOrder.php';
                            ?>

                        </tbody>
                    </table>
                    <?php
                    $orderRes2 = mysqli_query($link, $orderSQL);
                    while ($row2 = mysqli_fetch_row($orderRes2)) {
                        echo "<div class='modal fade' id='modal-$row2[0]'>";
                        echo "<div class='modal-dialog'>";
                        echo "<div class='modal-content'>";
                        echo "<div class='modal-body'>";
                        echo "<table class='table'>";
                        echo "<thead>";
                        echo "<th>Product's Name</th>";
                        echo "<th>Product's Quantity</th>";
                        echo "<th>Total Price</th>";
                        echo "</thead>";
                        echo "<tbody>";
                        $modalQuery = "select a.prod_name, b.quantity from products a, order_item b where b.order_id = $row2[0] and a.prod_id = b.prod_id";
                        $modalRes = mysqli_query($link, $modalQuery);
                        while ($modalRow = mysqli_fetch_row($modalRes)) {
                            $priceQuery = "select prod_price from products where prod_name = '$modalRow[0]'";
                            $priceNum = mysqli_fetch_row(mysqli_query($link, $priceQuery));
                            echo "<tr>";
                            echo "<td>$modalRow[0]</td>";
                            echo "<td>$modalRow[1]</td>";
                            echo "<td>$" . ($modalRow[1] * $priceNum[0]) . "</td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                    ?>
                    <?php
                    $orderRes3 = mysqli_query($link, $orderSQL);
                    while ($row3 = mysqli_fetch_row($orderRes3)) {
                        ?>
                        <div class='modal fade' id="<?php echo "order-$row3[0]" ?>">
                            <div class="modal-dialog">
                                <div class='modal-content'>
                                    <div class="modal-body">
                                            <select id="select-<?php echo $row3[0] ?>" name="selectOption">
                                                <option value="In Warehouse">In Warehouse</option>
                                                <option value="Delivering">Delivering</option>
                                                <option value="Delivered">Delivered</option>
                                            </select>
                                            <br>
                                            <br>
                                            <input type="button" onclick="showCustomer(<?php echo $row3[0] ?>)" name="statusSub" value="Change" class="btn btn-info btn-sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                </div>
            </div>
            <!-- /#page-content-wrapper -->

        </div>
        <!-- /#wrapper -->
    </body>
    <script>
            function showCustomer(str) {
                var stat = document.getElementById("select-" + str);
                var status = stat.options[stat.selectedIndex].value;
                xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById(str).innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", "updateOrderState.php?q=" + str + "&state=" + status, true);
                xhttp.send();
            }
        </script>


</html>
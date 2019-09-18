<?php
session_start();
if (!isset($_SESSION['registered_admin'])) {
    header("location:../TestLogin.php");
}
?>


<!DOCTYPE html>
<html lang="en">
    <?php
    $id = $_GET['id'];
    include_once '../connect.inc';
    $selectProductSpecific = "select * from products where prod_id = '$id'";
    $res = mysqli_query($link, $selectProductSpecific);
    $row = mysqli_fetch_row($res);

    if (isset($_POST['btnEdit'])) {
        $stock = $_POST['addStock'];
        $updateSQL = "update products set quantity = quantity + $stock where prod_id = $id";
        if (mysqli_query($link, $updateSQL)) {
            header("location: admin_product_dashboard.php?prodlist=$id");
        } else {
            header("location:admin_dashboard.php");
        }
    }
    ?>


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
                    <div class='card text-bacl bg-default mb-3'>
                        <div class='card-title'> <h1>Editing product's stock</h1></div>
                        <div class='card-body'>
                        </div>
                        <form method='POST' enctype="multipart/form-data">

                            <table class='table'>

                                <tr>
                                    <td>Product's stock</td>
                                    <td><input type='number' min='0' required name='addStock'> </td>                                    
                                </tr>
                                <tr><td><input type='submit' name='btnEdit' value='Add'></td></tr>
                            </table>
                        </form>

                    </div>
                </div>
            </div>
            <!-- /#page-content-wrapper -->

        </div>
        <!-- /#wrapper -->




    </body>


</html>
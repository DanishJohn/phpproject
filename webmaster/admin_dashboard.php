<?php
session_start();
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
                        <div class='card-title'> <h1>Overview of current's shop database</h1></div>
                        <div class='card-body'>
                            <p>
                            <h2> Welcome to the Administrator page for Haven's Bag Shop. </h2> <br>
                            Here are some notable menus for administrators to navigate:
                            <ul>
                                <li><b>Products Overview:</b>You can view list of products that are present in the store. Functionalities included are edit and delete.</li> 
                                <li><b>Accounts Overview:</b>Admins can check list of created customers account in this tab. You cannot delete a customer's account but you can disable said account.</li>
                                <li><b>Customer's Order Ovewview:</b> Admins can check for any placed order here and its status, including cancelled order.</li>
                            </ul>

                            </p>
                        </div>
                    </div>
                    <div class='row'> 
                        <div class='col'>
                            <b>Number of Products in store:<b> <?php
                                    $productNumSQL = "select * from products";
                                    echo mysqli_num_rows(mysqli_query($link, $productNumSQL));
                                    ?>
                                    </div>
                                    <div class='col'>
                                        <b>Number of created customer's account: </b> <?php
                                        $accountNumSQL = "select * from customer;";
                                        echo mysqli_num_rows(mysqli_query($link, $accountNumSQL));
                                        ?>
                                    </div>
                                    </div>
                                    <div class='row'>
                                        <div class='col'>
                                            <br><b>Number of customer's order to date: </b> <?php
                                        $orderNumSQL = "select * from customer_order";
                                        echo mysqli_num_rows(mysqli_query($link, $orderNumSQL));
                                        ?>
                                        </div>
                                    </div>
                                    </div>
                                    </div>
                                    <!-- /#page-content-wrapper -->

                                    </div>
                                    <!-- /#wrapper -->




                                    </body>

                                    </html>
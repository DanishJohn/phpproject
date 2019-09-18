<?php
session_start();
if (!isset($_SESSION['registered_admin'])) {
    header("location: admin_login.php");
}
if (isset($_SESSION['change_fail'])) {
    echo "<script>alert(\"This account still has order in process, cannot disable\");</script>";
    unset($_SESSION['change_fail']);
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
        <script src="../frameworks/js/jquery-3.3.1.min.js"></script>
        <script src="../frameworks/js/bootstrap.min.js"></script>

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
                        <div class='card-title'> <h1>Overview of all created accounts</h1></div>
                        <div class='card-body'>

                        </div>
                    </div>
                </div>
                <div class="container">
                    <label>Search account </label> <input type="text" placeholder="Search account name" onkeyup="liveSearch(this.value)">
                </div><br>
                <table class="table table-bordered table-responsive"> 
                    <thead>
                    <th>Customer's Username</th>
                    <th>Customer's Name</th>
                    <th>Customer's Email</th>
                    <th>Customer's Mobile</th>
                    <th>Customer's DoB</th>
                    <th>Customer's Status</th>
                    <th>Date created</th>
                    <th>Change account status</th>
                    </thead>
                    <tbody id="account">
                        <?php
                        include "./getAllAccount.php";
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- /#page-content-wrapper -->

        </div>
        <!-- /#wrapper -->

        <script>
            function liveSearch(str) {
                $.ajax({
                    type: 'GET',
                    url: 'getSearchedAccount.php?str=' + str,
                    success: function(data) {
                        document.getElementById("account").innerHTML = data;
                    }
                })
            }
        </script>


    </body>

</html>
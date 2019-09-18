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
                        <div class='card-title'> <h1>Feedback List</h1></div>
                        <div class='card-body'>

                        </div>
                    </div>
                    <table class='table'>
                        <thead>
                        <th>Customer's username (optional)</th>
                        <th>Customer's Email</th>
                        <th>Customer's Telephone</th>
                        <th>Feedback Details</th>
                        <th>Reply's status</th>
                        <th></th>
                        <tbody>
                            <?php
                            include_once '../connect.inc';
                            $feedbackSQL = "select feedback_id, customer_username, email, telephone, feedback_details, reply_status, reply_detail from feedback";
                            $feedbackRES = mysqli_query($link, $feedbackSQL);
                            while ($row = mysqli_fetch_row($feedbackRES)) {
                                echo "<tr>";
                                if ($row[5] == 0 && $row[6] == null) {
                                    $status = "not yet";
                                } else {
                                    $status = 'replied';
                                }
                                for ($i = 1; $i < 5; $i++) {
                                    echo "<td>$row[$i]</td>";
                                }
                                echo "<td>$status</td>";
                                echo "<td><button type='button' class='btn btn-info btn-md' data-toggle='modal' data-target='#modal-$row[0]'>Reply's detail</button></td>";
                                //if ($status == "not yet") {
                                    echo "<td><a href='admin_reply.php?id=$row[0]&email=$row[2]'>Click to reply</a></td>";
                                //}
                                    echo "</tr>";
                            }
                            ?>
                        </tbody>
                        </thead>
                    </table>
                    <?php
                    $feedbackmodalsql = "select feedback_id, admin_id_reply, reply_detail, reply_date from feedback";
                    $feedbackmodalres = mysqli_query($link, $feedbackmodalsql);
                    while ($modalrow = mysqli_fetch_row($feedbackmodalres)) {
                        ?>
                        <div class='modal fade' id='modal-<?php echo $modalrow[0] ?>' >
                            <div class='modal-dialog'>
                                <div class='modal-content'>
                                    <div class='modal-body'>
                                        <table class='table table-sm'>
                                            <thead>
                                            <th> Admin</th>
                                            <th>Reply's detail</th>
                                            <th>Reply's Date</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                echo "<td>$modalrow[1]</td>";
                                                echo "<td>$modalrow[2]</td>";
                                                echo "<td>$modalrow[3]</td>";
                                                ?>
                                            </tbody>
                                        </table>
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

</html>
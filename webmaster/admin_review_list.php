<?php
session_start();
if (!isset($_SESSION['registered_admin'])) {
    header("location: admin_login.php");
    exit;
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
        <script src="../js/jquery-3.3.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        
    </head>

    <body>
        <?php include_once '../connect.inc'; ?>

        <div id="deleted"></div>

        <script>
            function showStatus(id) {
                $.ajax({
                    url: "updateReviewStatus.php",
                    method: "post",
                    data:{id:id},
                    success:function(data){
                        $('#update_content_'+id).html(data);
                    }
                });
            }
        </script>

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
                        <div class='card-title'> <h1>List of reviews</h1></div>
                        <div class='card-body'>

                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-responsive"> 
                    <thead>
                    <th>Product's id</th>
                    <th>Product's name</th>
                    <th>Number of reviews</th>
                    <th>Average's review score</th>
                    <th>Change Review Content</th>
                    </thead>
                    <tbody>
                        <?php
                        include_once '../connect.inc';
                        $getReview = "select a.product_ID, b.prod_name, count(*),AVG(a.rating) from product_rating a, products b where a.product_ID = b.prod_id group by a.product_ID";
                        $res = mysqli_query($link, $getReview);
                        while ($row = mysqli_fetch_row($res)) {
                            echo "<td>$row[0]</td>";
                            echo "<td>$row[1]</td>";
                            echo "<td>$row[2]</td>";
                            echo "<td>".number_format($row[3], 2)."</td>";
                            echo "<td><button type='button' class='btn btn-sm btn-info' data-toggle='modal' data-target='#modal-$row[0]'>Edit</button></td>";
                        }
                        ?>
                    </tbody>
                </table>
                <!-- The Modal -->
                <?php
                $getReviewWithContent = "select a.id, a.customer_id, a.rating_content, b.prod_name, a.product_ID from product_rating a, products b where a.product_ID = b.prod_id";
                $contentResult = mysqli_query($link, $getReviewWithContent);
                $res2 = mysqli_query($link, $getReview);
                while ($row2 = mysqli_fetch_row($res2)) {
                    ?>
                    <div class="modal fade" id="<?php echo "modal-$row2[0]" ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">List of Reviews</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <table class='table table-sm'>
                                        <thead>
                                        <th>Review's ID</th>
                                        <th>Customer's ID</th>
                                        <th>Review's Content</th>
                                        <th>Delete review content</th>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = mysqli_fetch_row($contentResult)) { ?>
                                                <tr>
                                                    <td><?php echo "$row[0]" ?></td>
                                                    <td><?php echo "$row[1]" ?></td>
                                                    <td id="update_content_<?=$row[0]?>" style = "word-break: break-all;"><?php echo "$row[2]" ?></td>
                                                    <td><button onclick="showStatus(<?=$row[0]?>);">Delete content</button></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>

                                    </table>
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php 
                    } 
                ?>
            </div>
            <!-- /#page-content-wrapper -->

        </div>
        <!-- /#wrapper -->

    </body>

</html>
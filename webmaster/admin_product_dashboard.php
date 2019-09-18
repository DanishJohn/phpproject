<?php
session_start();

if (!isset($_SESSION['registered_admin'])) {
    header("location:../TestLogin.php");
}

if (isset($_SESSION['edit_success'])) {
    $editmsg = $_SESSION['edit_success'];
    echo "<script>";
    echo "alert(\"$editmsg\")";
    echo "</script>";
    unset($_SESSION['edit_success']);
}
if (isset($_SESSION['imgerror'])) {
    $imgerror = $_SESSION['imgerror'];
    echo "<script> alert(\"$imgerror\") </script>";
    unset($_SESSION['imgerror']);
}
if (isset($_SESSION['del_unsuccess'])) {
    $unsuc = $_SESSION['del_unsuccess'];
    echo "<script> alert(\"$unsuc\")</script>";
    unset($_SESSION['del_unsuccess']);
}
if (isset($_SESSION['name_duplicate'])) {
    echo $_SESSION['name_duplicate'];
    unset($_SESSION['name_duplicate']);
}
if (isset($_SESSION['not_image'])) {
    echo $_SESSION['not_image'];
    unset($_SESSION['not_image']);
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
                    <div class='card bg-light mb-3'>
                        <div class='card-title'> <h1>Current list of products</h1></div>
                        <div class='card-body'>

                        </div>
                    </div>
                    <div class="container">
                        Product Filter: <input type="text" name="filter" onkeyup="liveSearch(this.value)">
                    </div>
                    <br>
                    <a href="admin_add.php"><button class="btn btn-success" type="button" value="Add Products"><b>Add Products</b></button></a>
                    <br>
                    <br>
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Product's ID</th>
                                <th>Product's Name</th>
                                <th>Product's Price</th>
                                <th>Product's stock</th>
                                <th>Product's gender</th>
                                <th>Product's category</th>
                                <th>Product's description</th>
                            </tr>
                        </thead>
                        <tbody id='prodTable'>
                            <?php
                            include_once './getProductTable.php';
                            ?>
                        </tbody>
                    </table>
                    <?php
                    $productDetails = "select prod_id, prod_description, material, detail, detail_size, strap_material, strap_length, zip_type, slot_num, simple_size, style from products";
                    $detailRes = mysqli_query($link, $productDetails);
                    while ($modalrow = mysqli_fetch_row($detailRes)) {
                        ?>
                        <div id="detail-<?php echo $modalrow[0] ?>" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Details</h4>
                                    </div>
                                    <div class="modal-body">
                                        <textarea readonly cols="50" rows="4"><?php echo $modalrow[1] ?></textarea>
                                        <table class='table table-sm'>
                                            <th>Material</th>
                                            <th>Detail</th>
                                            <th>Detail Size</th>
                                            <th>Strap Material</th>
                                            <th>Strap length</th>
                                            <th>Zip type</th>
                                            <th>Slot Num</th>
                                            <th>Simple Size </th>
                                            <th>Style</th>
                                            <tbody>
                                                <tr>
                                                    <?php
                                                    for ($i = 2; $i < 11; $i++) {
                                                        echo "<td>$modalrow[$i]</td>";
                                                    }
                                                    ?>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>

                            </div>
                        </div>
<?php } ?>
                </div>
            </div>
            <!-- /#page-content-wrapper -->

        </div>
        <!-- /#wrapper -->


    </body>
    <script>
        function sendCart(id) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var cartNumber = document.getElementById("cart").innerHTML;
                    cartNumber++;
                    document.getElementById("cart").innerHTML = cartNumber;
                    sessionStorage.setItem("cartNum", cartNumber);
                }
            };
            xmlhttp.open("GET", "shopping_cart.php?id=" + id, true);
            xmlhttp.send();
        }
        function liveSearch(str) {
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {  // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("prodTable").innerHTML = this.responseText;
                }
            }
            xmlhttp.open("GET", "search_product.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>


</html>
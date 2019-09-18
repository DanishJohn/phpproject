<?php
session_start();
if (!isset($_SESSION['registered_admin'])) {
    header("location:../TestLogin.php");
}
?>


<!DOCTYPE html>
<html lang="en">
    <?php
    include_once '../connect.inc';
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
                        <div class='card-title'> <h1>Add product</h1></div>
                        <div class='card-body'>
                        </div>
                        <form method='POST' enctype="multipart/form-data" action="add_and_upload.php">

                            <table class='table'>
                                <tr>
                                    <td>Product's name:</td>
                                    <td><input type='text' id="name" name='addName' required pattern="^[a-zA-Z0-9][a-zA-Z0-9 ]{3,255}[a-zA-Z0-9]$" placeholder="Enter product's name"</td>
                                </tr>
                                <tr>
                                    <td>Product's Price:</td>
                                    <td><input type='number' id="price" name='addPrice' required placeholder="Enter product's price"></td>
                                </tr>
                                <tr>
                                    <td>Product's stock</td>
                                    <td><input type='number' name='addStock' id="stock" required placeholder="Enter product's quantity"></td>
                                </tr>
                                <tr><td>Product's gender</td>
                                    <td><input type='text' name='addGender' id="gender" required pattern="(men|women|unisex)" placeholder="men, women or unisex"></td></tr>

                                <tr><td>Product's category (handbag or backpack)</td>
                                    <td><input type='text' name='addCat' id="cat" required patter="(handbag|backpack)" placeholder="handbag or backpack"></tr>
                                <tr>
                                    <td>Product's Brand:</td>
                                    <td><select name='brand' required>
                                            <?php
                                            $brandGet = "select * from brand";
                                            $brandRes = mysqli_query($link, $brandGet);
                                            while ($row = mysqli_fetch_row($brandRes)) {
                                                ?>
                                                <option value='<?php echo $row[0] ?>'><?php echo $row[1] ?></option> <?php } ?>
                                        </select></td>
                                </tr>
                                <tr><td>Product's description</td>
                                    <td><textarea rows='4' cols='50' pattern='[a-zA-Z0-9 ]{,1000}' name='addDes'></textarea>
                                </tr>
                                <tr>
                                    <td>Product's Material:</td>
                                    <td><input type='text' name='addMat'></td>
                                </tr>
                                <tr>
                                    <td>Product's detail: </td>
                                    <td><input type="text" name='addDet'</td>
                                </tr>
                                <tr>
                                    <td>Product's detail size:</td>
                                    <td><input type='text' name='addDetSize'</td>
                                </tr>
                                <tr>
                                    <td>Product's Strap material: </td>
                                    <td><input type='text' name='addStrapMat'</td>
                                </tr>
                                <tr>
                                    <td>Product's Strap Length:</td>
                                    <td><input type='text' name='addStrapLength'</td>
                                </tr>
                                <tr>
                                    <td>Product's zip type:</td>
                                    <td><input type='text' name='addZipType'></td>
                                </tr>
                                <tr>
                                    <td>Product's Slot Number: </td>
                                    <td><input type='text' name='addSlotNum'</td>
                                </tr>
                                <tr>
                                    <td>Product's Simple size</td>
                                    <td><input type='text' name='addSimpleSize'</td>
                                </tr>
                                <tr>
                                    <td>Product's Style:</td>
                                    <td><input type='text' name='addStyle'</td>
                                </tr>
                                <tr>
                                    <td>Add image 1:</td>
                                    <td><input type='file' name='img' required></td>
                                </tr>
                                <tr>
                                    <td>Add image 2:</td>
                                    <td><input type='file' name='img2'></td>
                                </tr>
                                <tr>
                                    <td> Add image 3: </td>
                                    <td><input type='file' name='img3'></td>
                                </tr>
                                <tr>
                                    <td>Add image 4:</td>
                                    <td><input type="file" name='img4'</td>
                                </tr>
                                <tr><td><input class='btn btn-info btn-lg' type='submit' id="click" name='btnAdd' value='Add'></td></tr>
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
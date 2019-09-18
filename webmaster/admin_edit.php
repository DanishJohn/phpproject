<?php
session_start();
if (!isset($_SESSION['registered_admin'])) {
    header("location:../TestLogin.php");
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">
    <?php
    $id = $_GET['prodlist'];
    require_once '../connect.inc';
    $selectProductSpecific = "select * from products where prod_id = '$id'";
    $res = mysqli_query($link, $selectProductSpecific);
    $row = mysqli_fetch_row($res);
    $filename = $row[4];
    $filename_2 = $row[5];
    $filename_3 = $row[6];
    $filename_4 = $row[7];
    $string = "";
    if(isset($_SESSION['error_upload'])){
        echo "<script>alert('Error selected image')</script>";
        unset($_SESSION['error_upload']);
    }

    if(isset($_REQUEST['image'])){
        $filename = $_REQUEST['image'];
        $string .= "&image=".$filename;
    }

    if(isset($_REQUEST['image_2'])){
        $filename_2 = $_REQUEST['image_2'];
        $string .= "&image_2=".$filename_2;
    }

    if(isset($_REQUEST['image_3'])){
        $filename_3 = $_REQUEST['image_3'];
        $string .= "&image_3=".$filename_3;
    }
    
    if(isset($_REQUEST['image_4'])){
        $filename_4 = $_REQUEST['image_4'];
        $string .= "&image_4=".$filename_4;
    }
    
    if (isset($_POST['btnEdit'])) {
        $query = "";
        $name = $_POST['editName'];
        $price = $_POST['editPrice'];
        $stock = $_POST['editStock'];
        $gender = $_POST['editGender'];
        $cat = $_POST['editCat'];
        $des = $_POST['editDes'];
        $brand = $_POST['brand'];
        $editMaterial = $_POST['editMaterial'];
        $editDetail = $_POST['editDetail'];
        $editDetailSize = $_POST['editDetailSize'];
        $editStrapMaterial = $_POST['editStrapMaterial'];
        $editStrapLength = $_POST['editStrapLength'];
        $editZipType = $_POST['editZipType'];
        $editSlotNum = $_POST['editSlotNum'];
        $editSimpleSize = $_POST['editSimpleSize'];
        $editStyle = $_POST['editStyle'];

        if(isset($_REQUEST['image'])){
            $query .= "`image` = '".$_REQUEST['image']."',";
        }
        if(isset($_REQUEST['image_2'])){
            $query .= "`image_2` = '".$_REQUEST['image_2']."',";
        }
        if(isset($_REQUEST['image_3'])){
            $query .= "`image_3` = '".$_REQUEST['image_3']."',";
        }
        if(isset($_REQUEST['image_4'])){
            $query .= "`image_4` = '".$_REQUEST['image_4']."',";
        }
        $updateSQL = "update products set ".$query." `prod_name` = '$name', `prod_price` = $price, `quantity` = $stock, `product_gender` = '$gender', `product_category` = '$cat', `prod_description` = '$des', `brand_id` = '$brand' , `material` = '$editMaterial', `detail` = '$editDetail' , `detail_size` = '$editDetailSize' , `strap_material` = '$editStrapMaterial' , `strap_length` = '$editStrapLength', `zip_type` = '$editZipType', `slot_num` = '$editSlotNum', `simple_size` = '$editSimpleSize', `style` = '$editStyle' where `prod_id` = $id";

        if (mysqli_query($link, $updateSQL)) {
            $_SESSION['edit_success'] = "Product successfully edited";
            header("location:admin_product_dashboard.php");
            exit;
        } else {
            header("location:admin_dashboard.php");
            exit;
        }
    } else {
        if (isset($_POST['imgChange1'])) {
            if(!isset($_REQUEST['image'])){
                $string .= "&image=".$filename;
            }
            $_SESSION['imgChange1'] = "";
            header("location: upload_page.php?prodlist=$id".$string);
            exit;
        }
        else if(isset($_POST['imgChange2'])){
            if(!isset($_REQUEST['image_2'])){
                $string .= "&image_2=".$filename_2;
            }
            $_SESSION['imgChange2'] = "";
            header("location: upload_page.php?prodlist=$id".$string);
            exit;
        }
        else if(isset($_POST['imgChange3'])){
            if(!isset($_REQUEST['image_3'])){
                $string .= "&image_3=".$filename_3;
            }
            $_SESSION['imgChange3'] = "";
            header("location: upload_page.php?prodlist=$id".$string);
            exit;
        }
        else if(isset($_POST['imgChange4'])){
            if(!isset($_REQUEST['image_4'])){
                $string .= "&image_4=".$filename_4;
            }
            $_SESSION['imgChange4'] = "";
            header("location: upload_page.php?prodlist=$id".$string);
            exit;
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
        <script src="../js/jquery-3.3.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>

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
                        <div class='card-title'> <h1>Editing product</h1></div>
                        <div class='card-body'>
                        </div>
                        <form method='POST' enctype="multipart/form-data">

                            <table class='table'>
                                <tbody style="width: 100%; display: block; height: 200px;">
                                    <tr style="display: block; height: 100%;">
                                        <td style="width: 26%; height: 100%; display: inline-block;"><img src="../img/<?php echo $filename; ?>" width="100%" height="100%" name="image"></td>
                                        <td style="width: 24.2%; height: 100%; display: inline-block;"><img src="../img/<?php echo $filename_2; ?>" width="100%" height="100%" name="image"></td>
                                        <td style="width: 24.1%; height: 100%; display: inline-block;"><img src="../img/<?php echo $filename_3; ?>" width="100%" height="100%" name="image"></td>
                                        <td style="width: 24.1%; height: 100%; display: inline-block;"><img src="../img/<?php echo $filename_4; ?>" width="100%" height="100%" name="image"></td>
                                    </tr>
                                    <tr>
                                        <td>Product's name:</td>
                                        <td><input type='text' name='editName' value="<?php echo $row[1] ?>"</td>
                                    </tr>
                                    <tr>
                                        <td>Product's Price:</td>
                                        <td><input type='number' name='editPrice' value="<?php echo "$row[2]" ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Product's stock</td>
                                        <td><input type='number' name='editStock' value="<?php echo $row[8] ?>"></td>
                                    </tr>
                                    <tr><td>Product's gender</td>
                                        <td><input type='text' name='editGender' value="<?php echo $row[9] ?>"></td></tr>

                                    <tr><td>Product's category (handbag or backpack)</td>
                                        <td><input type='text' name='editCat' value="<?php echo $row[10] ?>"></tr>
                                    <tr><td>Product's description</td>
                                        <td><textarea rows='4' cols='50' name='editDes'><?php echo $row[3] ?></textarea></tr>
                                    <tr>

                                    <tr>
                                    <td>Product's Brand:</td>
                                    <td><select name='brand' required>
                                            <?php
                                            $brandGet = "select * from brand";
                                            $brandRes = mysqli_query($link, $brandGet);
                                            while ($row_ = mysqli_fetch_row($brandRes)) {
                                                ?>
                                                <option value='<?php echo $row_[0] ?>'><?php echo $row_[1] ?></option> 
                                                <?php

                                                } 
                                                    echo "<script>$('[name=brand]').val('".$row[11]."');</script>";
                                                ?>
                                        </select></td>
                                    </tr>
                                    <tr><td>Product's Material</td>
                                        <td><input type='text' name='editMaterial' value="<?php echo $row[12] ?>"></tr>
                                    <tr><td>Product's Detail</td>
                                        <td><input type='text' name='editDetail' value="<?php echo $row[13] ?>"></tr>
                                    <tr><td>Product's detail size</td>
                                        <td><input type='text' name='editDetailSize' value="<?php echo $row[14] ?>"></tr>
                                    <tr><td>Product's Strap Material</td>
                                        <td><input type='text' name='editStrapMaterial' value="<?php echo $row[15] ?>"></tr>
                                    <tr><td>Product's Strap Length</td>
                                        <td><input type='text' name='editStrapLength' value="<?php echo $row[16] ?>"></tr>
                                    <tr><td>Product's Zip Type</td>
                                        <td><input type='text' name='editZipType' value="<?php echo $row[17] ?>"></tr>
                                    <tr><td>Product's Slot Num</td>
                                        <td><input type='text' name='editSlotNum' value="<?php echo $row[18] ?>"></tr>
                                    <tr><td>Product's Simple Size</td>
                                        <td><input type='number' name='editSimpleSize' value="<?php echo $row[19] ?>"></tr>
                                    <tr><td>Product's Style</td>
                                        <td><input type='number' name='editStyle' value="<?php echo $row[20] ?>"></tr>
                                    <td><input type='submit' name='imgChange1' value='Click here to change products image 1_1'></td>
                                    </tr>
                                    <tr>
                                        <td><input type='submit' name='imgChange2' value='Click here to change products image 1_2'></td>
                                    </tr>
                                    <tr>
                                        <td><input type='submit' name='imgChange3' value='Click here to change products image 1_3'></td>
                                    </tr>
                                    <tr>
                                        <td><input type='submit' name='imgChange4' value='Click here to change products image 1_4'></td>
                                    </tr>
                                    <tr><td><input type='submit' name='btnEdit' value='Edit' id="btn_edit"></td></tr>
                                </tbody>
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
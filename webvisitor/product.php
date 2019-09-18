<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Products</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/styling.css">
        <script src="../js/jquery-3.3.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/search.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <style>
            .showSearch li:hover, .selected{
                background-color: whitesmoke;
            }
            .showSearch{
                background-color: #d2a9a9;
                left: 16%;
            }
            .showSearch li{
                width: 400px;
            }
            .li_sort{
                width: 130px;
                padding: 10px 0;
                cursor: pointer;
            }
            .li_sort a:hover{
                text-decoration: none;
            }
            .li_sort a{
                color: black;
            }
            .sort-hidden{
                display: none;
            }
            .sort-show{
                display: block;
            }
            .active-category{
                font-weight: bold;
            }
            .sort-show li:hover{
                background-color: darkgray;
            }
            .div-product-thumbnail>.product_thumbnail{
                position: relative;
            }

            .img-responsive{
                opacity: 1;
                display: block;
                height: auto;
                transition: .5s ease;
                backface-visibility: hidden;
            }
            .div-product-thumbnail>.product_thumbnail>.show-view-image-product{
                position: absolute; 
                top: 50%; 
                left: 50%;
                font-size: 16px; 
                opacity: 0;
                transition: .5s ease; 
                transform: translate(-50%, -50%);
                -ms-transform: translate(-50%, -50%);
            }
            .product_thumbnail:hover .img-responsive{
                opacity: 0.2;
            }
            .product_thumbnail:hover .show-view-image-product{
                opacity: 1;
            }

            .show-view-image-product a{
                text-decoration: none;
            }
            .product_search div{
                width: 70%;
                margin: auto;
            }
            .product_search input:first-child{
                width: 400px;
                display: inline-block;
            }
            .btn{
                vertical-align: unset;
            }
            .category-product a{
                padding: 10px 15px;
                display: block;
                text-decoration: none;
                border: 1px solid #ddd;
                border-top-left-radius: 4px;
                border-top-right-radius: 4px;
            }
            .back-to-top {
                cursor: pointer;
                position: fixed;
                bottom: 20px;
                right: 20px;
                display:none;
            }
        </style>
    </head>

    <body>
        <nav class="navbar navbar-static-top top-nav">
            <div class="container">
                <div class="navbar-header">
                    <a href="Main.php" class="navbar-brand" style="text-shadow: 2px 2px 2px;">BagBagOnlineShop</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="Main.php"><span class="glyphicon glyphicon-home"></span><b> Home</b></a></li>
                    <li><a href="product.php?category=all&sort=1"><b>Products</b></a></li>
                    <li><a href="contact.php"><b>Contact</b></a></li>
                    <li><a href="aboutus.php"><b>About us</b></a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php
                    if (isset($_SESSION['username'])) {
                        $name = $_SESSION['username'];
                        echo '<li style = "margin-right:50px;"><a href = "shopping_cart.php"><span class = "fa fa-cart-plus"</a></li>';
                        echo "<li><a href='customer_info.php'><span class='glyphicon glyphicon-user'></span> $name</a></li> ";
                        echo "<li><a href='../webvisitor/user_logout.php'><span class='glyphicon glyphicon-off'></span> Log out</a></li>";
                    } else {
                        echo "<li style = 'margin-right:50px;'><a href = 'shopping_cart.php'><span class = 'fa fa-cart-plus'> <span class='badge' id='cart'></span></span></a></li>";
                        echo '<li><a href="../webvisitor/TestRegister.php"><span class="glyphicon glyphicon-user"></span> Sign up</a></li>';
                        echo '<li><a href="../webvisitor/TestLogin.php"><span class="glyphicon glyphicon-log-in"></span> Sign in</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-md-1 col-xs-1 col-lg-1"></div>
                <div class="col-md-10 col-xs-10 col-lg-10">
                    <form action="product_search.php" class="form-group product_search" method="get" onsubmit="return hasSelected();" autocomplete="off">
                        <div>
                            <input type="text" name="search-key" id="searchBox" class="form-control" placeholder="Search">
                            <input type="submit" value="Search" class="btn btn-success" id="searchBtn">
                        </div>
                    </form>
                    <div class="row" id="result"></div>
                </div>
                <div class="col-md-1 col-xs-1 col-lg-1"></div>
            </div>
        </div>

        <div class="container">
            <?php
            require_once '../database/databaseConnect.php';
            require_once '../Constants/constants.php';
            $conn = DatabaseConnect::connect();
            $gender = null;
            $category = null;
            $sort = null;
            $query_string = null;


            $pagination_url_request = "";
            $pagination_url_all = "";
            if (isset($_REQUEST["category"]) && isset($_REQUEST["gender"]) && isset($_REQUEST["sort"])) {
                $pagination_url_request = Constants::$PAGINATION_URL_CATEGORY . $_REQUEST["category"] . "&" . Constants::$PAGINATION_URL_GENDER . $_REQUEST["gender"] . "&" . Constants::$PAGINATION_URL_SORT;
                $message = "Catagory & Gender";
            }
            if (isset($_REQUEST["category"])) {
                if (strcasecmp($_REQUEST["category"], "all") == 0) {
                    $message = "All";
                    $pagination_url_request = Constants::$PAGINATION_URL_CATEGORY . "all";
                } else if (strcasecmp($_REQUEST["category"], "backpack") == 0) {
                    $message = "Backpack";
                    $category = Constants::$CATEGORY_BACKPACK;
                    $pagination_url_request = Constants::$PAGINATION_URL_CATEGORY . Constants::$CATEGORY_BACKPACK;
                } else if (strcasecmp($_REQUEST["category"], "handbag") == 0) {
                    $message = "HandBag";
                    $category = Constants::$CATEGORY_HANDBAG;
                    $pagination_url_request = Constants::$PAGINATION_URL_CATEGORY . Constants::$CATEGORY_HANDBAG;
                }
                if ($category != null) {
                    $query_string = Constants::$PRODUCT_CATEGORY . " like '" . $category . "'";
                }
                $pagination_url_all = $pagination_url_request;
            }
            if (isset($_REQUEST["gender"])) {
                if (strcasecmp($_REQUEST["gender"], "men") == 0) {
                    $message = "Men";
                    $gender = Constants::$GENDER_MEN;
                    if (strlen($pagination_url_request) !== 0) {
                        $pagination_url_request .= "&" . Constants::$PAGINATION_URL_GENDER . Constants::$GENDER_MEN;
                    } else {
                        $pagination_url_request .= Constants::$PAGINATION_URL_GENDER . Constants::$GENDER_MEN;
                    }
                } else if (strcasecmp($_REQUEST["gender"], "women") == 0) {
                    $message = "Women";
                    $gender = Constants::$GENDER_WOMEN;
                    if (strlen($pagination_url_request) !== 0) {
                        $pagination_url_request .= "&" . Constants::$PAGINATION_URL_GENDER . Constants::$GENDER_WOMEN;
                    } else {
                        $pagination_url_request .= Constants::$PAGINATION_URL_GENDER . Constants::$GENDER_WOMEN;
                    }
                }
                if ($gender != null) {
                    if ($query_string != null) {
                        $query_string .= " and product_gender like '" . $gender . "'";
                    } else {
                        $query_string .= " product_gender like '" . $gender . "'";
                    }
                }
                $pagination_url_all = $pagination_url_request;
            }
            if (isset($_REQUEST["sort"])) {
                if (strcasecmp($_REQUEST["sort"], Constants::$SORT_PORPULARITY) == 0) {
                    $sort = Constants::$SORT_PORPULARITY;
                    if (strlen($pagination_url_request) !== 0) {
                        $pagination_url_request .= "&" . Constants::$PAGINATION_URL_SORT . Constants::$SORT_PORPULARITY;
                    } else {
                        $pagination_url_request .= Constants::$PAGINATION_URL_SORT . Constants::$SORT_PORPULARITY;
                    }
                } else if (strcasecmp($_REQUEST["sort"], Constants::$SORT_PRICE_LOW_HIGH) == 0) {
                    $sort = Constants::$SORT_PRICE_LOW_HIGH;
                    $query_string .= " order by prod_price ASC";
                    if (strlen($pagination_url_request) !== 0) {
                        $pagination_url_request .= "&" . Constants::$PAGINATION_URL_SORT . Constants::$SORT_PRICE_LOW_HIGH;
                    } else {
                        $pagination_url_request .= Constants::$PAGINATION_URL_SORT . Constants::$SORT_PRICE_LOW_HIGH;
                    }
                } else if (strcasecmp($_REQUEST["sort"], Constants::$SORT_PRICE_HIGH_LOW) == 0) {
                    $sort = Constants::$SORT_PRICE_HIGH_LOW;
                    $query_string .= " order by prod_price DESC";
                    if (strlen($pagination_url_request) !== 0) {
                        $pagination_url_request .= "&" . Constants::$PAGINATION_URL_SORT . Constants::$SORT_PRICE_HIGH_LOW;
                    } else {
                        $pagination_url_request .= Constants::$PAGINATION_URL_SORT . Constants::$SORT_PRICE_HIGH_LOW;
                    }
                }
            }

            if ($query_string != null) {
                if ($category == null && $gender == null) {
                    $getProduct = DatabaseConnect::getResult("select * from products " . $query_string, $conn);
                } else {
                    $getProduct = DatabaseConnect::getResult("select * from products where " . $query_string, $conn);
                }
            } else {
                $getProduct = DatabaseConnect::getResult("select * from products", $conn);
            }

            if ($category == null && $gender == null && $sort == null) {
                $getProduct = DatabaseConnect::getResult("select * from products", $conn);
            }

            DatabaseConnect::closeConnect($conn);
            ?>
            <div class="row">
                <div class="col-md-3 col-lg-3"></div>
                <div class="col-md-9 col-lg-9" align="center" style="margin-bottom: 20px; font-size: 20px;">
                    <?php echo isset($message) ? $message : "ALL" ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-lg-3">
                    <h3 style="color: #A0522D;">Category</h3>
                    <hr>
                </div>
                <div class="col-md-8 col-lg-8">
                    <br>
                    <p style="font-size: 17px; float: left;" id="title-category">
                        <?php
                        if (isset($getProduct)) {
                            echo count($getProduct) . " results";
                        } else {
                            echo "All";
                        }
                        ?>
                    </p>    
                    <?php
                    $sort_title = "";
                    if (isset($_REQUEST["sort"])) {
                        if (strcasecmp($_REQUEST["sort"], Constants::$SORT_PORPULARITY) == 0) {
                            $sort_title = "Porpularity";
                        } else if (strcasecmp($_REQUEST["sort"], Constants::$SORT_PRICE_LOW_HIGH) == 0) {
                            $sort_title = "Price Low To High";
                        } else if (strcasecmp($_REQUEST["sort"], Constants::$SORT_PRICE_HIGH_LOW) == 0) {
                            $sort_title = "Price High To Low";
                        }
                        ?>
                        <div style="float: right;" id="sort-product">
                            <span>Sort By:</span>
                            <div style="border: 1px solid darkgray; float: right; width: 140px;">
                                <span><?= $sort_title ?></span>
                                <span class="glyphicon glyphicon-menu-down" style="float: right;"></span>
                            </div>
                            <div style="position: relative;" >
                                <ul style="list-style: none; margin:0 ; padding: 0; border: 1px solid #f5f5f5; position: absolute;
                                    z-index:1; background-color: #f5f5f5; left: 50px; top: 5px;" class="sort-hidden">
                                    <li class="li_sort"><a href="product.php?<?= $pagination_url_all ?>&sort=1">Porpularity</a></li>
                                    <li class="li_sort"><a href="product.php?<?= $pagination_url_all ?>&sort=2">Price low to high</a></li>
                                    <li class="li_sort"><a href="product.php?<?= $pagination_url_all ?>&sort=3">Price high to low</a></li>
                                </ul>    
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <ul class="list-group" style="list-style-type: none;">
                    <li class="category-product"><a href="product.php?category=all&sort=1">All</a></li>
                    <li class="category-product"><a href="product.php?gender=men&sort=1">Men</a></li>
                    <li class="category-product"><a href="product.php?gender=women&sort=1">Women</a></li>
                    <li class="category-product"><a href="product.php?category=backpack&sort=1">Backpack</a></li>
                    <li class="category-product"><a href="product.php?category=handbag&sort=1">HandBag</a></li>
                </ul>
            </div>

            <div class="col-md-9">
                <?php
                if (isset($getProduct)) {
                    ?>
                    <div class="row list-group" id="Products">
                        <?php
                        $productList = null;
                        $index = null;
                        $count = count($getProduct);
                        $page = 0;
                        if (intdiv($count, Constants::$PAGENUM) > 0 && $count % Constants::$PAGENUM == 0) {  // vua du? so trang
                            $page = intdiv($count, Constants::$PAGENUM);
                        } else if (intdiv($count, Constants::$PAGENUM) > 0 && $count % Constants::$PAGENUM != 0) { // page bi du
                            $page = intdiv($count, Constants::$PAGENUM) + 1;
                        } else {                               // san pham < 6
                            if ($count > 0) {
                                $page = 1;
                            } else {
                                $page = 0;
                            }
                        }


                        if (isset($_REQUEST["page"])) {
                            if (is_numeric($_REQUEST["page"])) {
                                if (!strpos($_REQUEST["page"], ".")) {
                                    if ((int) $_REQUEST["page"] > 0) {
                                        $index = $_REQUEST["page"];
                                    } else {
                                        $index = 1;
                                    }
                                } else {
                                    $index = 1;
                                }
                            } else {
                                $index = 1;
                            }
                        } else {
                            $index = 1;
                        }

                        for ($i = ($index - 1) * Constants::$PAGENUM; $i <= ($index * Constants::$PAGENUM) - 1; $i++) {
                            if (!isset($getProduct[$i])) {
                                break;
                            }
                            $productList = $getProduct[$i]["image"];
                            ?>
                            <div class="item col-lg-6 col-xs-6 div-product-thumbnail" >
                                <div class="thumbnail product_thumbnail">
                                    <img src="../img/<?= $productList ?>" class="img-responsive" alt="Image"/>
                                    <h4 class="list-group-item-heading"><span style="color: #3aa5ab;"><?= $getProduct[$i]["prod_name"] ?></span>
                                    </h4>
                                    <h5 class="list-group-item-text"><?php
                                        $summary = explode(".", $getProduct[$i]["prod_description"]);
                                        echo $summary[0] . "..."
                                        ?></h5>
                                    <div class="show-view-image-product" >
                                        <a href="product_detail.php?product_id=<?= $getProduct[$i]['prod_id'] ?>" style="padding: 16px 26px; background-color: #5450506b; color: white;">View</a>
                                    </div>
                                </div>
                                <br/><br/><br/><br/><br/>
                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <h2 class="price-tag"><?= $getProduct[$i]['prod_price'] ?>$</h2>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <?php
                                        if (isset($_SESSION['username'])) {
                                            ?>
                                            <button type="button" onclick='sendCart(<?php echo $getProduct[$i]['prod_id']; ?>)' class="btn btn-success">Add to cart</button>
                                            <?php
                                        } else {
                                            ?>
                                            <a href='TestLogin.php' class='btn btn-success'>Add to cart</a>
                                        <?php } ?>
                                    </div>
                                </div>

                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="row">
                        <div class="col-lg-2 col-xs-2"></div>
                        <div class="col-lg-2 col-xs-2"></div>
                        <div class="col-lg-8 col-xs-8">
                            <?php
                            if ($index > 0 && $index <= $page) {
                                ?>
                                <ul class="pagination">
                                    <?php
                                    if ($page != 0) {
                                        ?>
                                        <li><a class="previous-isDisabled" href="product.php?page=<?php
                                            echo $index - 1;
                                            if (strcasecmp($pagination_url_request, '') != 0) {
                                                echo '&' . $pagination_url_request;
                                            }
                                            ?>" style="margin-left: 3px;"><</a></li>
                                               <?php
                                               if ($page <= 6) {
                                                   for ($i = 1; $i <= $page; $i++) {
                                                       ?>        
                                                <li class="nav-<?= $i ?>"><a href="product.php?page=<?php
                                                    echo $i;
                                                    if (strcasecmp($pagination_url_request, '') != 0) {
                                                        echo '&' . $pagination_url_request;
                                                    }
                                                    ?>" style="margin-left: 3px;"><?= $i ?></a></li>
                                                                             <?php
                                                                         }
                                                                     } else {

                                                                         if ($index <= 3) {
                                                                             for ($i = 1; $i <= 5; $i++) {
                                                                                 ?>
                                                    <li class="nav-<?= $i ?>"><a href="product.php?page=<?php
                                                        echo $i;
                                                        if (strcasecmp($pagination_url_request, '') != 0) {
                                                            echo '&' . $pagination_url_request;
                                                        }
                                                        ?>" style="margin-left: 3px;"><?= $i ?></a></li>
                                                                                 <?php
                                                                             }
                                                                             ?>
                                                <li class="nav-<?= $index + 3 ?>"><a href="product.php?page=<?php
                                                    echo $i + 3;
                                                    if (strcasecmp($pagination_url_request, '') != 0) {
                                                        echo '&' . $pagination_url_request;
                                                    }
                                                    ?>" style="margin-left: 3px;">...</a></li>
                                                <li class="nav-<?= $i ?>"><a href="product.php?page=<?php
                                                    echo $page;
                                                    if (strcasecmp($pagination_url_request, '') != 0) {
                                                        echo '&' . $pagination_url_request;
                                                    }
                                                    ?>" style="margin-left: 3px;"><?= $page ?></a></li>
                                                                             <?php
                                                                         } else if ($index >= $page - 2) {
                                                                             ?>
                                                <li class="nav-1"><a href="product.php?page=<?php
                                                    echo 1;
                                                    if (strcasecmp($pagination_url_request, '') != 0) {
                                                        echo '&' . $pagination_url_request;
                                                    }
                                                    ?>" style="margin-left: 3px;">1</a></li>
                                                <li class="nav-<?= $index - 3 ?>"><a href="product.php?page=<?php
                                                    echo $i - 3;
                                                    if (strcasecmp($pagination_url_request, '') != 0) {
                                                        echo '&' . $pagination_url_request;
                                                    }
                                                    ?>" style="margin-left: 3px;">...</a></li>

                                                <?php
                                                for ($i = $page - 4; $i <= $page; $i++) {
                                                    ?>
                                                    <li class="nav-<?= $i ?>"><a href="product.php?page=<?php
                                                        echo $i;
                                                        if (strcasecmp($pagination_url_request, '') != 0) {
                                                            echo '&' . $pagination_url_request;
                                                        }
                                                        ?>" style="margin-left: 3px;"><?= $i ?></a></li>
                                                                                 <?php
                                                                             }
                                                                         } else {
                                                                             ?>
                                                <li class="nav-1"><a href="product.php?page=<?php
                                                    echo 1;
                                                    if (strcasecmp($pagination_url_request, '') != 0) {
                                                        echo '&' . $pagination_url_request;
                                                    }
                                                    ?>" style="margin-left: 3px;">1</a></li>
                                                <li class="nav-<?= $index - 3 ?>"><a href="product.php?page=<?php
                                                    echo $i - 3;
                                                    if (strcasecmp($pagination_url_request, '') != 0) {
                                                        echo '&' . $pagination_url_request;
                                                    }
                                                    ?>" style="margin-left: 3px;">...</a></li>             
                                                                                     <?php
                                                                                     for ($i = $index - 1; $i <= $index + 1; $i++) {
                                                                                         ?>
                                                    <li class="nav-<?= $i ?>"><a href="product.php?page=<?php
                                                        echo $i;
                                                        if (strcasecmp($pagination_url_request, '') != 0) {
                                                            echo '&' . $pagination_url_request;
                                                        }
                                                        ?>" style="margin-left: 3px;"><?= $i ?></a></li>
                                                                                 <?php
                                                                             }
                                                                             ?>
                                                <li class="nav-<?= $index + 3 ?>"><a href="product.php?page=<?php
                                                    echo $i + 3;
                                                    if (strcasecmp($pagination_url_request, '') != 0) {
                                                        echo '&' . $pagination_url_request;
                                                    }
                                                    ?>" style="margin-left: 3px;">...</a></li>
                                                <li class="nav-<?= $i ?>"><a href="product.php?page=<?php
                                                    echo $page;
                                                    if (strcasecmp($pagination_url_request, '') != 0) {
                                                        echo '&' . $pagination_url_request;
                                                    }
                                                    ?>" style="margin-left: 3px;"><?= $page ?></a></li>
                                                                             <?php
                                                                         }
                                                                     }
                                                                     ?>
                                        <li><a class="next-isDisabled" href="product.php?page=<?php
                                            echo $index + 1;
                                            if (strcasecmp($pagination_url_request, '') != 0) {
                                                echo '&' . $pagination_url_request;
                                            }
                                            ?>" style="margin-left: 3px;">></a></li> 
                                               <?php
                                           }
                                           echo "<script>$('.nav-" . $index . "').addClass('active')</script>";

                                           if ($page == 1) {
                                               echo "<script>$('.previous-isDisabled').css({'color':'darkgray','cursor':'not-allowed','text-decoration':'none'});</script>";
                                               echo "<script>$('.previous-isDisabled').removeAttr('href');</script>";
                                               echo "<script>$('.next-isDisabled').css({'color':'darkgray','cursor':'not-allowed','text-decoration':'none'});</script>";
                                               echo "<script>$('.next-isDisabled').removeAttr('href');</script>";
                                           } else {
                                               if ($index == 1) {
                                                   echo "<script>$('.previous-isDisabled').css({'color':'darkgray','cursor':'not-allowed','text-decoration':'none'});</script>";
                                                   echo "<script>$('.previous-isDisabled').removeAttr('href');</script>";
                                               }
                                               if ($index == $page) {
                                                   echo "<script>$('.next-isDisabled').css({'color':'darkgray','cursor':'not-allowed','text-decoration':'none'});</script>";
                                                   echo "<script>$('.next-isDisabled').removeAttr('href');</script>";
                                               }
                                           }
                                           ?>
                                </ul>
                                <?php
                            } else {
                                echo '<script>alert("Page not exits")</script>';
                                echo "<script>
                                            $('#title-category').remove();
                                            $('#sort-product').remove();
                                        </script>";
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?> 
                </div>

            </div>
        </div>
    </div>
    <footer class="footer-bottom footer-style">
        <div class="container">

            <div class="row">
                <div class="col-md-5">
                    <p>We are a respectable and reputable resellers, where most of the backpacks and bags will be
                        available. We also pride ourselves in our ability to deliver the best customer experience.</p>
                    <p><span class="glyphicon glyphicon-copyright-mark"></span> 2018 Team. All Rights Reserved</p>

                </div>

                <div class="col-md-4">
                    <h4>Contacts</h4>
                    <dl>
                        <dt>Address:</dt>
                        <dd>590 CMT, HCM</dd>
                    </dl>
                    <dl>
                        <dt>Email:</dt>
                        <dd>jasoncowboy2@gmail.com</dd>
                    </dl>
                    <dl>
                        <dt>Telephone:</dt>
                        <dd>8798793124</dd>
                    </dl>
                </div>
                <div class="col-md-3">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="Main.php">Home</a></li>
                        <li><a href="product.php">Products</a></li>
                        <li><a href="aboutus.html">About us</a></li>
                        <li><a href="contact.html">Contact</a></li>
                        <li><a href="Register.html">Sign up</a></li>
                        <li><a href="Login.html">Sign in</a></li>
                    </ul>

                </div>
            </div>
        </div>
    </footer>
    <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>
    <div class="error"></div>
    <?php
    if (isset($_REQUEST['category'])) {
        if (strcasecmp($_REQUEST['category'], "all") == 0) {
            echo "<script>
                                $('.category-product:first-child').addClass('active'); 
                                $('.active').css('background-color','#97a8b7');
                            </script>";
        }
    }
    if (isset($_REQUEST['gender'])) {
        if (strcasecmp($_REQUEST['gender'], "men") == 0) {
            echo "<script>
                                $('.category-product:nth-child(2)').addClass('active');
                                $('.active').css('background-color','#97a8b7');
                            </script>";
        }
    }
    if (isset($_REQUEST['gender'])) {
        if (strcasecmp($_REQUEST['gender'], "women") == 0) {
            echo "<script>
                                $('.category-product:nth-child(3)').addClass('active');
                                $('.active').css('background-color','#97a8b7');
                            </script>";
        }
    }
    if (isset($_REQUEST['category'])) {
        if (strcasecmp($_REQUEST['category'], "backpack") == 0) {
            echo "<script>
                                $('.category-product:nth-child(4)').addClass('active'); 
                                $('.active').css('background-color','#97a8b7');
                            </script>";
        }
    }
    if (isset($_REQUEST['category'])) {
        if (strcasecmp($_REQUEST['category'], "handbag") == 0) {
            echo "<script>
                                $('.category-product:nth-child(5)').addClass('active'); 
                                $('.active').css('background-color','#97a8b7');
                            </script>";
        }
    }
    ?>
</body>
<script>
    function showSort() {
        $("#sort-product").click(function() {
            if ($(".sort-hidden").hasClass("sort-hidden")) {
                $(".sort-hidden").addClass("sort-show");
                $(".sort-hidden").removeClass("sort-hidden");
            }
            else if ($(".sort-show").hasClass("sort-show")) {
                $(".sort-show").addClass("sort-hidden");
                $(".sort-show").removeClass("sort-show");
            }
        });

        $(document).mouseup(function(e) {
            var container = $("#sort-product");

            // if the target of the click isn't the container nor a descendant of the container
            if (!container.is(e.target) && container.has(e.target).length === 0)
            {
                if (typeof $(".sort-show") !== "underfined") {
                    $(".sort-show").addClass("sort-hidden");
                    $(".sort-show").removeClass("sort-show");
                }
            }
        });
    }

    if (typeof ($("#logout")) != 'undefinded' && $("#logout") !== null) {
        $("#logout").click(function() {
            $.ajax({
                url: "Logout.php",
                method: "post",
                success: function(data) {
                    $('.error').html(data);
                }
            });
        });
    }

    $(window).scroll(function() {
        if ($(this).scrollTop() > 50) {
            $('#back-to-top').fadeIn();
        } else {
            $('#back-to-top').fadeOut();
        }
    });
    // scroll body to 0px on click
    $('#back-to-top').click(function() {
        $('#back-to-top').tooltip('hide');
        $('body,html').animate({
            scrollTop: 0
        }, 800);
        return false;
    });

    $('#back-to-top').tooltip('show');
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
</script>
</html>
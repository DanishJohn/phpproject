<?php
session_start();
include_once '../connect.inc';
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Home Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
        <script src="main.js"></script>
        <link rel="stylesheet" href="../frameworks/css/bootstrap.min.css">
        <link rel="stylesheet" href="../frameworks/css/styling.css" type="text/css">
        <script src="../frameworks/js/jquery-3.3.1.min.js"></script>
        <script src="../frameworks/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>
        <nav class="navbar navbar-static-top top-nav">
            <div class="container">
                <div class="navbar-header">

                    <a href="Main.php" class="navbar-brand" style="text-shadow: 2px 2px 2px">Haven's Bag Shop</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="Main.php"><span class="glyphicon glyphicon-home"></span><b> Home</b></a>
                    </li>
                    <li><a href="product.php"><b>Products</b></a></li>
                    <li><a href="contact.php"><b>Contact</b></a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php
                    if (isset($_SESSION['username'])) {
                        $name = $_SESSION['username'];
                        echo '<li style = "margin-right:50px;"><a href = "shopping_cart.php"><span class = "fa fa-cart-plus"</a></li>';
                        echo "<li><a href='customer_info.php'><span class='glyphicon glyphicon-user'></span> $name</a></li> ";
                        echo "<li><a href='../webvisitor/user_logout.php'><span class='glyphicon glyphicon-off'></span> Log out</a></li>";
                    } else {
                        echo '<li><a href="../webvisitor/TestRegister.php"><span class="glyphicon glyphicon-user"></span> Sign up</a></li>';
                        echo '<li><a href="../webvisitor/TestLogin.php"><span class="glyphicon glyphicon-log-in"></span> Sign in</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </nav>

        <div class="container-fluid home-body">
            <div class="col-md-6 welcome">
                <h1>Haven's Bag shop</h1>
                <p style="font-size:x-large">Welcome to Haven's Bag shop, where various bags products from many
                    prestigious brands
                    around
                    the
                    world, selected suited for you.</p>
                <a href="product.php" class="btn btn-lg btn-primary">Explore the store</a>

            </div>
        </div>
        <div class="container">
            <div class="container">
                <br>
                <center> <h1>Our latest featured Products</h1></center>
                <center><h3>From beyond the valley we bring you our top quality leathers</h3></center> <br>
                <div class="row">
                    <?php
                    $getSixProducts = "select * from products where prod_id <= (select max(prod_id) from products) and prod_id > (select max(prod_id) from products) - 3";
                    $resprod = mysqli_query($link, $getSixProducts);
                    while ($row = mysqli_fetch_row($resprod)) {
                        ?>
                        <div class="item col-lg-4 col-xs-4">
                            <div class="thumbnail">
                                <img src="../img/<?php echo $row[4] ?>" class="img-responsive" alt="Image">
                            </div>
                            <div class="caption">
                                <h4 class="list-group-item-heading"><a href=""><?php echo "$row[1]" ?></a>
                                </h4>                                
                                <h5 class="list-group-item-text"><b>In stock: <?php echo $row[8] ?>   </b><b>User rating: <b>
                                            <?php
                                            $getRating = "select AVG(rating) from product_rating where product_id = $row[0]";
                                            $ratingResult = mysqli_query($link, $getRating);
                                            $rating = mysqli_fetch_row($ratingResult);
                                            echo number_format($rating[0], 2);
                                            if ($rating[0] == NULL) {
                                                for ($i = 0; $i < 5; $i++) {
                                                    echo "<span class='fa fa-star-o'></span>";
                                                }
                                            } else if (($rating[0] - 0.5 <= floor($rating[0])) || ($rating[0] - 0.5 >= floor($rating[0]))) {
                                                $rated = floor($rating[0]);
                                                for ($i = 0; $i < $rated; $i++) {
                                                    echo "<span class='fa fa-star checked'></span>";
                                                }
                                                echo "<span class='fa fa-star-half-full checked'></span>";
                                                for ($i = $rated + 1; $i < 5; $i++) {
                                                    echo "<span class='fa fa-star-o'></span>";
                                                }
                                            }
                                            ?>
                                            </h5>
                                            <div class="row">
                                                <div class="col-xs-12 col-md-6">
                                                    <h2 class="price-tag">$<?php echo $row[2]; ?></h2>
                                                </div>
                                                <div class="col-xs-12 col-md-6">
                                                    <?php
                                                    if (isset($_SESSION['username'])) {
                                                        ?>
                                                        <button onclick='sendCart(<?php echo $row[0] ?>)' class="btn btn-success">Add to cart</button>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <a href='TestLogin.php' class='btn btn-success'>Add to cart</a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            </div>
                                            </div>

                                        <?php } ?>
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
                                                            <li><a href="Home.html">Home</a></li>
                                                            <li><a href="producMain.html">Products</a></li>
                                                            <li><a href="aboutus.html">About us</a></li>
                                                            <li><a href="contact.html">Contact</a></li>
                                                            <li><a href="Register.html">Sign up</a></li>
                                                            <li><a href="Login.html">Sign in</a></li>
                                                        </ul>

                                                    </div>
                                                </div>


                                            </div>

                                        </footer>



                                        </body>
                                        <script>

                                            function sendCart(id) {
                                                $.ajax({
                                                    type: 'GET',
                                                    url: 'shopping_cart.php?id=' + id,
                                                    success: function(data) {
                                                        alert("Item successfully added");
                                                    },
                                                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                                                        alert("Stock limit reached. Please order other items");
                                                    }
                                                })
                                            }
                                        </script>

                                        </html>
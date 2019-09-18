<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>About us</title>
        <link rel="stylesheet" href="../frameworks/css/bootstrap.min.css">
        <link rel="stylesheet" href="../frameworks/css/styling.css">
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>

    <body>
        <nav class="navbar navbar-static-top top-nav">
            <div class="container">
                <div class="navbar-header">

                    <a href="Home.html" class="navbar-brand" style="text-shadow: 2px 2px 2px">Haven's Bag Shop</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="Home.html"><span class="glyphicon glyphicon-home"></span><b> Home</b></a></li>
                    <li><a href="producMain.html"><b>Products</b></a></li>
                    <li><a href="contact.php"><b>Contact</b></a></li>
                    <li class="active"><a href="aboutus.php"><b>About us</b></a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php
                    if (isset($_SESSION['registered_user'])) {
                        $name = $_SESSION['registered_user'];
                        echo "<li><a href=''><span class='glyphicon glyphicon-user'></span> $name</a></li> ";
                        echo "<li><a href='../webvisitor/user_logout.php'><span class='glyphicon glyphicon-off'></span> Log out</a></li>";
                    } else {
                        echo '<li><a href="../webvisitor/TestRegister.php"><span class="glyphicon glyphicon-user"></span> Sign up</a></li>';
                        echo '<li><a href="../webvisitor/TestLogin.php"><span class="glyphicon glyphicon-log-in"></span> Sign in</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </nav>
        <div class="jumbotron jumbo-background">
            <div class="container">
                <h1>About us</h1>
                <p>
                    We are a respectable and reputable resellers, where most of the backpacks and bags will be available.
                    We also pride ourselves in our ability to deliver the best customer experience.
                </p>
            </div>
        </div>
        <div class="container">
            <div id="team" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#team" data-slide-to="0" class="active"></li>
                    <li data-target="#team" data-slide-to="1" class=""></li>
                    <li data-target="#team" data-slide-to="2" class=""></li>
                </ol>
                <div class="carousel-inner">
                    <div class="item active">
                        <img alt="First slide" src="images/S1.jpg">
                    </div>
                    <div class="item">
                        <img data-src="" alt="Second slide" src="images/S2.jpg">
                    </div>
                    <div class="item">
                        <img alt="Third slide" src="images/S3.jpg">
                    </div>
                </div>
                <a class="left carousel-control" href="#team" data-slide="prev"><span
                        class="glyphicon glyphicon-chevron-left"></span></a>
                <a class="right carousel-control" href="#team" data-slide="next"><span
                        class="glyphicon glyphicon-chevron-right"></span></a>
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

</html>
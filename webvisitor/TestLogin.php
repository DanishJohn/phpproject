<?php
if (session_status() == PHP_SESSION_ACTIVE) {
    session_destroy();
}
session_start();
include_once '../connect.inc';

if (isset($_SESSION['register_success'])) {
    $successmsg = $_SESSION['register_success'];
    echo "<script>";
    echo "alert(\"$successmsg\")";
    echo "</script>";
    unset($_SESSION['register_success']);
}
if (isset($_SESSION['password_recovery'])) {
    $recoverymsg = $_SESSION['password_recovery'];
    echo "<script>";
    echo "alert(\"$recoverymsg\")";
    echo "</script>";
}

if (isset($_POST["btnOk"])) {
    $user = $_POST["txtUser"];
    $pass = $_POST["txtPass"];


    $sql1 = "select * from customer where customer_username = '$user'";

    $result1 = mysqli_query($link, $sql1);

    if (mysqli_errno($link)) {
        echo mysqli_error($link);
        exit();
    }
    if (mysqli_num_rows($result1) > 0) {

        $row = mysqli_fetch_row($result1);

        if ($row[1] == $pass && $row[5] == 1) {
            $_SESSION['username'] = $row[0];
            header("location: ../webvisitor/Main.php");
        } else if ($row[1] == $pass && $row[5] == 0) {
            echo "<script>";
            echo "alert(\"Your account has been disabled\")";
            echo "</script>";
        } else {
            echo "<script>";
            echo "alert(\"Your password is incorrect\")";
            echo "</script>";
        }
    } else {
        echo "<script>";
        echo "alert(\"Your id is either incorrect or does not exist\")";
        echo "</script>";
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../frameworks/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href='../frameworks/css/styling.css' rel='stylesheet' type='text/css'/>
        <script src='../frameworks/js/bootstrap.min.js'></script>
    </head>
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
                <li><a href="producMain.html"><b>Products</b></a></li>
                <li><a href="contact.php"><b>Contact</b></a></li>
                <li><a href="aboutus.php"><b>About us</b></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right"><?php
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
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <form id="login-form" class="formreg1" method="POST">

                    <h3 class="text-center text-info">Login</h3>
                    <div class="form-group login" style="margin-left:15px; margin-right:15px">
                        <label for="username">Username:</label>
                        <input type="text" name="txtUser" class="form-control" required>
                    </div>
                    <div class="form-group login" style="margin-left:15px;margin-right:15px;">
                        <label for="password" class="login">Password:</label>
                        <input type="password" name="txtPass" class="form-control login" required>
                    </div>
                    <div class="form-group" style="margin-left:10px">
                        <span><input id="remember-me" name="remember-me" type="checkbox"></span><label for="remember-me"
                                                                                                       class="login"><span style="margin-left:15px">Remember me</span></label>
                        <span class="psw">Forgot <a href="ForgetPass.php">password?</a></span> <br><br>
                        <input type="submit" name="btnOk" class="btn btn-info btn-md" value="Submit"
                               style="margin-left: 30%">
                        <input type="reset" value="Reset" name="btnReset" class="btn btn-info btn-md"
                               style="margin-left: 10%">
                    </div>
                </form>
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
</script>
</html>

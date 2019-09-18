<?php
include_once '../connect.inc';
require '../frameworks/PHPMailer.php';
require '../frameworks/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
session_start();

if (isset($_GET["btnOk"]) == true) {
    $user = $_GET["txtUser"];
    $email = $_GET["txtEmail"];

    $sql1 = "select customer_username, customer_password, customer_email from customer where customer_username = '$user'";

    $result1 = mysqli_query($link, $sql1);

    $row = mysqli_fetch_row($result1);

    if (mysqli_num_rows($result1) == TRUE) {
        if ($row[0] == $user && $row[2] == $email) {
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = "jasoncowboy2@gmail.com";
            $mail->Password = "anhemtoi517544";
            $mail->setFrom("jasoncowboy2@gmail.com", "Admin");
            $mail->addAddress("$email");

            $mail->isHTML(true);
            $mail->Subject = "Password Recovery";
            $mail->Body = "Thank you for using Haven Bag Shop. Your password for login into our site is: $";
            $_SESSION['password_recovery'] = "Your password has already been sent to your e-mail";
            header("location:TestLogin.php");
        } else {
            echo "<script>";
            echo "alert(\"This Email does not exist in our database !!!\")";
            echo "</script>";
        }
    } else {
        echo "<script>";
        echo "alert(\"This user id does not exist in our database !!!\")";
        echo "</script>";
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/styling.css" rel="stylesheet" type="text/css"/>
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>

    </head>
    <body>
        <div class="container">
            <nav class="navbar navbar-static-top top-nav">
                <div class="container">
                    <div class="navbar-header">

                        <a  class="navbar-brand" style="text-shadow: 2px 2px 2px">BagBagOnlineShop</a>
                    </div>
                    <ul class="nav navbar-nav">
                        <li><a ><span class="glyphicon glyphicon-home"></span><b> Home</b></a></li>
                        <li><a ><b>Products</b></a></li>
                        <li><a ><b>Contact</b></a></li>
                        <li><a ><b></b></a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a ><span class="glyphicon glyphicon-user"></span> Sign up</a></li>
                        <li><a ><span class="glyphicon glyphicon-log-in"></span> Sign in</a></li>
                    </ul>
                </div>
            </nav>
            <div class="container">
                <form class="form-horizontal">
                    <h2 class="form-heading" style="margin-bottom:15px;">Forget Password</h2>
                    <div class="form-group">
                        <label for="Username" class="col-sm-3 control-label">Customer Username</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="Username" class="form-control" name="txtUser" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-3 control-label">Email </label>
                        <div class="col-sm-9">
                            <input type="email" name="txtEmail" placeholder="Email" class="form-control" pattern="^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-z]{3,}$" required>
                        </div>
                    </div>
                    <button type="submit" name="btnOk" class="btn btn-primary btn-block">Submit</button>
                </form> 
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
                            <li><a >Home</a></li>
                            <li><a >Products</a></li>
                            <li><a >About us</a></li>
                            <li><a >Contact</a></li>
                            <li><a >Sign up</a></li>
                            <li><a >Sign in</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>

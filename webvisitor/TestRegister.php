<?php
session_start();
include_once '../connect.inc';
if (isset($_GET["btnOk"]) == true) {
    $user = $_GET["txtUser"];
    $pass = $_GET["txtPass"];
    $fullname = $_GET["txtUser2"];
    $email = $_GET["txtEmail"];
    $phone = $_GET["txtPhone"];
    $gender = $_GET["txtGen"];
    $dob = $_GET["txtDOB"];

    $sql2 = "Select * from customer where customer_email = '$email'";
    $result2 = mysqli_query($link, $sql2);
    if (mysqli_num_rows($result2) == 0) {
        $sql = "INSERT INTO customer (customer_username, customer_password, customer_name, customer_email, customer_mobile, customer_status, customer_gender, customer_dob) VALUES ('$user','$pass','$fullname','$email','$phone',1,'$gender','$dob')";
        $result = mysqli_query($link, $sql);
        if ($result === TRUE) {
            $_SESSION['register_success'] = "Your account registration is successful.";
            header("location:TestLogin.php");
        } else {
            echo "<script>";
            echo "alert(\"ID already exist !!!\")";
            echo "</script>";
        }
    } else {
        echo "<script>";
        echo "alert(\"Email already exist !!!\")";
        echo "</script>";
    }
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="../frameworks/js/bootstrap.min.js " type="text/javascript"></script>
        <link href="../frameworks/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../frameworks/css/styling.css" rel="stylesheet" type="text/css"

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
        <div class="container" style="width: 600px; border: solid">
            <form class="form-horizontal">
                <h2 class="form-heading" style="margin-bottom:15px;">Registration</h2>
                <div class="form-group">
                    <label for="Username" class="col-sm-3 control-label">Customer Username</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Username" pattern="^[a-zA-Z0-9][a-zA-Z0-9 ]{3,255}[a-zA-Z0-9]$" class="form-control" name="txtUser" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Password</label>
                    <div class="col-sm-9">
                        <input type="password" name="txtPass" placeholder="Password" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Username" class="col-sm-3 control-label">Customer Full Name</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Username" class="form-control" name="txtUser2" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="birthDate" class="col-sm-3 control-label">Date of Birth</label>
                    <div class="col-sm-9">
                        <input type="date" id="birthDate" class="form-control" name="txtDOB" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email </label>
                    <div class="col-sm-9">
                        <input type="email" name="txtEmail" placeholder="Email" class="form-control" pattern="^[a-zA-Z0-9]{3,}@[a-zA-Z]{2,}\.[a-z]{2,3}$" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="phoneNumber" class="col-sm-3 control-label">Phone number </label>
                    <div class="col-sm-9">
                        <input type="number"  placeholder="Phone number" name="txtPhone" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Gender</label>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="radio-inline">
                                    <input type="radio" name="txtGen" value="0">Female
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="radio-inline">
                                    <input type="radio" name="txtGen" value="1">Male
                                </label>
                            </div>
                        </div>
                    </div>
                </div> 
                <button type="submit" name="btnOk" style="width: 200px; margin-left: auto; margin-right: auto" class="btn btn-primary btn-block">Sign Up</button>
            </form> 
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

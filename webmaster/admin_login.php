<?php
session_start();
include_once '../connect.inc';
if (isset($_POST['btnLog'])) {
    $auser = $_POST['admin_id'];
    $apass = $_POST['admin_pass'];
    $sql2 = "select * from admin where admin_username = '$auser'";

    $result2 = mysqli_query($link, $sql2);

    if (mysqli_errno($link)) {
        echo mysqli_error($link);
        exit();
    }

    if (mysqli_num_rows($result2) == 0) {
        echo "<script> alert(\"Invalid username\") </script>";
    } else {

        $row = mysqli_fetch_row($result2);


        if ($row[1] == $apass && $row[2] == 1) {
            $_SESSION['registered_admin'] = $row[0];
            header("location: admin_dashboard.php");
        } else if ($row[1] == $apass && $row[2] == 0) {
            $_SESSION['registered_webmaster'] = $row[0];
            header("location: webmaster/webmaster_dashboard");
        } else {
            echo "<script>";
            echo "alert(\"Your password is incorrect\")";
            echo "</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Administrator Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--===============================================================================================-->	
        <link rel="icon" type="image/png" href="../frameworks/images/icons/favicon.ico"/>
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../frameworks/vendor/bootstrap/css/bootstrap.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../frameworks/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../frameworks/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../frameworks/vendor/animate/animate.css">
        <!--===============================================================================================-->	
        <link rel="stylesheet" type="text/css" href="../frameworks/vendor/css-hamburgers/hamburgers.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../frameworks/vendor/animsition/css/animsition.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../frameworks/vendor/select2/select2.min.css">
        <!--===============================================================================================-->	
        <link rel="stylesheet" type="text/css" href="../frameworks/vendor/daterangepicker/daterangepicker.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../frameworks/css/util.css">
        <link rel="stylesheet" type="text/css" href="../frameworks/css/main.css">
        <link rel="stylesheet" type="text/css" href='../frameworks/css/styling.css'>
        <script src='../frameworks/js/bootstrap.min.js'></script>
        <!--===============================================================================================-->
    </head>
    <body>
        <div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
                    <form class="login100-form validate-form" method="POST">
                        <span class="login100-form-title p-b-33">
                            Admin Login
                        </span>

                        <div class="wrap-input100">
                            <input class="input100" type="text" name="admin_id" placeholder="UserID">
                            <span class="focus-input100-1"></span>
                            <span class="focus-input100-2"></span>
                        </div>

                        <div class="wrap-input100 rs1 validate-input" data-validate="Password is required">
                            <input class="input100" type="password" name="admin_pass" placeholder="Password">
                            <span class="focus-input100-1"></span>
                            <span class="focus-input100-2"></span>
                        </div>

                        <div class="container-login100-form-btn m-t-20">
                            <button class="login100-form-btn" name='btnLog'>
                                Sign in
                            </button>
                        </div>
                        <div class="text-center p-t-45 p-b-4">
                            <a href="../webvisitor/Main.php" class="txt2 hov1">
                                Shop's Homepage
                            </a>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
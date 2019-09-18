<?php

include_once '../frameworks/PHPMailer.php';
include_once '../frameworks/SMTP.php';
include_once '../frameworks/Exception.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


session_start();
if (!isset($_SESSION['registered_admin'])) {
    header("location: admin_login.php");
}
include_once '../connect.inc';
if (isset($_POST['btnSub'])) {
    $feedbackid = $_GET['id'];
    $adminid = $_POST['admin-id'];
    $repDetails = $_POST['reply-details'];
    $repDate = $_POST['reply-date'];
    $email = $_GET['email'];
    $updateReply = "update feedback set reply_detail = '$repDetails', admin_id_reply = '$adminid', reply_date = '$repDate', reply_status = 'replied' where feedback_id = $feedbackid";
    if (mysqli_query($link, $updateReply)) {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "jasoncowboy2@gmail.com";
        $mail->Password = "anhemtoi517544";
        $mail->setFrom("jasoncowboy2@gmail.com", "Admin $adminid");
        $mail->addAddress("$email");

        $mail->isHTML(true);
        $mail->Subject = "Feedback from Haven Bag Shop";
        $mail->Body = "$repDetails";
        $mail->send();
        header("location: admin_feedback.php");
    } else {
        echo "<script>alert(\"Unable to send reply\") </script>";
    }
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
                    <div class='card text-white bg-dark mb-3'>
                        <div class='card-title'> <h1>Admin Reply form</h1></div>
                        <div class='card-body'>

                        </div>
                    </div>
                    <form method="POST">
                        <table class='table table-sm'>
                            <tr>
                                <td>Admin's ID:</td>
                                <td><input type="text" readonly value='<?php echo $_SESSION['registered_admin']; ?>' name='admin-id'></td>
                            </tr>
                            <tr>
                                <td>Reply's detail</td>
                                <td><textarea cols="60" rows="8" name='reply-details'></textarea></td>
                            </tr>
                            <tr>
                                <td>Reply's date</td>
                                <td><input id="toDay" type='date' name='reply-date'></td>
                            </tr>
                            <tr>
                                <td><input type='submit' onclick="return confirm('Do you want to confirm your reply submission?')" name='btnSub' value='Send Reply' required></td>
                            </tr>
                        </table>
                    </form>

                </div>
            </div>
            <!-- /#page-content-wrapper -->

        </div>
        <!-- /#wrapper -->



<script>
    document.getElementById("toDay").valueAsDate = new Date();
</script>
    </body>

</html>
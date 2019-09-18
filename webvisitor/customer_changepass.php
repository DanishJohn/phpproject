<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer_Edit</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styling.css">
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <!--
        #
        # Thu vien de add datepicker cho IE (type = date khong dung duoc trong IE)
        #
    -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.js"></script>
    <script src="../js/register-validate.js"></script>

    <style>
        .error{
            color:red;
        }
        .form-group{
            margin-bottom: 30px;
        }
        #firstName-error, #lastName-error, #username-error, #email-error, #password-error, #cpassword-error, #gender-error{
            position: absolute;
        }
        .customer_info{
            margin-top: 50px;
        }

    </style>

    <script>
      $( function() {
        $( "#birthDate" ).datepicker({
            dateFormat: 'yy-mm-dd'
        });
      } );
     </script>
    <?php 
        session_start();
        require_once '../database/databaseConnect.php';
        require_once '../Constants/constants.php';
        if(!isset($_SESSION['username'])){
            header('location: Main.php');
        }
        $conn = DatabaseConnect::connect();
        if($conn != null){
            $getCustomer_Result = DatabaseConnect::getResult(Constants::$SELECT_ALL_CUSTOMER." where customer_username like '".$_SESSION["username"]."'", $conn); 
        }
    ?>
</head>

<body>
    <nav class="navbar navbar-static-top top-nav">
        <div class="container">
            <div class="navbar-header">

                <a href="Main.php" class="navbar-brand" style="text-shadow: 2px 2px 2px">Haven's Bag Shop</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="Main.php"><span class="glyphicon glyphicon-home"></span><b> Home</b></a></li>
                <li><a href="product.php"><b>Products</b></a></li>
                <li><a href="contact.php"><b>Contact</b></a></li>
                <li><a href="aboutus.php"><b></b></a></li>
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
    <div class="container customer_info">
        <div class="col-sm-4">
            <div class="list-group">
                <a href="customer_info.php" class="list-group-item list-group-item-action active">My Profile</a>
                <a href="#" class="list-group-item list-group-item-action">My Orders</a>
                <a href="#" class="list-group-item list-group-item-action">My Reviews</a>
                <a href="#" class="list-group-item list-group-item-action">My Wishlist</a>
            </div>
        </div>
        <div class="col-sm-8">
            <form class="form-horizontal" role="form" id="form-register" style="margin: 0; width: 100%;" action="customer_excuteUpdate.php" method="post">
                <h2 class="form-heading" style="margin-bottom:15px;">My Profile</h2>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Enter Recent Password</label>
                    <div class="col-sm-9">
                        <input type="text" id="oldpassword" placeholder="oldpassword" class="form-control" name= "oldpassword">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Enter New Password</label>
                    <div class="col-sm-9">
                        <input type="password" id="password" placeholder="Password" class="form-control" name="password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Enter Confirm Password</label>
                    <div class="col-sm-9">
                        <input type="password" id="cpassword" placeholder="Password" class="form-control" name="cpassword">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block btnUpdate">Save Changes</button>
            </form> 
            <?php 
                if(isset($_SESSION[Constants::$STATUS_ERROR_CHANGEPASSWORD])){
                    if(!is_null($_SESSION[Constants::$STATUS_ERROR_CHANGEPASSWORD])){
                        echo "<script>alert('".$_SESSION[Constants::$STATUS_ERROR_CHANGEPASSWORD]."')</script>";
                    }
                    unset($_SESSION[Constants::$STATUS_ERROR_CHANGEPASSWORD]);
                }
             ?>
        </div>
    </div> 
    <footer class="footer-bottom footer-style" style="position: fixed; bottom: 0; left: 0; width: 100%;">
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
        <div class="error"></div>
</body>
<script>
    if(typeof($("#logout")) != 'undefinded' && $("#logout") !== null){
            $("#logout").click(function(){
                $.ajax({
                    url: "Logout.php",
                    method: "post",
                    success:function(data){
                        $('.error').html(data);
                    }
                });
            }); 
        }
</script>
</html>

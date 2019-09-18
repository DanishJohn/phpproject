<?php
session_start();
if (!isset($_SESSION['registered_admin'])) {
    header("location:../TestLogin.php");
}
require_once '../connect.inc';
$id = $_GET['prodlist'];
$imgGet = "";

if(isset($_POST['submit'])){
    $string = "";
    $store = "";

    if(isset($_REQUEST['image'])){
        if(!isset($_SESSION['imgChange1'])){
            $string .= "&image=".$_REQUEST['image'];
        }
    }

    if(isset($_REQUEST['image_2'])){
        if(!isset($_SESSION['imgChange2'])){
            $string .= "&image_2=".$_REQUEST['image_2'];
        }
    }

    if(isset($_REQUEST['image_3'])){
        if(!isset($_SESSION['imgChange3'])){
            $string .= "&image_3=".$_REQUEST['image_3'];
        }
    }
    
    if(isset($_REQUEST['image_4'])){
        if(!isset($_SESSION['imgChange4'])){
            $string .= "&image_4=".$_REQUEST['image_4'];
        }
    }

    // //Check file size
    if(strlen(pathinfo($_FILES["fileUpload"]["name"],PATHINFO_BASENAME)) > 0){
        if(isset($_REQUEST['image'])){
            if(isset($_SESSION['imgChange1'])){
                $string .= "&image=".pathinfo($_FILES["fileUpload"]["name"],PATHINFO_BASENAME);
                unset($_SESSION['imgChange1']);    
            }
        }
        if(isset($_REQUEST['image_2'])){
            if(isset($_SESSION['imgChange2'])){
                $string .= "&image_2=".pathinfo($_FILES["fileUpload"]["name"],PATHINFO_BASENAME);
                unset($_SESSION['imgChange2']);    
            }
        }
        if(isset($_REQUEST['image_3'])){
            if(isset($_SESSION['imgChange3'])){
                $string .= "&image_3=".pathinfo($_FILES["fileUpload"]["name"],PATHINFO_BASENAME);
                unset($_SESSION['imgChange3']);    
            }    
        }
        if(isset($_REQUEST['image_4'])){
            if(isset($_SESSION['imgChange4'])){
                $string .= "&image_4=".pathinfo($_FILES["fileUpload"]["name"],PATHINFO_BASENAME);
                unset($_SESSION['imgChange4']);    
            }
        }
        header("location: admin_edit.php?prodlist=$id".$string);
        exit;
    }
    else{
        if(isset($_REQUEST['image'])){
            $store .= "&image=".$_REQUEST['image'];
            $_SESSION['error_upload'] = "";
            unset($_SESSION['imgChange1']);    
        }
        if(isset($_REQUEST['image_2'])){
            $store .= "&image_2=".$_REQUEST['image_2'];
            $_SESSION['error_upload'] = "";    
            unset($_SESSION['imgChange2']);
        }
        if(isset($_REQUEST['image_3'])){
            $store .= "&image_3=".$_REQUEST['image_3'];
            $_SESSION['error_upload'] = "";
            unset($_SESSION['imgChange3']);    
        }
        if(isset($_REQUEST['image_4'])){
            $store .= "&image_4=".$_REQUEST['image_4'];
            $_SESSION['error_upload'] = "";
            unset($_SESSION['imgChange4']);    
        }
        header("location: admin_edit.php?prodlist=$id".$store);
        exit;
    }
}

if(isset($_REQUEST["image"])){
    if(isset($_SESSION['imgChange1'])){
        $imgGet = "select image from products where prod_id = $id";    
    }
}
if(isset($_REQUEST["image_2"])){
    if(isset($_SESSION['imgChange2'])){
        $imgGet = "select image_2 from products where prod_id = $id";        
    }
}
if(isset($_REQUEST["image_3"])){
    if(isset($_SESSION['imgChange3'])){
        $imgGet = "select image_3 from products where prod_id = $id";        
    }    
}
if(isset($_REQUEST["image_4"])){
    if(isset($_SESSION['imgChange4'])){
        $imgGet = "select image_4 from products where prod_id = $id";        
    }       
}
$getID = "select prod_id from products where prod_id = $id";
$imgRes = mysqli_query($link, $imgGet);
$row = mysqli_fetch_row($imgRes);
$idRow = mysqli_fetch_row(mysqli_query($link, $getID));
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
        <script src="../js/jquery-3.3.1.min.js"></script>

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
                    <div class='card text-white bg-dark mb-3'>
                        <div class='card-title'> <h1>Product <?php echo $id ?> image change</h1></div>
                        <div class='card-body'>
                            <img src='../img/<?php echo $row[0] ?>' style= "display: block; width: 50%; height: 300px;">
                        </div>
                    </div>
                    <form method="post" enctype="multipart/form-data">
                        Select image to upload:
                        <input type="file" name="fileUpload" class="change_image">
                        <input type="submit" value="Upload Image" name="submit">
                    </form>
                </div>
            </div>
            <!-- /#page-content-wrapper -->

        </div>
        <!-- /#wrapper -->


<script>
    $(".change_image").change(function(){
        $("img").attr('src','../img/'+$(this).val().split('\\').pop());
    });
</script>

    </body>

</html>
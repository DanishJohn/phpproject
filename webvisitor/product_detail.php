<?php  
    require_once '../database/databaseConnect.php';
    require_once '../Constants/constants.php';
    session_start();
    $conn = DatabaseConnect::connect();
    if(isset($_REQUEST["product_id"])){
        $getProduct =DatabaseConnect::getResult("select * from products p, brand b where p.prod_id like '".$_REQUEST["product_id"]."' and p.brand_id = b.id", $conn);
    }
    else{
        header('location: product.php');
    }
    function getStar($getProduct_, $icon, $flag){
        if(count($getProduct_) > 0){
            if(!is_null($getProduct_[0]['Rating'])){
                $star = explode(".", $getProduct_[0]['Rating']);
                if($icon !== ""){
                    for($i = 0; $i < $star[0]; $i++){
                            echo "<script>
                                $('.".$icon." i').eq(".$i.").removeClass('fa-star-o');
                                $('.".$icon." i').eq(".$i.").addClass('fa-star color-star');
                            </script>";  
                    }
                }
                if($star[1] == 0){
                    if($flag == 1){
                        echo "<span class='review-relate-product'>".(int)$getProduct_[0]['Rating']."</span>";                              
                    }
                }
                else{
                    $number = 1;
                    for($i = 0; $i < strlen(strval($star[1])); $i++){
                        $number = $number*10;
                    }
                    if($flag == 1){
                        echo "<span class='review-relate-product'>".number_format($getProduct_[0]['Rating'], 1)."</span>" ;
                    }
                    if($icon !== ""){
                        if($star[1]/$number>= 0.5){
                            echo "<script>
                                $('.".$icon." i').eq(".$star[0].").addClass('fa-star-half-o color-star');
                            </script>";       
                        }
                    }  
                }
            }
            else{
                if($flag == 1){
                    echo "0";
                }
            }
            if($icon !== ""){
            echo "<script>$('.".$icon."').addClass('color-star')</script>";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Detail</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styling.css">
    <link rel="stylesheet" href="../css/style-Quang.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../css/custombox.min.css" rel="stylesheet">
    <script src="../js/custombox.min.js"></script>
    <script src="../js/custombox.legacy.min.js"></script>
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

    <style>
        .nav-li{
            display: inline-block;
        }
        .nav-li a{
            padding: 10px 10px; 
            border: 0.1px solid #696969;
            padding: 15px 50px;
            display: block;
        }
        .color-star, .icon i, .icon_relate i{
            color:gold;
        }
        .price-detail{
            font-size: 24px;
        }
        .price{
            line-height: 30px;
            font-size: 21px;
        }
        .quality{
            display: flex;
        }
        .quality button{
            display: inline-block;
            width: 12%;
            height: 33px;
        }
        .quality div{
            width: 12%;
            height: 33px;
        }
        .quality input{
            width: 100%;
            height: 100%;
        }
        .product-anchor{
            margin-top: 40px;
        }
        .product-anchor div{
            text-align: center;
            border-bottom: 1px solid black;
        }
        .detail_line{
            border-bottom: 1px solid #ececec;
            padding: 12px 0;
        }
        .border_line{
            border-bottom: 1px solid #ececec;
            border-left: 1px solid #ececec;
            border-right: 1px solid #ececec;
        }
        .side {
          float: left;
          width: 16%;
          margin-top:10px;
          font-size: 12px;
        }

        .middle {
          margin-top:10px;
          float: left;
          width: 70%;
        }

        /* Clear floats after the columns */
        .row:after {
          content: "";
          display: table;
          clear: both;
        }

        /* The bar container */
        .bar-container {
          width: 100%;
          background-color: #f1f1f1;
          text-align: center;
          color: white;
        }
        [class*='right']{
            text-align: right;
            width: 5%;
        }

        /* Individual bars */
        .bar-5 {width: 0%; height: 18px; background-color: #ffc120;}
        .bar-4 {width: 0%; height: 18px; background-color: #ffc120;}
        .bar-3 {width: 0%; height: 18px; background-color: #ffc120;}
        .bar-2 {width: 0%; height: 18px; background-color: #ffc120;}
        .bar-1 {width: 0%; height: 18px; background-color: #ffc120;}

        /* Set a style for all buttons */
        .login {
          background-color: #4CAF50;
          color: white;
          padding: 14px 20px;
          margin: 8px 0;
          border: none;
          cursor: pointer;
          width: 100%;
        }

                /* Full-width input fields */
        input[type=text], input[type=password] {
          width: 100%;
          padding: 12px 20px;
          margin: 8px 0;
          display: inline-block;
          border: 1px solid #ccc;
          box-sizing: border-box;
        }

        /* Extra styles for the cancel button */
        .cancelbtn {
          width: auto;
          padding: 10px 18px;
          background-color: #f44336;
        }

        /* Center the image and position the close button */
        .imgcontainer {
          text-align: center;
          margin: 24px 0 12px 0;
          position: relative;
        }

        img.avatar {
          width: 40%;
          border-radius: 50%;
        }

        .container {
          padding: 16px;
        }

        span.psw {
          float: right;
          padding-top: 16px;
        }

        /* The Modal (background) */
        .modal {
          display: none; /* Hidden by default */
          position: fixed; /* Stay in place */
          z-index: 1; /* Sit on top */
          left: 0;
          top: 0;
          width: 100%; /* Full width */
          height: 100%; /* Full height */
          overflow: auto; /* Enable scroll if needed */
          background-color: rgb(0,0,0); /* Fallback color */
          background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
          padding-top: 60px;
        }

        /* Modal Content/Box */
        .modal-content {
          background-color: #fefefe;
          margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
          border: 1px solid #888;
          width: 80%; /* Could be more or less, depending on screen size */
        }

        /* The Close Button (x) */
        .close {
          position: absolute;
          right: 25px;
          top: 0;
          color: #000;
          font-size: 35px;
          font-weight: bold;
        }

        .close:hover,
        .close:focus {
          color: red;
          cursor: pointer;
        }

        /* Add Zoom Animation */
        .animate {
          -webkit-animation: animatezoom 0.6s;
          animation: animatezoom 0.6s
        }

        @-webkit-keyframes animatezoom {
          from {-webkit-transform: scale(0)} 
          to {-webkit-transform: scale(1)}
        }
          
        @keyframes animatezoom {
          from {transform: scale(0)} 
          to {transform: scale(1)}
        }

        /* Change styles for span and cancel button on extra small screens */
        @media screen and (max-width: 300px) {
          span.psw {
             display: block;
             float: none;
          }
          .cancelbtn {
             width: 100%;
          }
        }
        .back-to-top {
            cursor: pointer;
            position: fixed;
            bottom: 20px;
            right: 20px;
            display:none;
        }
        #go_review:hover{
            cursor: pointer;
        }
        #go_review{
            position: relative;
            bottom: 50px;
            font-size: 14px;
        }
        .review_scroll_down span:hover{
            cursor: pointer;
            color: #337ab7;
        }
        body{
            background-color: #fafafa;
        }


    </style>

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
                <li><a href="aboutus.php"><b>About us</b></a></li>
            </ul>
            <?php 
                if(isset($_SESSION['username'])){
            ?>
                    <ul style="float: right; list-style: none; position: relative; width: 22%;top: 16px;">
                        <li style="display: inline-block;"><span class="glyphicon glyphicon-user"></span><a href="customer_info.php"><?=$_SESSION['username']?></a></li>
                        <li style="display: inline-block; margin-left: 16px;"><span class="glyphicon glyphicon-log-in"></span><a id="logout">Log out</a></li>
                    </ul>
            <?php
                }
                else{
            ?>
                    <ul style="float: right; list-style: none; position: relative; width: 22%;top: 16px;">
                        <li style="display: inline-block;"><span class="glyphicon glyphicon-user"></span><a href="TestLogin.php">Log in</a></li>
                        <li style="display: inline-block; margin-left: 16px;"><span class="glyphicon glyphicon-log-in"></span><a href="TestRegister.php">Sign up</a></li>
                    </ul>
            <?php
                }
            ?>
            
        </div>
    </nav>

    <div class="container">
        <div class="container">
            <div class="row"> <!-- Detail product-->
                <div class="col-xs-5 col-md-4 col-lg-4" class="img-product-detail-container">
                    <div class="detail-image-child-container">
                        <img src="../img/<?=$getProduct[0]['image']?>">
                    </div>

                    <div class="row list-image">
                        <ul class="list-group container-list-item">
                            <li class="list-group-item container-list-item">
                                <img src="../img/<?=$getProduct[0]['image']?>">
                            </li><!--
                            --><li class="list-group-item container-list-item">
                                <img src="../img/<?=$getProduct[0]['image_2']?>">
                            </li><!--
                            --><li class="list-group-item container-list-item
                            ">
                                <img src="../img/<?=$getProduct[0]['image_3']?>">
                            </li><!--
                            --><li class="list-group-item container-list-item
                            ">
                                <img src="../img/<?=$getProduct[0]['image_4']?>">
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-xs-7 col-md-8 col-lg-8">
                    <div class="product-detail">
                        <h3><?=$getProduct[0]["prod_name"]?></h3>
                        <div class="icon">
                            <div>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                            </div>
                        </div>

                        <div class="icon icon-margin">
                            <span>
                                <?php
                                    $getProduct_ = DatabaseConnect::getResult("select sum(rating)/(select count(*) from product_rating where product_id like '".$_REQUEST["product_id"]."') as Rating from product_rating where product_id like '".$_REQUEST["product_id"]."'", $conn);
                                        echo getStar($getProduct_,"icon",1)."/5";
                                ?>
                            </span>
                        </div>

                        <div class="icon review_scroll_down" style="margin-left:20px;"><span>Review</span></div>
                    </div>

                    <div class="product-detail" style="margin-top: 20px;">
                        <div class="row">
                            <div class="col-xs-2 col-md-2 col-lg-2 price">
                                <span>Price</span>
                            </div>
                            <div class="col-xs-6 col-md-6 col-lg-6 price-detail"><?=$getProduct[0]['prod_price']?>$</div>
                        </div>
                    </div>
                    
                    <hr>
                    <div class="product-detail">
                        <div class="row">
                            <div class="col-xs-2 col-md-2 col-lg-2">
                                <span>Quantity</span>
                            </div>

                            <div class="col-xs-6 col-md-6 col-lg-6 price-detail">
                                <div class="quality">
                                    <div>
                                        <input type="number" name="" id="quality_input" value="1" min="1" max="99">
                                    </div>
                                </div>
                            </div>   
                        </div>
                    </div>
                    <hr>

                    <div class="product-detail">
                        <div class="row">
                            <div class="col-xs-12 col-md-12 col-lg-12">
                                <button type="button" class="btn btn-danger">Buy Now</button>
                                <button type="button" class="btn btn-danger">Add to Cart</button>
                                <button type="button" class="btn btn-danger">Add to Wishlist </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-md-12 col-lg-12 product-anchor">
                    <div class="col-xs-4 col-md-4 col-lg-4" id="product_detail">Product Detail</div>
                    <div class="col-xs-4 col-md-4 col-lg-4" id="product_brand">Brand</div>
                    <div class="col-xs-4 col-md-4 col-lg-4" id="product_review">Review</div>
                </div>
            </div>            
        </div>


        <div class="row" style="margin-top: 10%; text-align: center; font-size: 26px;">
            Relate Product
        </div>
        <div class="row" style="overflow: hidden; position: relative; height: 370px;">
            <?php  
                $getProductCategory = DatabaseConnect::getResult("select * from products p, brand b where p.brand_id = b.id and p.product_category like '".$getProduct[0]['product_category']."'",$conn);
                $count = 0;
                $className = 0;
                foreach ($getProductCategory as $value) {
                    $className++;
                    $count++;
            ?>        
                    <a style="height: 100%; width: 22%; display: inline-block; margin-left: 2%; text-decoration: none;" href="product_detail.php?product_id=<?=$value['prod_id'] ?>" class="relate-container">
                        <img src="../img/<?=$value['image']?>" style="width: 100%; height: 50%;">
                        <h3><?=$value['prod_name']?></h3>
                        <p><?=$value['prod_price']?>$</p>
                        <div class="list-product-relate-star icon_relate_<?=$className?>">
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                        </div>
            <?php 
                        $getProduct_W = DatabaseConnect::getResult("select sum(rating)/(select count(*) from product_rating where product_id like '".$value['prod_id']."') as Rating from product_rating where product_id like '".$value['prod_id']."'", $conn);
                        $countReview = DatabaseConnect::getResult("select count(*) as Rating from product_rating where product_id like '".$value['prod_id']."'", $conn);
                        getStar($getProduct_W,"icon_relate_".$className,0);
                        if(!is_null($countReview[0]['Rating'])){
                            echo $countReview[0]['Rating']." Review";
                        }
                        else{
                            echo "0 Review";
                        }
            ?>
                    </a>
            <?php    
                    if($count <= 4){
                        echo "<script>$('.relate-container').eq(".($count-1).").addClass('relate-show')</script>";
                    }
                    else{
                        echo "<script>$('.relate-container').eq(".($count-1).").addClass('relate-right-hide')</script>";
                    }
                }
            ?>
            <div style="width: 20px; height: 40px; position: absolute; top:40%;" class="relate-left-nav">
                <i class="glyphicon glyphicon-menu-left" style="width: 100%; height: 100%; line-height: 40px; color: #a52a2a; background-color: #efefef;"></i>
            </div>
            <div style="width: 20px; height: 40px; position: absolute; top:40%; right: 0.7%;" class="relate-right-nav">
                <i class="glyphicon glyphicon-menu-right" style="width: 100%; height: 100%; line-height: 40px; color: #a52a2a; background-color: #efefef;"></i>
            </div>
        </div>

        <div class="row" style="margin-top: 10%; text-align: center; font-size: 24px;">
            Product
        </div>

        <div class="row" style="font-size: 20px;" id="detail">
            <div class="col-xs-8 col-md-8 col-lg-8" style="text-align: left; background-color: #e5e5e5; padding: 12px 20px; border-right: 1px solid #d6d4d4;">
                Information
            </div>
            <div class="col-xs-4 col-md-4 col-lg-4" style="text-align: left; background-color: #e5e5e5; padding: 12px 20px;">
                Specifications
            </div>
        </div>

        <div class="row">
            <div class="col-xs-8 col-md-8 col-lg-8 border_line" style="border-right: 1px solid #d6d4d4; height: 489px;">
                <h4>Overview <?=$getProduct[0]['prod_name']?></h4>
                <p><?=$getProduct[0]['prod_description']?></p>
            </div>
            <div class="col-xs-4 col-md-4 col-lg-4 border_line">
                <h4>General information</h4>
                <div class="row detail_line">
                    <div class="col-xs-6 col-md-6 col-lg-6">Brand</div>
                    <div class="col-xs-6 col-md-6 col-lg-6"><?=$getProduct[0]['name']?></div>
                </div>
                <div class="row detail_line">
                    <div class="col-xs-6 col-md-6 col-lg-6">Material</div>
                    <div class="col-xs-6 col-md-6 col-lg-6"><?=$getProduct[0]['material']?></div>
                </div>
                <div class="row detail_line">
                    <div class="col-xs-6 col-md-6 col-lg-6">Detail</div>
                    <div class="col-xs-6 col-md-6 col-lg-6"><?=$getProduct[0]['detail']?></div>
                </div>
                <div class="row detail_line">
                    <div class="col-xs-6 col-md-6 col-lg-6">Size</div>
                    <div class="col-xs-6 col-md-6 col-lg-6"><?=$getProduct[0]['detail_size']?></div>
                </div>
                <div class="row detail_line">
                    <div class="col-xs-6 col-md-6 col-lg-6">Strap Material</div>
                    <div class="col-xs-6 col-md-6 col-lg-6"><?=$getProduct[0]['strap_material']?></div>
                </div>
                <div class="row detail_line">
                    <div class="col-xs-6 col-md-6 col-lg-6">Strap Length</div>
                    <div class="col-xs-6 col-md-6 col-lg-6"><?=$getProduct[0]['strap_length']?></div>
                </div>
                <div class="row detail_line">
                    <div class="col-xs-6 col-md-6 col-lg-6">Zip Type</div>
                    <div class="col-xs-6 col-md-6 col-lg-6"><?=$getProduct[0]['zip_type']?></div>
                </div>
                <div class="row detail_line">
                    <div class="col-xs-6 col-md-6 col-lg-6">Slot Num</div>
                    <div class="col-xs-6 col-md-6 col-lg-6"><?=$getProduct[0]['slot_num']?></div>
                </div>
                <div class="row detail_line">
                    <div class="col-xs-6 col-md-6 col-lg-6">Simple Size</div>
                    <div class="col-xs-6 col-md-6 col-lg-6"><?=$getProduct[0]['simple_size']?></div>
                </div>
                <div class="row detail_line">
                    <div class="col-xs-6 col-md-6 col-lg-6">Style</div>
                    <div class="col-xs-6 col-md-6 col-lg-6"><?=$getProduct[0]['style']?></div>
                </div>
            </div>
        </div>

        <div class="row review_scroll_down_destination" style="margin-top: 10%; text-align: center;">
            <h3>Review</h3>
        </div>
        <div class="row" style="text-align: center; font-size: 24px; border-right: 1px solid #ececec;">
            <div class="col-xs-3 col-md-3 col-lg-3" style="border: 1px solid #ececec; border-bottom: none;">
                <a style="width: 70%; height: 300px; display: block; margin: auto; text-decoration: none;" href="product_detail.php?product_id=<?=$getProduct[0]['prod_id']?>">
                    <img src="../img/<?=$getProduct[0]['image']?>" style="display: block; width: 100%;height: 50%;">
                    <h6><?=$getProduct[0]['prod_name']?></h6>
                    <p><?=$getProduct[0]['prod_price']?>$</p>
                    <div class="icon_review">
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                    </div>
                </a>
                <?php 
                    getStar($getProduct_,"icon_review",0);
                ?>
            </div>
            <div class="col-xs-9 col-md-9 col-lg-9" style="border: 1px solid #ececec; border-bottom: none; padding: 0;">
                <div class="row" style="border-bottom: 1px solid #ececec;">
                    <div class="col-xs-2 col-md-2 col-lg-2">
                        <div style="padding: 50px 0;">
                            <?php 
                                if(is_null($getProduct_[0]['Rating'])){
                                    echo "No review"; 
                                }
                                else{
                                    echo getStar($getProduct_,"",1)."/5";
                            ?>
                                    <i class="fa fa-star color-star"></i>
                            <?php 
                                $countReview = DatabaseConnect::getResult("select count(*) as Rating from product_rating where product_id like '".$_REQUEST['product_id']."'", $conn);
                            ?>
                                    <p style="font-size: 12px;"><?=$countReview[0]['Rating']." Review"?></p>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                    
                    <div class="col-xs-5 col-md-5 col-lg-5">
                        <div class="row">

                            <div class="side">
                                <div>5 <span class="fa fa-star"></span></div>
                            </div>

                            <div class="middle">
                                <div class="bar-container">
                                  <div class="bar-5"></div>
                                </div>
                            </div>

                            <div class="side right-5"></div>

                            <div class="side">
                                <div>4 <span class="fa fa-star"></span></div>
                            </div>

                            <div class="middle">
                                <div class="bar-container">
                                  <div class="bar-4"></div>
                                </div>
                            </div>

                            <div class="side right-4"></div>

                            <div class="side">
                                <div>3 <span class="fa fa-star"></span></div>
                            </div>

                            <div class="middle">
                                <div class="bar-container">
                                  <div class="bar-3"></div>
                                </div>
                            </div>

                            <div class="side right-3">
                            </div>

                            <div class="side">
                                <div>2 <span class="fa fa-star"></span></div>
                            </div>

                            <div class="middle">
                                <div class="bar-container">
                                  <div class="bar-2"></div>
                                </div>
                            </div>

                            <div class="side right-2"></div>

                            <div class="side">
                                <div>1 <span class="fa fa-star"></span></div>
                            </div>

                            <div class="middle">
                                <div class="bar-container">
                                  <div class="bar-1"></div>
                                </div>
                            </div>

                            <div class="side right-1"></div>

                        </div>
                    </div>
                    <?php 
                        $getProduct_W = DatabaseConnect::getResult("select rating, count(rating)/(SELECT COUNT(*) from product_rating WHERE product_id like '".$_REQUEST['product_id']."') as Rating, count(rating) as Num from product_rating where product_id like ".$_REQUEST['product_id']." GROUP BY rating", $conn);
                        $exits_value = [];
                        $not_exits_value = [];
                        foreach ($getProduct_W as $value) {
                            echo "<script>$('.bar-".$value['rating']."').css('width','".($value['Rating']*100)."%');
                                    $('.right-".$value['rating']."').html('".$value['Num']."');
                            </script>";
                            array_push($exits_value,$value['rating']);
                        }   


                        for($i = 1; $i < 6; $i++){
                            $flag = false;
                            for($j = 0; $j < count($exits_value); $j++){
                                if($i == $exits_value[$j]){
                                    $flag = true;
                                    break;
                                }
                            }
                            if($flag == false){
                                array_push($not_exits_value,$i);
                            }
                        }

                        if(count($not_exits_value) > 0){
                            echo "<script>";
                            for($i = 0; $i < count($not_exits_value); $i++){
                                echo "$('.right-".$not_exits_value[$i]."').html(0);";
                            }
                            echo "</script>";
                        }
                    ?>
                    <div class="col-xs-5 col-md-5 col-lg-5">
                        <?php 
                            if(isset($_SESSION['username'])){
                                $rate = DatabaseConnect::getResult("select * from product_rating where customer_id like '".$_SESSION['username']."' and product_id like '".$_REQUEST['product_id']."'",$conn);
                                if(count($rate) == 0){
                        ?>  
                                    <div class="row">
                                        <div class="col-xs-4 col-md-4 col-lg-4">
                                            <span style="font-size: 12px;">Your Review:</span>
                                        </div>
                                        <div class="col-xs-8 col-md-8 col-lg-8 icon-review">
                                            <i class="fa fa-star-o color-star"></i>
                                            <i class="fa fa-star-o color-star"></i>
                                            <i class="fa fa-star-o color-star"></i>
                                            <i class="fa fa-star-o color-star"></i>
                                            <i class="fa fa-star-o color-star"></i>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-4 col-md-4 col-lg-4" style="padding: 0; height: 100px;">
                                            <span style="font-size: 11px;">Content rated:</span>
                                            <button style="background-color: rgb(255, 193, 32); border-color: rgb(255, 193, 32); font-size: 14px; height: 40%;" id="send_value">Send Review</button>
                                        </div>
                                        <div class="col-xs-8 col-md-8 col-lg-8">
                                            <textarea rows="4" placeholder="Your review about the product" id="content" style="font-size: 14px; width: 100%;"></textarea>
                                        </div>
                                    </div>
                        <?php
                                }
                                else{
                        ?>
                                    <div style="height: 79px;line-height: 79px;">
                                        <p style="height: 26%; font-size: 18px; color: rgb(255, 193, 32);">You have rated</p>
                                        <div class="col-xs-12 col-md-12 col-lg-12 icon-review-rated">
                                            <i class="fa fa-star-o color-star"></i>
                                            <i class="fa fa-star-o color-star"></i>
                                            <i class="fa fa-star-o color-star"></i>
                                            <i class="fa fa-star-o color-star"></i>
                                            <i class="fa fa-star-o color-star"></i>
                                        </div>
                                        <a id="go_review" style="text-decoration: none;">Go to Your Review</a>
                                    </div>

                        <?php
                                    $rate = DatabaseConnect::getResult("select * from product_rating where product_id like '".$_REQUEST['product_id']."' and customer_id like '".$_SESSION['username']."'",$conn);
                                    echo "<script>
                                            for(var i = 0; i < ".$rate[0]['rating']."; i++){
                                                $('.icon-review-rated i').eq(i).removeClass('fa-star-o');
                                                $('.icon-review-rated i').eq(i).addClass('fa-star');
                                            }
                                            $('#go_review').click(function(){
                                                $('html,body').animate({
                                                    scrollTop: $('#".$_SESSION['username']."').offset().top
                                                },700);
                                            });
                                    </script>";

                                }
                        ?>
                        <?php
                            }
                            else{
                        ?>
                                <div style="height: 155px;line-height: 155px;">
                                    <button class="writting_review" style="height: 26%;line-height: 26%; background-color: rgb(255, 193, 32); border-color: rgb(255, 193, 32); font-size: 18px;">Writting Review</button>
                                </div>
                        <?php
                            }
                         ?>
                    </div>
                </div>
                
                <?php 
                    $rate = DatabaseConnect::getResult("select * from product_rating p, customer c where p.product_id like '".$_REQUEST['product_id']."' and p.customer_id = c.customer_username",$conn);
                    if(count($rate) > 0){
                        $count = 0;
                        foreach ($rate as $value) 
                        {
                ?>
                            <div class="row">
                                <div class="col-xs-1 col-md-1 col-lg-1"></div>
                                <div class="col-xs-11 col-md-11 col-lg-11" style="text-align: left; overflow-wrap: break-word;" id="<?=$value['customer_username']?>">
                                    <p style="font-size: 13px; margin:0;"><?=$value['customer_name']?></p>
                                    <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0;">
                                        <?php 
                                            for($i = 0; $i < $value['rating']; $i++){
                                        ?>
                                                <i class="fa fa-star color-star" style="font-size: 14px;"></i>
                                        <?php 
                                                if($i == $value['rating']-1){
                                                    for($j = 0; $j < 5-$value['rating']; $j++){
                                        ?>
                                                        <i class="fa fa-star-o color-star" style="font-size: 14px;"></i>
                                        <?php 
                                                    }
                                                }
                                            }
                                        ?>
                                        
                                    </div>
                                    <p style="color: #666; font-size: 12px;"><?=$rate[$count]['rating_content'] ?></p>
                                </div>
                            </div>
                            <hr style="border: 0.7px solid rgb(227, 227, 227); width: 100%; margin:0;">
                <?php
                            $count++;
                        }
                    }
                ?>

            </div>
        </div>
    </div>
    <?php  
        DatabaseConnect::closeConnect($conn);
    ?>

    <footer class="footer-bottom footer-style">
        <div class="container">

            <div class="row">
                <div class="col-md-5 col-xs-5 col-lg-5">
                    <p>We are a respectable and reputable resellers, where most of the backpacks and bags will be
                        available. We also pride ourselves in our ability to deliver the best customer experience.</p>
                    <p><span class="glyphicon glyphicon-copyright-mark"></span> 2018 Team. All Rights Reserved</p>

                </div>

                <div class="col-md-4 col-xs-4 col-lg-4">
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
                <div class="col-md-3 col-xs-3 col-lg-3">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="Main.php">Home</a></li>
                        <li><a href="product.php">Products</a></li>
                        <li><a href="contact.html">Contact</a></li>
                        <li><a href="aboutus.html">About us</a></li>
                        <li><a href="Register.html">Sign up</a></li>
                        <li><a href="Login.html">Sign in</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>

    <div id="id01" class="modal">
      <div class="modal-content animate">
        <div class="imgcontainer">
          <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
        </div>
        <form id="login-form" onsubmit="return false;">
            <div class="container">
              <label for="uname"><b>Username</b></label>
              <input type="text" placeholder="Enter Username" name="uname"  id="login-username" required>
              <label for="psw"><b>Password</b></label>
              <input type="password" placeholder="Enter Password" name="psw" id="login-password" required>        
              <button class="login" id="login-btn" type="submit">Login</button>
            </div>
        </form>

        <div class="container" style="background-color:#f1f1f1">
          <button type="button" onclick="document.getElementById('id01').style.display='none'" style="width: 100%;" class="cancelbtn">Cancel</button>
        </div>
      </div>
    </div>

    <input type="hidden" name="" id="product_id_hidden" value="<?=$_REQUEST['product_id']?>">
    <div class="error"></div>
</body>
<script src="../js/product_detail.js"></script>
<script>
        $(".review_scroll_down").click(function(){
            $('html,body').animate({
                scrollTop: $('.review_scroll_down_destination').offset().top
            },700);
        });

        $('.writting_review').click(function(){
            $("#id01").css({'display':'block','width':'auto'});
        });

        var modal = document.getElementById('id01');
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }

        $("#login-btn").click(function(){
            if($("#login-form input").eq(0).val().length > 0 && $("#login-form input").eq(1).val().length > 0){
                var username = $("#login-username").val();
                var password = $("#login-password").val();
                $.ajax({
                    url: "login_product_detail.php",
                    method: "post",
                    data:{username:username, password:password},
                    success:function(data){
                        $('.error').html(data);
                    }
                });
            }   
        });

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


        $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });
        // scroll body to 0px on click
        $('#back-to-top').click(function () {
            $('#back-to-top').tooltip('hide');
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
        
        $('#back-to-top').tooltip('show');

        $("#product_detail, #product_brand").click(function(){
            $('html,body').animate({
                scrollTop: $('#detail').offset().top
            },700);
        });

        $("#product_review").click(function(){
            $('html,body').animate({
                scrollTop: $('.review_scroll_down_destination').offset().top
            },700);
        });


        
            $("#send_value").click(function(){
                if($(".icon-review i").hasClass("active-star")){
                    var num_star = $(".active-star").length;
                    var txt_content = $("#content").val();
                    var product_id = $("#product_id_hidden").val();

                    $.ajax({
                        url: "review.php",
                        method: "post",
                        data:{content:txt_content, num_star:num_star, product_id:product_id},
                        success:function(data){
                            alert("Send Successfully!");
                            location.reload();
                        }
                    });
                }
                else{
                    alert("Please vote star!");
                }
            });
        

</script>
</html>
<?php
session_start();
$id = $_GET['id'];
unset($_SESSION['cart_array'][$id]);
header("location: shopping_cart.php");

<?php 
	session_start();
	$_SESSION = array();
	session_destroy();
	session_unset();
	echo "<script>alert('Logout success');</script>";
	echo "<script>location.reload();</script>";
?>
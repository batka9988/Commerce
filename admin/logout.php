<?php
include('../config/constants.php');
session_destroy(); //unset($_SESSION['login']);
header('location:'.SITEURL.'admin/login.php');
?>
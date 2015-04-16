<?php
session_start();


ini_set('display_errors',1);// display erros
ini_set('error_reporting',E_ALL);// show all errors

require 'inc/functions.php';

if(!isset($_SESSION['xsrf_token'])){
  $_SESSION['xsrf_token'] = md5(time());
}

if(isset($_GET['clear_cart'])){
  unset($_SESSION['cart']);
}

if(isset($_GET['logged_out'])){
  $_SESSION['adm_logged_in'] = false;	
  $_SESSION['logged_in'] = false;
  $_SESSION['error_message'] =  'You have logged out.';  
  session_regenerate_id();
}


if(!isset($_SESSION['cart'])){
  $_SESSION['cart'] = array();
} 

$cart = &$_SESSION['cart'];

define('DB_HOST','localhost');
define('DB_USER','mr_php');
define('DB_NAME','intro_php');
define('DB_PASS','mr1984');



function __autoload($class_name){
  include '../inc/classes/' . $class_name . '.php';
}
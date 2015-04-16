<?php
include '../inc/functions;php';

$title = 'Your Invoice';

if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
	$_SESSION['target'] = basename($_SERVER['PHP_SELF']);
	$_SESSION['error_message'] = 'You must be logged in to checkout';
	header("Location: login.php");
	exit;
}

if(!isset($_SESSION['user_id'])) {
   $_SESSION['error_message'] = 'You must be logged in before checking out.';
   header('Location: login.php');
   exit;
} else {
  $customer_id = intval($_SESSION['user_id']);
}

// connect to DB
$dbh = getPDO();;

$sql = "SELECT * FROM customer WHERE customer_id = ?";

$query = $dbh->prepare($sql);

$params = [$customer_id];

$query->execute($params);
$user = $query->fetch(PDO::FETCH_ASSOC);

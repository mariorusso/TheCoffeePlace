<?php
/**
  file: dashboard.php
  author: Mario Russo <mariorusso@gmail.com>
  updated: Feb 01 2015
  description: Administrative Dashboard.   
*/
require '../../inc/proj_config.php';

$title = 'DASHBOARD';

if (!isset($_SESSION['adm_logged_in']) || $_SESSION['adm_logged_in'] !== true) {
	$_SESSION['target'] = basename($_SERVER['PHP_SELF']);
	$_SESSION['error_message'] = 'You must be logged in to access the admin';
	header("location: login.php");
	exit ;
}

//conect to database using PDO by the getPDO function
$dbh = getPDO();

/*---------------------------------------------------------------------------------------------------------------*/
//SELECT last 5 orders 

$sql = "SELECT o.*, c.first_name, c.last_name FROM orders o JOIN customer c on o.customer_id = c.customer_id ORDER BY date DESC LIMIT 5";

//Prepare the query 
$query = $dbh->prepare($sql);

//Execute the query passing the parameters 
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
/*---------------------------------------------------------------------------------------------------------------*/
//END of SELECT last 5 orders 

/*---------------------------------------------------------------------------------------------------------------*/
// SELECT total

$sql = "SELECT unit_price, sum(unit_price) FROM line_item"; 

//Prepare the query 
$query = $dbh->prepare($sql);

//Execute the query passing the parameters 
$query->execute();
$sold = $query->fetch(PDO::FETCH_ASSOC);
/*---------------------------------------------------------------------------------------------------------------*/
//END of SELECT total

/*---------------------------------------------------------------------------------------------------------------*/
//SELECT best selling items

$sql = "SELECT prod_id, name, sum(qty) as sum FROM line_item GROUP BY prod_id ORDER BY sum DESC LIMIT 10"; 

//Prepare the query 
$query = $dbh->prepare($sql);

//Execute the query passing the parameters 
$query->execute();
$bestsell = $query->fetchAll(PDO::FETCH_ASSOC);

/*---------------------------------------------------------------------------------------------------------------*/
//END of SELECT best selling items

  
include 'inc/header_inc.php';

?>
        
      <div id="breadcrumbs">
        <p><?=$title?></p>
      </div>
      <!-- Start of Content --> 
      <div id="content_wrapper"> 
        
        <!--Tob bar of the column-->
        <div class="column_top">
            <h1><?=$title?></h1>
        </div>
        <?php include 'inc/flash_messages.php' ?>  
        
        <div id="last5">
        	<div id="total">
        		<h2>Amount sold.</h2>
        		<h3>$<?= $sold['sum(unit_price)'] ?></h3>
        	</div>
        	
        	<table class="cart">
        		<caption>Last 5 Orders!</caption>
                <tr>
                  <th>Order ID</th>
                  <th>Date</th>
                  <th>Customer</th>
                  <th>Total</th>
                </tr>
                <!-- //Loop thru the $result as $row to extract the values  -->
          		<?php foreach($result as $row) : ?>
          		 <tr>
                  <td><h4><a href="order_details.php?order_id=<?=$row['order_id']?>"><?=$row['order_id']?></a></h4></td>
                  <td><?=$row['date']?></td>
                  <td><?=$row['first_name']?> <?=$row['last_name']?></td>
                  <td><?=$row['total']?></td>
                </tr>
               <?php endforeach; ?>
             </table>
        	
        </div>  
        <div id="bestsell">
        	<table class="cart">
        		<caption>Best selling items!</caption>
                <tr>
                  <th>Product</th>
                  <th>Qty Sold</th>
                </tr>
        		<?php foreach($bestsell as $row) : ?>
        			
        		<tr>
                  <td><?=$row['name']?></td>
                  <td><?=$row['sum']?></td>
                </tr>
               <?php endforeach; ?>
             </table>
        		
        	
        </div>
        
        
      </div>
      <!-- End of Content -->
      
 <?php 
 
 include 'inc/footer_inc.php';
 
 ?>
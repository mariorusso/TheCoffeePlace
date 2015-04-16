<?php
/**
  file: order_details.php
  author: Mario Russo <mariorusso@gmail.com>
  updated: Feb 15 2015
  description: Customer Detail Page TCP   
*/
//Require the project config  
require '../../inc/proj_config.php';

$title = "ORDER DETAIL";

if(isset($_GET['order_id'])){
  
  $order_id = intval($_GET['order_id']);
                        
  //conect to database using PDO by the getPDO function
  $dbh = getPDO();

 // SELECT ORDER

		$sql = "SELECT * from orders where order_id = ?";

		$params = array($order_id);

		$query = $dbh->prepare($sql);

		$query->execute($params);

		$order = $query->fetch(PDO::FETCH_ASSOC);	
		
/*------------------------------------------------------------------------------------------------------------*/
   		 //END of SELECT ORDER
/*------------------------------------------------------------------------------------------------------------*/
		// SELECT LINE ITEMS

		$sql = "SELECT * FROM line_item where order_id = ?";

		$query = $dbh->prepare($sql);

		$params = array($order_id);

		$query->execute($params);

		$items = $query->fetchAll(PDO::FETCH_ASSOC);
/*------------------------------------------------------------------------------------------------------------*/
    //END of SELECT LINE ITEMS 
    
    $address = unserialize($order['address']);
}

//Include the adm header
include 'inc/header_inc.php';
?>          
      <div id="breadcrumbs">
      	<!--//Echo the $title variable -->
        <p><?=$title?></p>
      </div>
      
      <!-- Start of Content --> 
      <div id="content_wrapper"> 
       
        <!--//Include the admin sidebar div-->
        <?php include 'inc/sidebar_inc.php'; ?>
        
        <!-- admin main Content starts  -->
        <div id="main_content">
          
          <div class="column_top">
            <!-- //Display title in the column Top -->
            <h1><?=$title?></h1>
          </div>
           <?php include 'inc/flash_messages.php' ?>    
          
                    
          <div id="user_info">	
				
			<h3>Order Information:</h3>

			<p><span class="tag">Order Number</span>: <?=$order['order_id']?><br />
				<span class="tag">Customer Number</span>: <?=$order['customer_id']?><br />
		    	<span class="tag">Order Date</span>: <?=$order['date']?><br />
				<span class="tag">Shipping to</span>: <?=$address['first_name']?> <?=$address['last_name']?><br />
				<span class="tag">Address</span>: <?=$address['street1']?> <?=$address['street2']?>, <?=$address['city']?> -
				<?=$address['region']?> - <?=$address['postal_code']?>
			</p>
		</div>
        	
        	<table class="cart">
		   		 <caption>Order Details</caption>
				<tr>
					<th>Item</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Sub Total</th>
				</tr>

			<?php foreach($items as $row) : ?>
			 	<tr>
			 		<td><?=$row['name']?></td>
			 		<td><?=$row['unit_price']?></td>
			 		<td><?=$row['qty']?></td>
			 		<td>$<?=$row['unit_price'] * $row['qty']?></td>

				 </tr>
			<?php endforeach; ?>
				<tr>
					<td colspan="2"></td>
					<td>Sub Total:</td>
					<td>$<?=$order['sub_total']?></td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td>PST:</td>
					<td>$<?=$order['pst']?></td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td>GST:</td>
					<td>$<?=$order['gst']?></td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td>TOTAL:</td>
					<td>$<?=$order['total']?></td>
				</tr>

			</table>
            
            
          
          
         <h3><a href="orders.php">Choose another order.</a></h3>
        </div>
        <!-- End of main content -->
        </div>  
      <!-- End of Content -->
      
<?php 
 
  //Include admin footer 
  include 'inc/footer_inc.php';
 
 ?>
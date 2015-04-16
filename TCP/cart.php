<?php
require '../inc/proj_config.php';

$title = 'CART';

$subtotal = getSubTotal($cart);

$GST = getGST($subtotal);

$PST = getPST($subtotal);

$total = $subtotal + $GST + $PST;

include 'inc/header_inc.php';

?>        
      <div id="breadcrumbs">
        <p><?=$title?></p>
      </div>
      <!-- Start of Content --> 
      <div id="content_wrapper"> 
       
        
        <div>
          
          <div class="column_top">
            <h1><?=$title?></h1>
          </div>
          
          <?php if(count($cart) == 0) : ?>
          	<div class="empty">
                <h3> Your cart is empty!</h3>
                <p>Please select a <a href="products.php">product</a>.</p>
            </div>
          <?php else : ?>
              <table class="cart">
                <tr>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Qty</th>
                  <th>Sub</th>
                </tr>
              
              
              
                <?php foreach($cart as $row) : ?>
                  <tr>
                    <td><?=$row['name']?></td>
                    <td>$<?=$row['price']?></td>
                    <td><?=$row['qty']?></td>
                    <td>$<?=$row['line_total']?></td>
                  </tr>
                 <?php endforeach; ?>
                 <tr>
                 	<td>Subtotal</td>
                 	<td>-</td>
                 	<td>-</td>
                 	<td>$<?=$subtotal?></td>
                 </tr>
                 <tr>
                 	<td>GST</td>
                 	<td>-</td>
                 	<td>-</td>
                 	<td>$<?=$GST?></td>
                 </tr>
                  <tr>
                 	<td>PST</td>
                 	<td>-</td>
                 	<td>-</td>
                 	<td>$<?=$PST?></td>
                 </tr>
                 <tr>
                 	<td>TOTAL</td>
                 	<td>-</td>
                 	<td>-</td>
                 	<td>$<?=number_format($total, 2)?></td>
                 </tr>
                
              </table>
                 <div class="clear_button">
                 	<a href="cart.php?clear_cart=1"><p>Clear cart</p></a>
                 </div>
              	<div class="button">
              		<a href="checkout.php"><p>Check out!</p></a>
              </div>
            <?php endif; ?>
            
          
        </div>
        
      </div>  
      <!-- End of Content -->
      
<?php 
 
 include 'inc/footer_inc.php';
 
 ?>
<?php $address = unserialize($order['address']); ?>

	<h2>Thanks for shopping with us, <?=$user['first_name']?></h2>
<hr />
	
	<div id="user_info">	
		<p>This is your receipt!  Please print a copy for your records!</p>
		
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


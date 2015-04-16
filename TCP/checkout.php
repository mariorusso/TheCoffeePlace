<?php
require '../inc/proj_config.php';

$title = 'Checkout';

//error variable
$errors = false;
$card_name_error = '';
$card_num_error = '';
$cvv_error = '';
$method_error = ''; 
$ship_error = '';

//card variable
$ship_method = false;
$method = false;
$card_name = false;
$card_num = false;
$cvv = false;

$delivery = 0;

$invoice = false;

$subtotal = getSubTotal($cart, $delivery);

$GST = getGST($subtotal);

$PST = getPST($subtotal);

$total = $subtotal + $GST + $PST;
	
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
	$_SESSION['target'] = basename($_SERVER['PHP_SELF']);
	$_SESSION['error_message'] = 'You must be logged in to checkout';
	header("location: login.php");
	exit ;
}

if(!isset($_SESSION['user_id'])) {
   $_SESSION['error_message'] = 'You must be logged in before checking out.';
   header('Location: login.php');
   exit;
} else {
  $customer_id = intval($_SESSION['user_id']);
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$card_name = sanatizeString($_POST['card_name']);
	$card_num = $_POST['card_num'];
	$card_type = sanatizeString($_POST['card_type']);
	$cvv = $_POST['cvv'];
	$method = '';
	$subtotal = floatval($_POST['subtotal']);
	$GST = floatval($_POST['gst']);
	$PST = floatval($_POST['pst']);
	$total = floatval($_POST['total']);
		
	//Check if the xrsf_token is set and not diferent from te SESSION token if not die.	
  if(!isset($_POST['xsrf_token']) || $_POST['xsrf_token'] !== $_SESSION['xsrf_token']) {
          die("Something went wrong, Invalid form submission. SORRY!");
    }
  
  if(!isset($_POST['ship_method'])){
   	    $errors[$ship_method] = "You must select one shipping method!";
	    $ship_error = $errors[$ship_method];	
   }else{
   		$ship_method = sanatizeString($_POST['ship_method']);
		if($ship_method == 'delivery'){
			$delivery = 2.50;
		}
   }
  
   if(!isset($_POST['pay_method'])){
   	    $errors[$method] = "You must select one payment method!";
	    $method_error = $errors[$method];	
   }else{
   		$method = sanatizeString($_POST['pay_method']);
   }
  
	if($method == 'credit_card'){
		if($card_type == 'Not using card'){
			$errors[$card_type] = "You chose Credit Card, so please select CARD TYPE.";
			$card_type_error = $errors[$card_type];
		}
		
		if(empty($card_name)){
			$errors[$card_name] = "You chose Credit Card, so NAME is a required field.";
			$card_name_error = $errors[$card_name];
		}else{
  			preg_match("/[a-zA-Z0-9\s\(\)\-\&]*/", $card_name, $matches);
	  		if(!$matches || $card_name != $matches[0]){
	  			$errors[$card_name] = "Name provided have illegal characters";
				$card_name_error = $errors[$card_name];
	  		}
		}
		
		if(empty($card_num)){
			$errors[$card_num] = "You chose Credit Card, so CARD NUMBER is a required field.";
			$card_num_error = $errors[$card_num];
		}else{
  			preg_match("/[\d]{16}/", $card_num, $matches);
	  		if(!$matches || $card_num != $matches[0]){
	  			$errors[$card_num] = "Card Number provided is illegal, use only numbers.";
				$card_num_error = $errors[$card_num];
	  		}
		}
		
		if(empty($cvv)){
			$errors[$cvv] = "You chose Credit Card, so Cvv NUMBER is a required field.";
			$cvv_error = $errors[$cvv];
		}else{
  			preg_match("/[\d]{3}/", $cvv, $matches);
	  		if(!$matches || $cvv != $matches[0]){
	  			$errors[$cvv] = "Cvv provided is illegal, use only numbers.";
				$cvv_error = $errors[$cvv];
	  		}
		}
		
	}//END of if Pay Method == Credit Card
	
	if($errors){
		 	$_SESSION['error_message'] = 'Sorry your form has errors please review it!';	
		}
		
    //IF no ERRORS
	if(!$errors){
		$subtotal = getSubTotal($cart, $delivery);

		$GST = getGST($subtotal);

		$PST = getPST($subtotal);

		$total = $subtotal + $GST + $PST;
		
		$title = 'Your Invoice';
		
		$dbh = getPDO();
		
		$sql = "SELECT * FROM customer WHERE customer_id = ?";

		$query = $dbh->prepare($sql);

		$params = [$customer_id];

		$query->execute($params);
		$user = $query->fetch(PDO::FETCH_ASSOC);
				
		// CARD
		$card = substr($card_num, -4);
		$card_type = sanatizeString($_POST['card_type']);
				
		// Customer Address
		$address = serialize(array(
			'first_name' => $user['first_name'],
			'last_name' => $user['last_name'],
			'street1' => $user['street_1'],
			'street2' => $user['street_2'],
			'city' => $user['city'],
			'region' => $user['province'],
			'postal_code' => $user['postal_code'],
		));
		
		
/*------------------------------------------------------------------------------------------------------------*/
        // INSERT to ORDER
		$sql = "INSERT INTO orders (customer_id, 
		 							address, 
		 							date,
		 							ship_method, 
		 							sub_total, 
		 							pst, 
		 							gst, 
		 							total,
		 							pay_method, 
		 							card_type, 
		 							card_num)
							VALUES (?, 
        							?, 
         							NOW(),
         							?, 
         							?, 
         							?, 
         							?, 
         							?, 
         							?, 
         							?, 
         							?)";

		$query = $dbh->prepare($sql);
		
		$params = array($user['customer_id'], 
						$address, 
						$ship_method, 
						$subtotal,
						$PST,
						$GST, 
						$total,
						$method,
						$card_type,
						$card);
		
			    
		$query->execute($params);
	
		$order_id = $dbh->lastInsertId();
		
		//END of insert to order. 
/*------------------------------------------------------------------------------------------------------------*/		
		// INSERT LINE ITEMS

		foreach($cart as $item) {
			$sql = "INSERT INTO line_item (order_id, prod_id, name, qty, unit_price) VALUES 
					(?, ?, ?, ?, ?)";

			$query = $dbh->prepare($sql);

			$params = array($order_id, $item['prod_id'], $item['name'], $item['qty'], $item['price']); 

			$query->execute($params);

		}//END of foreach cart as item. 
	
	  //END of insert LINE ITEMS
/*------------------------------------------------------------------------------------------------------------*/
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
    unset($_SESSION['cart']);
    
    $invoice = true;
	
	}//END of if no Errors
	
	
}//END of Have POST

//conect to database using getPDO function
$dbh = getPDO();

//Query de DB so get everything where email is == the same as user entered.
$sql = "SELECT first_name, 
				last_name,
				email,
				phone, 
				street_1, 
				street_2, 
				city, 
				province,
				postal_code				
				FROM customer
				WHERE customer_id = ?";

//Prepare the query to database.
$query = $dbh -> prepare($sql);

$params = array($_SESSION['user_id']);

//Execute the query.
$query -> execute($params);
$user = $query -> fetch(PDO::FETCH_ASSOC);

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
          <?php include 'inc/flash_messages.php' ?> 
        </div>
        <?php if($invoice) : ?>
        	
        	<?php include 'inc/invoice.php'; ?>        	
        <?php else : ?>
        <div id="checkout">
        	<div id="user_info">
        		
        		<h3>User Info:</h3>
        		<p><span class="tag">Name:</span> <?=$user['first_name']?> <?=$user['last_name']?></p>
        		<p><span class="tag">Phone:</span> <?=$user['phone']?></p>
        		<p><span class="tag">Email:</span> <?=$user['email']?></p>
        		<p><span class="tag">Address:</span> <?=$user['street_1']?>, <?=$user['street_2']?> 
        			                                 <?=$user['city']?> - <?=$user['province']?> - <?=$user['postal_code']?></p>
        		       		
        	</div>
        	
        	<div>
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
                  <?php if($ship_method == 'delivery') : ?>
                  <tr>
                 	<td>Delivery</td>
                 	<td>-</td>
                 	<td>-</td>
                 	<td>$<?=number_format($delivery, 2)?></td>
                 </tr>
                  <?php endif; ?>
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
                 	<td>$<?=$total = getTotal($subtotal, $GST, $PST)?></td>
                 </tr>
                </table>
                <hr />
                <div id="pay_info">
                	<form method="post" action="#" id="insert_form">
                			
          			 	<!--//Set a hidden field with the XSRF_TOKEN-->
          				<input type="hidden" name="xsrf_token" value="<?php echo $_SESSION['xsrf_token'] ?>" />
          				<input type="hidden" name="subtotal" value="<?=$subtotal?>" />
          				<input type="hidden" name="gst" value="<?=$GST?>" />
          				<input type="hidden" name="pst" value="<?=$PST?>" />
          				<input type="hidden" name="total" value="<?=$total?>" />
          				<fieldset>
            				<legend>Shipping Method</legend>
            				<p><span class="error"><?=$ship_error?></span></p>
                			<p>
                				<input type="radio" name="ship_method" value="delivery" 
                				<?php if($ship_method == 'delivery'){ echo 'checked="checked"'; } ?>>Delivery - $2.50<br />
                				<input type="radio" name="ship_method" value="pickup" 
                				<?php if($ship_method == 'pickup'){ echo 'checked="checked"'; } ?>>PickUp
                     		</p>
                		</fieldset>
            			<fieldset>
            				<legend>Payment Method</legend>
            				<p><span class="error"><?=$method_error?></span></p>
                			<p>
                				<input type="radio" name="pay_method" value="cash" 
                				<?php if($method == 'cash'){ echo 'checked="checked"'; } ?>>Cash<br />
                				<input type="radio" name="pay_method" value="interac" 
                				<?php if($method == 'interac'){ echo 'checked="checked"'; } ?>>Interac<br />
                				<input type="radio" name="pay_method" value="credit_card"
                				<?php if($method == 'credit_card'){ echo 'checked="checked"'; } ?>>Credit Card
                			</p>
                		</fieldset>
                		<fieldset>
                			<legend>Card Info</legend>
                			<p> 
                				<span class="error"><?=$card_name_error?></span><br />
                				<label for="card_type">Card Type:</label>
                				<select name="card_type" id="card_type">
                					<option>Not using card</option>
                					<option>Visa</option>
                					<option>Mastercard</option>
                					<option>Amex</option> 
                				</select>
                			</p>
                			<p> 
                				<span class="error"><?=$card_name_error?></span><br />
                				<label for="card_name">Name as in the card:</label>
                				<input type="text" name="card_name" value="<?=$card_name?>" placeholder="Name as in the card." id="card_name" />
                				
                			</p>
                			<p>
                				<span class="error"><?=$card_num_error?></span><br />
                				<label for="card_num">Card number:</label>
                				<input type="text" name="card_num" value="<?=$card_num?>" placeholder="Card number." id="card_num" />
                			</p>
                			<p>
                				<span class="error"><?=$cvv_error?></span><br />
                				<label for="cvv">Cvv:</label>
                				<input type="text" name="cvv" value="<?=$cvv?>" placeholder="3 number code in the back of card." id="cvv" />
                			</p>                			
                		</fieldset>
                			<input type="submit" value="Place Order" />
                	</form>
                </div>
        	</div>
        </div>
        <?php endif; ?>
      </div>
  
     
      <!-- End of Content -->
      
<?php

		include 'inc/footer_inc.php';
 ?>
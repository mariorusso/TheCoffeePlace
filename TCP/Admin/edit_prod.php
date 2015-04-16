<?php
/**
  file: edit_prod.php
  author: Mario Russo <mariorusso@gmail.com>
  updated: Feb 08 2015
  description: Edit Products Page TCP   
*/

//Set title variable to the page title. 
$title = 'EDIT PRODUCTS';

//require the config files that include the functions.
require '../../inc/proj_config.php';


if (!isset($_SESSION['adm_logged_in']) || $_SESSION['adm_logged_in'] !== true) {
	$_SESSION['target'] = basename($_SERVER['PHP_SELF']);
	$_SESSION['error_message'] = 'You must be logged in to access the admin';
	header("location: login.php");
	exit ;
}


//set errors into false, and other error variable to empty variables.
$errors = false;
$id_error = '';
$name_error = '';
$cat_error = '';
$ls_error = '';
$qty_error = '';
$img_error = '';
$ldesc_error ='';
$sdesc_error = '';
$price_error = '';
$cost_error = '';

//conect to database using PDO by the getPDO function
$dbh = getPDO();

if(isset($_GET['prod_id'])){
  
  //Sanatize $_GET, make sure prod id is a number. 
  $prod_id = intval($_GET['prod_id']);
  
  //Query the DB so it get the information relative to the prod_id provided in GET
  $sql = "SELECT 
          prod_id,
          category_id,
          name,
          quantity,
          lowstock_qty,
          short_description,
          long_description,
          image,
          price,
          cost
          FROM
          products
          WHERE
          prod_id=?";
  
  //prepare the query
  $query = $dbh->prepare($sql);
  
  //pass the parameters to the query.
  $params = array($prod_id);
  
  //Execute the query 
  $query->execute($params);
  $row = $query->fetch(PDO::FETCH_ASSOC);
  
  //Assign each row into a variable to populate the form.
  $prod_id = $row['prod_id'];
  $name = $row['name'];
  $cat_id = $row['category_id'];
  $ls_qty = $row['lowstock_qty'];
  $qty = $row['quantity'];
  $img = $row['image'];
  $l_desc = $row['long_description'];
  $s_desc = $row['short_description'];
  $price =  $row['price'];
  $cost = $row['cost'];
}

//check if have post.
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	
  //Check if the xrsf_token is set and not diferent from te SESSION token if not die.	
  if(!isset($_POST['xsrf_token']) || $_POST['xsrf_token'] !== $_SESSION['xsrf_token']) {
          die("Something went wrong, Invalid form submission. SORRY!");
    }
  
  //Assign each POST into a variable to make the form sticky.  
  $prod_id = $_POST['prod_id'];
  $name = $_POST['name'];
  $cat_id = $_POST['category_id'];  
  $ls_qty = $_POST['lowstock_qty'];
  $qty = $_POST['quantity'];
  $img = $_POST['image'];
  $l_desc = $_POST['long_description'];
  $s_desc = $_POST['short_description'];
  $price =  $_POST['price'];
  $cost = $_POST['cost'];
  
  //Check for errors in Product ID. 
  if(empty($prod_id)){
       $errors[$prod_id] = "Product ID is a required field";
	   $id_error = $errors[$prod_id];
  }
  //if not empty check for REGEX
  else{
  		preg_match("/[0-9]*/", $prod_id, $matches);
	  	if(!$matches || $prod_id != $matches[0]){
	  		$errors[$prod_id] = "Product ID must be a number";
			$id_error = $errors[$prod_id];
	  	}
  }//END of check product ID.
  
  //Check for errors in Product Name. 
  if(empty($name)){
       $errors[$name] = "Name is a required field";
	   $name_error = $errors[$name];
  }
  //if not empty check for REGEX
  else{
  		preg_match("/[a-zA-Z0-9\s\(\)\-\&]*/", $name, $matches);
	  	if(!$matches || $name != $matches[0]){
	  		$errors[$name] = "Name provided have illegal characters";
			$name_error = $errors[$name];
	  	}
  }//END of check product name. 
  
  //Check for errors in Category Field. 
  if(empty($cat_id)){
       $errors[$cat_id] = "Category is required, please select one";
	   $cat_error = $errors[$cat_id];
  }
  //Elseif check if selected category == to 0 or Select a Category 
  elseif($cat_id == 0 || $cat_id == "Select a Category"){
	  	$errors[$cat_id] = "Category is required, please select one";
	    $cat_error = $errors[$cat_id];	      
  }//END of check category.
  
  //Check for errors in low stock Qty. 
  if(empty($ls_qty)){
       $errors[$ls_qty] = "Low stock qty is a required field.";
       $ls_error = $errors[ls_qty];
  }
  //if not empty check for REGEX
  else{
  		preg_match("/[0-9]*/", $ls_qty, $matches);
	  	if(!$matches || $ls_qty != $matches[0]){
	  		$errors[$ls_qty] = "Low stock qty must be a number.";
	  		$ls_error = $errors[$ls_qty];
	  	}
  }//END of check low stock qty. 
  
  //Check for errors in stock Qty. 
  if(empty($qty)){
       $errors[$qty] = "Stock is a required field.";
       $qty_error = $errors[$qty];
  }
  //if not empty check for REGEX
  else{
  		preg_match("/[0-9]+/", $qty, $matches);
	  	if(!$matches || $qty != $matches[0]){
	  		$errors[$ls_qty] = "Stock qty must be a number.";
			$qty_error = $errors[$qty];
	  	}
  }//END of check stock qty.
  
  //Check for errors in image field. 
  if(empty($img)){
       $errors[$img] = "Is a required field.";
	   $img_error = $errors[$img];
  }
  //if not empty check for REGEX
  else{
  		preg_match("/[a-zA-Z\-\_]+[\.][j]{1}[p]{1}[g]{1}/", $img, $matches);
	  	if(!$matches || $img != $matches[0]){
	  		$errors[$img] = "Your image does not have the right format. It must have the '.jpg' extention";
			$img_error = $errors[$img];
	  	}
  }//END of check image field.
  
  //Check for errors in Long description Name. 
  if(empty($l_desc)){
       $errors[$l_desc] = "Long description is a required field";
	   $ldesc_error = $errors[$l_desc];
  }
  //if not empty check for REGEX
  else{
  		preg_match("/[a-zA-Z0-9\s\(\)\.\:\,\;\!\*\'\"\#\-\&]*/", $l_desc, $matches);
	  	if(!$matches || $l_desc != $matches[0]){
	  		$errors[$l_desc] = "Long description provided have illegal characters";
	  		$ldesc_error = $errors[$l_desc];
			
	  	}
  }//END of check Long description name. 
  
  //Check for errors in Short description Name. 
  if(empty($s_desc)){
       $errors[$s_desc] = "Short description is a required field";
	   $sdesc_error = $errors[$s_desc];
  }
  //if not empty check for REGEX
  else{
  		preg_match("/[a-zA-Z0-9\s\(\)\.\:\,\;\!\*\'\"\#\-\&]*/", $s_desc, $matches);
	  	if(!$matches || $s_desc != $matches[0]){
	  		$errors[$s_desc] = "Short description provided have illegal characters";
			$sdesc_error = $errors[$s_desc];
	  	}
  }//END of check Short description name. 
  
  //Check for errors in Price. 
  if(empty($price)){
       $errors[$price] = "Price is a required field";
	   $price_error = $errors[$price];
  }
  //if not empty check for REGEX
  else{
  		preg_match("/[0-9]+[\.][0-9]{2}/", $price, $matches);
	  	if(!$matches || $price != $matches[0]){
	  		$errors[$price] = "Price must be a number, in this format '0.00'.";
			$price_error = $errors[$price];
	  	}
  }//END of check price.
  
  //Check for errors in cost. 
  if(empty($cost)){
       $errors[$cost] = "Cost is a required field";
	   $cost_error = $errors[$cost];
  }
  //if not empty check for REGEX
  else{
  		preg_match("/[0-9]+[\.][0-9]{2}/", $cost, $matches);
	  	if(!$matches || $cost != $matches[0]){
	  		$errors[$cost] = "Cost must be a number, in this format '0.00'.";
			$cost_error = $errors[$cost];
	  	}
  }//END of check cost.

  //If NO errors
  if(!$errors){
    
    //Assign the $_POST variable to normal variables and sanatize the variables. 
    $prod_id = intval($_POST['prod_id']);
    $cat_id = intval($_POST['category_id']);
    $name = sanatizeString($_POST['name']);
    $qty = sanatizeString($_POST['quantity']);
    $ls_qty = sanatizeString($_POST['lowstock_qty']); 
    $s_desc = sanatizeString($_POST['short_description']);
    $l_desc = sanatizeString($_POST['long_description']);
    $img = sanatizeString($_POST['image']);
    $price = floatval($_POST['price']);
    $cost = floatval($_POST['cost']);
         
    //setting the checkbox featured
    if(isset($_POST['featured'])){
      //$featured is checked and value = 1
      $featured = $_POST['featured'];
      $featured = 1;
    }
    else{
      //$featured is not checked and value=0
      $featured=0;
    }
    
    //setting the checkbox deleted
    if(isset($_POST['deleted'])){
      //$deleted is checked and value = 1
      $deleted = $_POST['deleted'];
      $deleted = 1;
    }
    else{
      //$deleted is not checked and value=0
      $deleted = 0;
    } 
    
    //Query the database to UPDATE the products table 
    $sql = "UPDATE products SET category_id=:cat_id, 
                                name=:name, 
                                quantity=:quantity,
                                lowstock_qty=:lowstock_qty, 
                                short_description=:short_desc, 
                                long_description=:long_desc,
                                image=:image, 
                                price=:price, 
                                cost=:cost,
                                deleted=:deleted,
                                featured=:featured,
                                update_date=NOW()
                                WHERE prod_id=:prod_id";
    
    //Prepare the query to database.
    $query = $dbh->prepare($sql);
    
    //Set the parameters to be executed associating the prepared statement 
    //to the the variables with the values that we got from the form POST.
    $params = array(':cat_id'=>$cat_id, ':name'=>$name, ':quantity'=>$qty, ':lowstock_qty'=>$ls_qty, ':short_desc'=>$s_desc, ':long_desc'=>$l_desc, ':image'=>$img, ':price'=>$price, ':cost'=>$cost, ':deleted'=>$deleted, ':featured'=>$featured, ':prod_id'=>$prod_id);
    
    //Execute the query.
    $query->execute($params);
    
    /* SELECT THE NEW PRODUCT FOR DISPLAY
    --------------------------------------------------------------------------------------*/
        
    //Query the database to SELECT every field from products WHERE the ID is the last ID.
    $query = $dbh->prepare('SELECT * FROM products WHERE prod_id = :prod_id');
    
    //Set the parameters to execute the Query using prod_id variable as the parameter.
    $params = array(':prod_id'=>$prod_id);
    
    //execute the query with the parameter and get the result assigning the $product variable.
    $query->execute($params);   
    $product = $query->fetch(PDO::FETCH_ASSOC);
      
  }//End of if not errors
}// End of have $_post

//include the header for the admin.
include 'inc/header_inc.php';

?>
        
    <div id="breadcrumbs">
      <!--//Echo the title variable in the breadcrumb div-->
      <p><?=$title?></p>
    </div>
    <!-- Start of Content --> 
    <div id="content_wrapper"> 
        
        <!--Tob bar of the column-->
        <div class="column_top">
            <!--//Echo the title variable in the H1-->
            <h1><?=$title?></h1>
          </div>
          <?php include 'inc/flash_messages.php' ?>
      
        <!--//Include the admin sidebar div-->
        <?php include 'inc/sidebar_inc.php'; ?>
        
        <div id="main_content">  
        
         <!--//If page does not have GET or POST let user know that he needs to select a product to edit. -->	
         <?php if(!isset($_GET['prod_id']) && $_SERVER['REQUEST_METHOD'] != 'POST') : ?>
         	<h2>To access this page you must <a href="catalog.php">select a product</a> to Edit!</h2>      
        
        <!--//Check if the variable product is set-->
        <?php elseif(isset($product)) : ?>
          
          <!--//If the product variable is set, create a table and show the product information-->
          <table>       
            
            <caption><h2>You just edited this product.</h2></caption>
            
            <!--//To show the result use foreach loop trhu the $product array as key and value -->
            <?php foreach($product as $key => $value) : ?>
              
              <!--//Echo the key using prettyString function and and the value -->
              <tr>
                <th><?=prettyString($key)?></th>
                <td><?=$value?></td>  
              </tr>
            
            <!--//End the foreach loop -->
            <?php endforeach; ?>
          </table>
          <h3><a href="catalog.php">Choose another product.</a></h3>
        
        <!-- //ELSE show the form -->  
        <?php else : ?>
          
          <p class="required">All fields are required!</p>
          <!-- //Open the form using the function FromOpen passing the method, action, and id -->
          <?=formOpen('post', basename($_SERVER['PHP_SELF']), 'insert_form')?>
            
            <!--//Set a hidden field with the XSRF_TOKEN-->
            <input type="hidden" name="xsrf_token" value="<?php echo $_SESSION['xsrf_token'] ?>" />
            <p>
              <label for="prod_id">Prod ID</label>
              <input type="text" id="prod_id" name="prod_id" value="<?=$prod_id?>" readonly />
            </p>
            <!-- //Create the necessary inputs to the form using the functions. -->
            <p>
            	<?=createFilledTextInput('name', 100, $name)?> 
                <!--//Show each error by the side of the input -->
            	<span class="error"><?=$name_error?></span>
            </p>
    
            <p>
            	<?=getCategory('category_id', $cat_id)?> 
            	<span class="error"><?=$cat_error?></span>
            </p>
    
            <p>
            	<?=createFilledTextInput('quantity', 100, $qty)?> 
            	<span class="error"><?=$qty_error?></span>
            </p>
    
            <p>
            	<?=createFilledTextInput('lowstock_qty', 100, $ls_qty)?> 
            	<span class="error"><?=$ls_error?></span>
            </p>
    
            <p>
            	<?=createFilledTextArea('short_description', $s_desc)?>
            	<span class="error"><?=$sdesc_error?></span>
            </p>
          
            <p>
            	<?=createFilledTextArea('long_description', $l_desc)?>
            	<span class="error"><?=$ldesc_error?></span>
            </p>
    
            <p>
            	<?=createFilledTextInput('image', 100, $img)?> 
            	<span class="error"><?=$img_error?></span>
            </p>
      
            <p>
            	<?=createFilledTextInput('price', 100, $price)?>
            	<span class="error"><?=$price_error?></span>
            </p>
          
            <p>
            	<?=createFilledTextInput('cost', 100, $cost)?>
            	<span class="error"><?=$cost_error?></span>
            </p>
          
            <?=createCheckbox('featured')?>
          
            <?=createCheckbox('deleted')?>
    
            <?=createSubmit()?>
    
          <?=formClose()?>
          <!-- //Close the form -->
    
        <?php endif; ?>
        <!-- //End the if statement -->
        
      </div>  
    </div>
      <!-- End of Content -->
      
 <?php 
  
  // Include the admin footer. 
  include 'inc/footer_inc.php';
 
 ?>
<?php
/**
  file: add_products.php
  author: Mario Russo <mariorusso@gmail.com>
  updated: Feb 01 2015
  description: ADD Products Page TCP   
*/

//Set title variable to the page title. 
$title = 'ADD PRODUCTS';

//require the config files that include the functions.
require '../../inc/proj_config.php';

if (!isset($_SESSION['adm_logged_in']) || $_SESSION['adm_logged_in'] !== true) {
	$_SESSION['target'] = basename($_SERVER['PHP_SELF']);
	$_SESSION['error_message'] = 'You must be logged in to access the admin';
	header("location: login.php");
	exit ;
}

//set errors into false.
$errors = false;

//check if have post.
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  if(!isset($_POST['xsrf_token']) || $_POST['xsrf_token'] !== $_SESSION['xsrf_token']) {
          die("Something went wrong, Invalid form submission. SORRY!");
    }
  
  //ensure all fields were filled in or set error
  foreach($_POST as $key => $value){
    //If empty display set error. 
    if(empty($value)){
        $errors[$key] = "$key is a required field";
      }
  }
 
  //If NO errors
  if(!$errors){
    
    //Assign the $_POST variable to normal variables. 
    $category_id = sanatizeString($_POST['category_id']);
    $name = sanatizeString($_POST['name']);
    $qty = sanatizeString($_POST['quantity']);
    $low_qty = sanatizeString($_POST['lowstock_qty']); 
    $short_desc = sanatizeString($_POST['short_description']);
    $long_desc = sanatizeString($_POST['long_description']);
    $image = sanatizeString($_POST['image']);
    $price = floatval($_POST['price']);
    $cost = floatval($_POST['cost']);
    
    //setting the checkbox
    if(isset($_POST['featured'])){
      //$featured is checked and value = 1
      $featured = $_POST['featured'];
      $featured = 1;
    }
    else{
      //$featured is not checked and value=0
      $featured=0;
    }
    
    //conect to database using PDO by the getPDO function
    $dbh = getPDO();
    
    //Query the database 
    $sql = "INSERT INTO products (category_id, name, quantity, lowstock_qty, short_description, long_description, image, price, cost, featured)
            VALUES (:cat_id, :name, :quantity, :lowstock_qty, :short_desc, :long_desc, :image, :price, :cost, :featured)";
    
    //Prepare the query to database.
    $query = $dbh->prepare($sql);
    
    //Set the parameters to be executed associating the prepared statement 
    //to the the variables with the values that we got from the form POST.
    $params = array(':cat_id'=>$category_id, ':name'=>$name, ':quantity'=>$qty, ':lowstock_qty'=>$low_qty, ':short_desc'=>$short_desc, ':long_desc'=>$long_desc, ':image'=>$image, ':price'=>$price, ':cost'=>$cost, ':featured'=>$featured);
    
    //Execute the query.
    $query->execute($params);
    
    /* SELECT THE NEW PRODUCT FOR DISPLAY
    --------------------------------------------------------------------------------------*/
    //assign the prod_id to the last insetrted ID.
    $prod_id = $dbh->lastInsertId();
    
    //Query the database t SELECT every field from products WHERE the ID is the last ID.
    $query = $dbh->prepare('SELECT * FROM products WHERE prod_id = ?');
    
    //Set the parameters to execute the Query using prod_id variable as the parameter.
    $params = array($prod_id);
    
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
          
          <!--//If Errors display the errors in a SPECIAL DIV -->
          <?php if($errors) : ?>
            
            <div id="errors">
              
              <!--//Loop trhu the $errors array and assign it as key and variable-->
              <?php foreach($errors as $key => $value) : ?>
                
                <!--//Echo the Error variable using the prettyString Function.-->    
                <p><?=prettyString($value)?></p>
        
              <!--//End the loop trhu the $errors array-->
              <?php endforeach; ?>
        
            </div>
        
        <!--//End if errors statement-->
        <?php endif; ?>
        
        <!--//Check if the variable product is set-->
        <?php if(isset($product)) : ?>
          
          <!--//If the product variable is set, create a table and show the product information-->
          <table>       
            
            <caption><h2>You just added this product.</h2></caption>
            
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
          <h3><a href="add_products.php">Add another product.</a></h3>
        
        <!-- //ELSE show the form -->  
        <?php else : ?>
          
          <!-- //Open the form using the function FromOpen passing the method, action, and id -->
          <?=formOpen('post', '#' , 'insert_form')?>
            <input type="hidden" name="xsrf_token" value="<?php echo $_SESSION['xsrf_token'] ?>" />
            
            <!-- //Create the necessary inputs to the form using the functions. -->
            <?=createTextInput('name', 100)?>
    
            <?=getCategory('category_id')?>
    
            <?=createTextInput('quantity', 100)?>
    
            <?=createTextInput('lowstock_qty', 100)?>
    
            <?=createTextArea('short_description')?>
          
            <?=createTextArea('long_description')?>
    
            <?=createTextInput('image', 100)?>
      
            <?=createTextInput('price', 100)?>
          
            <?=createTextInput('cost', 100)?>
          
            <?=createCheckbox('featured')?>
    
            <?=createSubmit()?>
    
          <?=formClose()?>
          <!-- //Close the form -->
    
        <?php endif; ?>
        <!-- End the if statement -->
        
      </div>  
    </div>
      <!-- End of Content -->
      
 <?php 
  
  // Include the admin footer. 
  include 'inc/footer_inc.php';
 
 ?>
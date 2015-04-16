<?php
/**
  file: edit_cat.php
  author: Mario Russo <mariorusso@gmail.com>
  updated: Feb 15 2015
  description: Edit Categories Page TCP   
*/

//Set title variable to the page title. 
$title = 'EDIT CATEGORIES';

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
$img_error = '';
$desc_error ='';

//conect to database using PDO by the getPDO function
$dbh = getPDO();

if(isset($_GET['category_id'])){
  
  //Sanatize $_GET, make sure prod id is a number. 
  $cat_id = intval($_GET['category_id']);
  
  //Query the DB so it get the information relative to the prod_id provided in GET
  $sql = "SELECT 
          *
          FROM
          categories
          WHERE
          category_id=?";
  
  //prepare the query
  $query = $dbh->prepare($sql);
  
  //pass the parameters to the query.
  $params = array($cat_id);
  
  //Execute the query 
  $query->execute($params);
  $row = $query->fetch(PDO::FETCH_ASSOC);
  
  //Assign each row into a variable to populate the form.
  $cat_id = $row['category_id'];
  $name = $row['name'];
  $img = $row['image'];
  $desc = $row['description'];
 
}

//check if have post.
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	
  //Check if the xrsf_token is set and not diferent from te SESSION token if not die.	
  if(!isset($_POST['xsrf_token']) || $_POST['xsrf_token'] !== $_SESSION['xsrf_token']) {
          die("Something went wrong, Invalid form submission. SORRY!");
    }
  
  //Assign each POST into a variable to make the form sticky.  
  $cat_id = $_POST['category_id'];
  $name = $_POST['name'];
  $img = $_POST['image'];
  $desc = $_POST['description'];
  
  //Check for errors in Product ID. 
  if(empty($cat_id)){
       $errors[$cat_id] = "Product ID is a required field";
	   $id_error = $errors[$cat_id];
  }
  //if not empty check for REGEX
  else{
  		preg_match("/[0-9]*/", $cat_id, $matches);
	  	if(!$matches || $cat_id != $matches[0]){
	  		$errors[$cat_id] = "Product ID must be a number";
			$id_error = $errors[$cat_id];
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
  
  //Check for errors in description Name. 
  if(empty($desc)){
       $errors[$desc] = "Description is a required field";
	   $desc_error = $errors[$desc];
  }
  //if not empty check for REGEX
  else{
  		preg_match("/[a-zA-Z0-9\s\(\)\.\:\,\;\!\*\'\"\#\-\&]*/", $desc, $matches);
	  	if(!$matches || $desc != $matches[0]){
	  		$errors[$desc] = "Description provided have illegal characters";
	  		$desc_error = $errors[$desc];
			
	  	}
  }//END of check description name. 
    //If NO errors
  if(!$errors){
    
    //Assign the $_POST variable to normal variables and sanatize the variables. 
    $cat_id = intval($_POST['category_id']);
    $name = sanatizeString($_POST['name']);
    $desc = sanatizeString($_POST['description']);
    $img = sanatizeString($_POST['image']);
         
    //setting the checkbox is active
    if(isset($_POST['is_active'])){
      //$is_active is checked and value = 1
      $is_active = $_POST['is_active'];
      $is_active = 1;
    }
    else{
      //$is_active is not checked and value=0
      $is_active=0;
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
    $sql = "UPDATE categories SET category_id=:cat_id, 
                                name=:name, 
                                description=:desc, 
                                image=:image, 
                                deleted=:deleted,
                                is_active=:is_active,
                                update_date=NOW()
                                WHERE category_id=:cat_id";
    
    //Prepare the query to database.
    $query = $dbh->prepare($sql);
    
    //Set the parameters to be executed associating the prepared statement 
    //to the the variables with the values that we got from the form POST.
    $params = array(':cat_id'=>$cat_id, ':name'=>$name, ':desc'=>$desc, ':image'=>$img, ':deleted'=>$deleted, ':is_active'=>$is_active);
    
    //Execute the query.
    $query->execute($params);
    
    /* SELECT THE NEW PRODUCT FOR DISPLAY
    --------------------------------------------------------------------------------------*/
        
    //Query the database to SELECT every field from products WHERE the ID is the last ID.
    $query = $dbh->prepare('SELECT * FROM categories WHERE category_id = :cat_id');
    
    //Set the parameters to execute the Query using prod_id variable as the parameter.
    $params = array(':cat_id'=>$cat_id);
    
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
         <?php if(!isset($_GET['category_id']) && $_SERVER['REQUEST_METHOD'] != 'POST') : ?>
         	<h2>To access this page you must <a href="manage_categories.php">select a category</a> to Edit!</h2>      
        
        <!--//Check if the variable product is set-->
        <?php elseif(isset($product)) : ?>
          
          <!--//If the product variable is set, create a table and show the product information-->
          <table>       
            
            <caption><h2>You just edited this category.</h2></caption>
            
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
          <h3><a href="manage_categories.php">Choose another category.</a></h3>
        
        <!-- //ELSE show the form -->  
        <?php else : ?>
          
          <p class="required">All fields are required!</p>
          <!-- //Open the form using the function FromOpen passing the method, action, and id -->
          <?=formOpen('post', basename($_SERVER['PHP_SELF']), 'insert_form')?>
            
            <!--//Set a hidden field with the XSRF_TOKEN-->
            <input type="hidden" name="xsrf_token" value="<?php echo $_SESSION['xsrf_token'] ?>" />
            <p>
              <label for="category_id">Category ID</label>
              <input type="text" id="category_id" name="category_id" value="<?=$cat_id?>" readonly />
            </p>
            <!-- //Create the necessary inputs to the form using the functions. -->
            <p>
            	<?=createFilledTextInput('name', 100, $name)?> 
                <!--//Show each error by the side of the input -->
            	<span class="error"><?=$name_error?></span>
            </p>
            
            <p>
            	<?=createFilledTextArea('description', $desc)?>
            	<span class="error"><?=$desc_error?></span>
            </p>
              
            <p>
            	<?=createFilledTextInput('image', 100, $img)?> 
            	<span class="error"><?=$img_error?></span>
            </p>
                      
            <?=createCheckbox('is_active')?>
          
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
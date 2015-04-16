<?php
/**
  file: add_categoriess.php
  author: Mario Russo <mariorusso@gmail.com>
  updated: Feb 15 2015
  description: ADD Categories Page TCP   
*/

//Set title variable to the page title. 
$title = 'ADD CATEGORIES';

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
  
   //Assign the $_POST variable to normal variables. 
    $name = sanatizeString($_POST['name']);
    $desc = sanatizeString($_POST['description']);
    $image = sanatizeString($_POST['image']);
   
  
   //Check for errors in Category Name. 
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
  }//END of check Category name. 
  
   //Check for errors in image field. 
  if(empty($image)){
       $errors[$image] = "Is a required field.";
	   $img_error = $errors[$image];
  }
  //if not empty check for REGEX
  else{
  		preg_match("/[a-zA-Z\-\_]+[\.][j]{1}[p]{1}[g]{1}/", $image, $matches);
	  	if(!$matches || $image != $matches[0]){
	  		$errors[$image] = "Your image does not have the right format. It must have the '.jpg' extention";
			$img_error = $errors[$image];
	  	}
  }//END of check image field.
  
  //Check for errors in description Name. 
  if(empty($desc)){
       $errors[$desc] = "Description is a required field";
	   $ldesc_error = $errors[$desc];
  }
  //if not empty check for REGEX
  else{
  		preg_match("/[a-zA-Z0-9\s\(\)\.\:\,\;\!\*\'\"\#\-\&]*/", $desc, $matches);
	  	if(!$matches || $desc != $matches[0]){
	  		$errors[$desc] = "Description provided have illegal characters";
	  		$ldesc_error = $errors[$desc];
			
	  	}
  }//END of check description name.
  
   
  //If NO errors
  if(!$errors){
    
    //Assign the $_POST variable to normal variables. 
    $name = sanatizeString($_POST['name']);
    $desc = sanatizeString($_POST['description']);
    $image = sanatizeString($_POST['image']);
       
    //setting the checkbox
    if(isset($_POST['is_active'])){
      //$featured is checked and value = 1
      $is_active = $_POST['is_active'];
      $is_active = 1;
    }
    else{
      //$featured is not checked and value=0
      $is_active = 0;
    }
    
    //conect to database using PDO by the getPDO function
    $dbh = getPDO();
    
    //Query the database 
    $sql = "INSERT INTO categories (name, description, image, is_active)
            VALUES (:name, :desc, :image, :is_active)";
    
    //Prepare the query to database.
    $query = $dbh->prepare($sql);
    
    //Set the parameters to be executed associating the prepared statement 
    //to the the variables with the values that we got from the form POST.
    $params = array(':name'=>$name, ':desc'=>$desc, ':image'=>$image, ':is_active'=>$is_active);
    
    //Execute the query.
    $query->execute($params);
    
    /* SELECT THE NEW PRODUCT FOR DISPLAY
    --------------------------------------------------------------------------------------*/
    //assign the prod_id to the last insetrted ID.
    $cat_id = $dbh->lastInsertId();
    
    //Query the database t SELECT every field from products WHERE the ID is the last ID.
    $query = $dbh->prepare('SELECT * FROM categories WHERE category_id = ?');
    
    //Set the parameters to execute the Query using prod_id variable as the parameter.
    $params = array($cat_id);
    
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
       
            <?=createTextArea('description')?>
          
            <?=createTextInput('image', 100)?>
          
            <?=createCheckbox('is_active')?>
    
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
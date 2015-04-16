<?php
/**
  file: add_customer.php
  author: Mario Russo <mariorusso@gmail.com>
  updated: Feb 01 2015
  description: Add Customer Page TCP   
*/
require '../../inc/proj_config.php';

$title = 'ADD CUSTOMER';

if (!isset($_SESSION['adm_logged_in']) || $_SESSION['adm_logged_in'] !== true) {
	$_SESSION['target'] = basename($_SERVER['PHP_SELF']);
	$_SESSION['error_message'] = 'You must be logged in to access the admin';
	header("location: login.php");
	exit ;
}

$errors = false;

//check if have post.
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  
  //ensure all fields were filled in or set error
  foreach($_POST as $key => $value){
    if($value != $_POST['street_2']){   
      
      if(empty($value)){
        $errors[$key] = "$key is a required field";
      }
    
    }
  }
  
  //Ensure paswword field == confirm password field or set error
  if($_POST['password'] !== $_POST['confirm_password']){
    $errors['password'] = "Passwords does not match!";
  }   
  
  //If NO errors
  if(!$errors){
    
    //Assign the $_POST variable to normal variables. 
    $firstname = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone']; 
    $street1 = $_POST['street_1'];
    $street2 = $_POST['street_2'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $postalcode = $_POST['postal_code']; 
   
    
        
    //encrypt the password. 
    $salt = uniqid('$2y$10$', true);
    $encrypted_password = crypt($_POST['password'], $salt);
    
    //conect to database
    $dbh = getPDO();
    
    //Query the database 
    $sql = "INSERT INTO customer ( email, password, first_name, last_name, street_1, street_2, city, province, postal_code, phone )
            VALUES ( :email, :password, :firstname, :lastname, :street1, :street2, :city, :province, :postal_code, :phone )";
    
    //Prepare the query to database.
    $query = $dbh->prepare($sql);
    
    //Set the parameters to be executed associating the prepared statement 
    //to the the variables with the values that we got from the form POST.
    $params = array( ':email'=>$email, ':password'=>$encrypted_password, ':firstname'=>$firstname, ':lastname'=>$lastname, ':street1'=>$street1,                        ':street2'=>$street2, ':city'=>$city, ':province'=>$province, ':postal_code'=>$postalcode, ':phone'=>$phone );
    
    //Execute the query.
    $query->execute($params);
    
    /* SELECT THE NEW USER FOR DISPLAY
    --------------------------------------------------------------------------------------*/
    $customer_id = $dbh->lastInsertId();
    
    $query = $dbh->prepare('SELECT * FROM customer WHERE customer_id = ?');
    
    $params = array($customer_id);
    
    $query->execute($params);
    
    $customer = $query->fetch(PDO::FETCH_ASSOC);
    
    
  }//End of if not errors
}// End of have $_post

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
        
        <?php include 'inc/sidebar_inc.php'; ?>
        
        <div id="main_content">  
          <?php if($errors) : ?>
            
            <div class="erros">
          
              <?php foreach($errors as $key => $value) : ?>
            
                <p><?=prettyString($value)?></p>
        
              <?php endforeach; ?>
        
            </div>
          <?php endif; ?>
    
        <?php if(isset($customer)) : ?>
          <?php foreach($customer as $key => $value) : ?>
            <p><?=$key?> - <?=$value?></p>
          <?php endforeach; ?>
        <?php else : ?>
    
          <?=formOpen('post', '#' , 'insert_form')?>
    
            <?=createTextInput('first_name', 100)?>
    
            <?=createTextInput('last_name', 100)?>
    
            <?=createTextInput('email', 100)?>
    
            <?=createTextInput('phone', 12)?>
    
            <?=createTextInput('street_1', 100)?>
    
            <?=createTextInput('street_2', 100)?>
      
            <?=createTextInput('city', 100)?>
    
            <?=getRegion('province')?>
    
            <?=createTextInput('postal_code', 7)?>
    
            <?=createPasswordInput('password', 30)?>
        
            <?=createPasswordInput('confirm_password', 30)?>
    
            <?=createSubmit()?>
    
          <?=formClose()?>
    
        <?php endif; ?>
        
      </div>  
    </div>
      <!-- End of Content -->
      
 <?php 
 
 include 'inc/footer_inc.php';
 
 ?>
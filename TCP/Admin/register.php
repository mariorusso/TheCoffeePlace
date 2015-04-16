<?php
/**
  file: register.php
  author: Mario Russo <mariorusso@gmail.com>
  updated: Feb 11 2015
  description: Register form   
*/

require '../../inc/proj_config.php';

if (!isset($_SESSION['adm_logged_in']) || $_SESSION['adm_logged_in'] !== true) {
	$_SESSION['target'] = basename($_SERVER['PHP_SELF']);
	$_SESSION['error_message'] = 'You must be logged in to access the admin';
	header("location: login.php");
	exit ;
}

$title = "REGISTER";

$errors = false;

$email_error = false;

//check if have post.
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  
  $dbh = getPDO();
  
  $sql = "SELECT * FROM adm_user WHERE email = ?";
    
  //Prepare the query to database.
  $query = $dbh->prepare($sql);

  $params = array($_POST['email']);
  
  //Execute the query.
  $query->execute($params);
  $result = $query->fetchAll(PDO::FETCH_ASSOC);
  
 foreach($result as $row){
    if($row != 0){
      $email_error = "This email already exist in our database use the <a href='login.php'>login</a> page.";
    }
 }
  
  //ensure all fields were filled in or set error
  foreach($_POST as $key => $value){
        
      if(empty($value)){
        $errors[$key] = "$key is a required field";
      }
  }
  

  //Ensure paswword field == confirm password field or set error
  if($_POST['password'] !== $_POST['confirm_password']){
    $errors['password'] = "Passwords does not match!";
  }   
  
  //If NO errors
  if(!$errors && !$email_error){
    
  try{
    $adm_user = new Admuser_model($_POST);
    $new_adm_user = $adm_user->insert();
  } catch (Exception $e) {
                 var_dump($e->getMessage());
    }
  
    header('Location: login.php');
    $_SESSION['success_message'] =  'Thanks for register, Please login.';
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
        
        <!--//Include the admin sidebar div-->
        <?php include 'inc/sidebar_inc.php'; ?>
                
        <div id="main_content">  
          <?php if($email_error) : ?>
            <div class="errors">
              
              <p><?=$email_error?></p>
          
            </div>
          <?php endif; ?>
          
          <?php if($errors) : ?>
            <div class="errors">
                          
                <?php foreach($errors as $key => $value) : ?>
            
                  <p><?=prettyString($value)?></p>
        
                <?php endforeach; ?>
        
            </div>
          <?php endif; ?>
    
            
          <?=formOpen('post', '#' , 'insert_form')?>
    
            <?=createTextInput('name', 100)?>
    
            <?=createTextInput('email', 100)?>
                    
            <?=createPasswordInput('password', 30)?>
        
            <?=createPasswordInput('confirm_password', 30)?>
    
            <?=createSubmit()?>
    
          <?=formClose()?>
    
        
      </div>  
    </div>
      <!-- End of Content -->
      
 <?php 
 
 include 'inc/footer_inc.php';
 
 ?>
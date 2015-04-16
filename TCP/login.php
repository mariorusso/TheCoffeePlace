<?php
//Include required config file.
require '../inc/proj_config.php';

//Assign the variable to title
$title = 'LOGIN';

//Check if have POST...
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $email = $_POST['email'];
  $pass = $_POST['password'];

  //conect to database using getPDO function 
  $dbh = getPDO();
  
  //Query de DB so get everything where email is == the same as user entered.  
  $sql = "SELECT * FROM customer WHERE email = ?";
    
  //Prepare the query to database.
  $query = $dbh->prepare($sql);

  $params = array($_POST['email']);
  
  //Execute the query.
  $query->execute($params);
  $user = $query->fetch(PDO::FETCH_ASSOC);
  
  if(!$user){
    $_SESSION['error_message'] = 'We have no record of this user/password';
  }
  
  //Assign the encrypted password FROM DB to a variable.
  $encrypted_pass = $user['password'];

//Check if the password provided by the user is == the password we have stored after encryption.
 if(crypt($pass, $encrypted_pass) == $encrypted_pass){
    $_SESSION['logged_in'] = true;
    $_SESSION['user_id'] = $user['customer_id'];
    $_SESSION['name'] = $user['first_name'];
    $_SESSION['success_message'] =  'You are now logged in.';
    if(isset($_SESSION['target'])) {
      header('Location: ' . $_SESSION['target']);
      exit;
    }
  }else {
    $_SESSION['logged_in'] = false;
    $_SESSION['error_message'] =  'We have not record of that username/password combiation.';
    header('Location: login.php');
  } 
}//End of have POST

//include the header 
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
         
          
          <?php if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) : ?>
            <?=formOpen('post', '#', 'insert_form')?>
    
              <?=createTextInput('email', 100)?>
      
              <?=createPasswordInput('password', 30)?>
    
              <?=createSubmit()?>
    
            <?=formClose()?>
          <?php else : ?>

            <h2>You are already logged in!</h2>

          <?php endif; ?>
         
        </div>
        
      </div>  
      <!-- End of Content -->
      
<?php 
 
 include 'inc/footer_inc.php';
 
 ?>
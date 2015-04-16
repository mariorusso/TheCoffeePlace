<?php
require '../inc/proj_config.php';

$title = 'Frequent Asked Questions';

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
          
          <h3> where to find a the coffee place? </h3>
          
          <p> 
            You can find the nearest The Coffee Place to you in our <a href="locator.php" title="Locate the nearest The Coffee Place">
            Find Your Place</a> page.  
          </p>
          
          <h3> what time does the store opens? </h3>
          
          <p> 
            Every The Coffee Place store is open 24 hours a day seven days a week to provide the best service for you. 
          </p>
         
        </div>
        
      </div>  
      <!-- End of Content -->
      
<?php 
 
 include 'inc/footer_inc.php';
 
 ?>
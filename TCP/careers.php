<?php
require '../inc/proj_config.php';
$title = 'Careers';

include 'inc/header_inc.php';

?>        
      <div id="breadcrumbs">
        <p><?=$title?></p>
      </div>
      <?php include 'inc/flash_messages.php' ?>
      <!-- Start of Content --> 
      <div id="content_wrapper"> 
       
        
        <div>
          
          <div class="column_top">
            <h1><?=$title?></h1>
          </div>
          
          
          <h3> sorry at this time we don´t have any position available </h3>
          
          <p> 
            Although we are always open to recieve your resume and aplication feel free to send us an email at <a href="#">hr@tcp.com</a>.  
          </p>
          
          <p>
            We thank all those who apply, however, only candidates selected for an interview will be contacted.
          </p>
         
        </div>
        
      </div>  
      <!-- End of Content -->
      
<?php 
 
 include 'inc/footer_inc.php';
 
 ?>
<?php
require '../inc/proj_config.php';

$title = 'HOME';

include 'inc/header_inc.php';

?>
        
      <div id="breadcrumbs">
        <p><?=$title?></p>
      </div>
      <?php include 'inc/flash_messages.php' ?>

      <!-- Start of Content --> 
      <div id="content_wrapper"> 
       
        <!-- Left side column -->
        <div id="left_column">
          
          <div class="column_top">
            <h2>special grains</h2>
          </div>
          
          <div class="column_content">
            
            <div id="col_1_photo"><img src="images/col_1_img.jpg" width="140" height="151" alt="Coffee grains photo" />
            </div>
            
            <p>
              Only the best grains are selected for you here at The Coffee Place. Enjoy this opportunity 
              to taste a Brazilian Coffee and explore this new frontier find your place.
            </p>
             
            <div class="col_video_box">
           
              <h2>meet our production</h2>
            
            </div>
  
          </div>
          
        </div>
        
        <!-- Start of center column --> 
        <div id="center_column">
          
          <div class="column_top">
          
            <h2>our signatures</h2>  
          
          </div> 
          
          <div id="signature_1">
          
            <p><a href="#">Cheese Bread</a> (p&atilde;o de queijo)</p>
            <a href="#"><img src="images/pqueijo.jpg" alt="cheese bread picture" width="298" height="131" /></a>
          
          </div>
          
          <div id="signature_2">
          
            <p><a href="#">Chicken Drop</a> (coxinha)</p>
            <a href="#"><img src="images/coxinha1.jpg" alt="chicken drop picture" width="298" height="190" /></a>
          
          </div> 
          
            <p><a href="#">See all signatures itens</a></p>
          
          </div>
          <!-- End of center column -->
        
          <!-- Start of right column -->
          <div id="right_column">
          
            <h2>come try our month special</h2>
          
            <a href="#"><img src="images/irish.jpg" alt="irish coffee picture" width="179" height="349"  /></a>
            <p><a href="#">Irish Coffee</a><br /> The perfect blend of Coffee, Wiskey and Chantilly</p>
          
          
          </div>
      </div>
      <!-- End of Content -->
      
 <?php 
 
 include 'inc/footer_inc.php';
 
 ?>
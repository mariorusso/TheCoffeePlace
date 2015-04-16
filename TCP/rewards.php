<?php
require '../inc/proj_config.php';

$title = 'REWARD PROGRAM';

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
          
          <img class="resize" src="images/reward_card.jpg" alt="reward card image" width="390" height="200" />
          
          <p> 
            Earn points on every purchase!  
          </p>
          
          <h3> earn points </h3>
          
          <p> 
            Our program has the objective to make our clients happier everytime they come in. 
            In every purchase you make you will add points into your card, and this points can
            be converted to pay for your next meal, snack or coffee.  
          </p>
          
          <p> 
            To earn and use your points you only need to show your card prior to your payment. 
            Our attendant will let you know how many points you have to use and how many points
            will you earn for the next purchase. 
          </p>
          
          <h3> get your card </h3>
          
          <p> 
            It is easy and fast to have your card and start earning points at the same time. 
            Just visit one of our stores and ask for the reward card. Shouldn't take more than five minutes for that. 
            <a href="locator.html" title="Locate the nearest The Coffee Place">Find The Coffee Place near you</a>. 
          </p>
         
        </div>
        
      </div>  
      <!-- End of Content -->
      
<?php 
 
 include 'inc/footer_inc.php';
 
 ?>
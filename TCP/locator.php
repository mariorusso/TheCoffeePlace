<?php
require '../inc/proj_config.php';

$title = 'FIND YOUR PLACE';

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

          <h3>Find The Coffee Place near you.</h3>
          
          <form 
            action="#"
            method="post"
            name="locator_form"
            id="locator_form"
           >
           
             <input type="text" name="locator_field" id="locator_field" placeholder="Postal, City, Province, etc..." required />
             <input type="submit" value=""/>
             
          </form>
          
          <div class="restaurants">
            <img class="resize" src="images/map.jpg" alt="map image" width="445" height="382" />
          </div>
          
          <div class="restaurants">
             
            <div class="itens_icon">
              <img src="images/a_icon.jpg" alt="locator a icon" width="24" height="40" />
            </div>
            
            <h4>Store A</h4>
            
            <p> 
              This store is located at Street A number 1234, Winnipeg MB.         
            </p>
          
          </div>
          
          <div class="restaurants">
          
            <div class="itens_icon">
              <img src="images/b_icon.jpg" alt="locator b icon" width="24" height="40" />
            </div>
            
            <h4>Store B</h4>
            
            <p> 
              This store is located at Street B number 1234, Winnipeg MB.         
            </p>
            
          </div>
          
          <div class="restaurants">
            
            <div class="itens_icon">
              <img src="images/c_icon.jpg" alt="locator c icon" width="24" height="40" />
            </div>
            
            <h4>Store B</h4>
            
            <p> 
              This store is located at Street C number 1234, Winnipeg MB.         
            </p>
            
          </div>
          
          <div class="restaurants">
            
            <div class="itens_icon">
              <img src="images/d_icon.jpg" alt="locator d icon" width="24" height="40" />
            </div>
            
            <h4>Store B</h4>
            
            <p> 
              This store is located at Street D number 1234, Winnipeg MB.         
            </p>
            
          </div>
          
        </div>
        
      </div>  
      <!-- End of Content -->
      
<?php 
  
  include 'inc/footer_inc.php';
 
?>
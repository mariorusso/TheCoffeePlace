<?php
require '../inc/proj_config.php';

$title = 'OUR COFFEE';

include 'inc/header_inc.php';

?>         
      <div id="breadcrumbs">
        <p><?=$title?></p>
      </div>
      <?php include 'inc/flash_messages.php' ?>
      <!-- Start of Content --> 
      <div id="content_wrapper"> 
       
        <!-- Our Coffee Content starts  -->
        <article>
          
          <div class="column_top">
            <h1><?=$title?></h1>
          </div>
          
          
          <h3> special grains </h3>
          
          <p>
            Our coffee grains are specialy produced by the Brazilian coffee farm, Ubatuba. The Ubatuba farm is known since 1940 for the high quality coffee  
            grains production. In 2013 their grains got the class AAA rank on their premium coffee, showing that they still in the top of the coffee production. 
          </p>
          
          <p>
            This great coffee is what you will find in one of our <a href="locator.html" title="goes to the locations page" >locations</a>.   
          </p> 
           
          
          <h3> special roasting </h3>
            
          <p>
            After the importance of the grains oringin. It is by roasting that the flavour and aroma of coffee are developed, the roasting of these is to be 
            decisive in determining the extent of the range of aroma components. The point of roasting is reflected by the external coloration acquired by grain, 
            the flavor developed by the mass loss in dry matter occurred.
          </p>
                    
          <table>
            <caption>Coffee Roasting Table</caption>
            <tr>
              <th>Type of Roasting</th> 
              <th>Time (min)</th>          
              <th>Weight Loss (%)</th>
              <th>The moisture content (%)</th>
            </tr>
            <tr>
              <th>Light</th> 
              <td>7</td>          
              <td>3.8</td>
              <td>2.1</td>
            </tr>
            <tr>
              <th>Medium</th> 
              <td>10</td>          
              <td>3.7</td>
              <td>2.1</td>
            </tr>
            <tr>
              <th>Dark</th> 
              <td>13</td>          
              <td>10</td>
              <td>1.8</td>
            </tr>
            <tr>
              <th>Very Dark</th> 
              <td>19</td>          
              <td>9.8</td>
              <td>1.7</td>
            </tr>
          </table>
          
          <h3>come try</h3>
          
          <div class="itens">
            <div class="itens_icon">
              <img src="images/coffee_cup.jpg" alt="coffee cup icon" width="100" height="150" />
            </div>
            
            <h4>House Blend</h4>
            
            <p> 
              Our House Blend it is the perfect blend of light and medium roast with the familiar and satisfying taste.
              <br /><a href="#">Learn more</a>. 
            </p>
          
          </div>
          
          <div class="itens">
            <div class="itens_icon">
              <img src="images/coffee_cup.jpg" alt="coffee cup icon" width="100" height="150" />
            </div>
            
            <h4>Dark Blend</h4>
            
            <p> 
              The dark blend is the perfect blend of the dark and very dark roast giving you the taste and flavour for a perfect day.
              <br /><a href="#">Learn more</a>. 
            </p>
                                                                                                                                      
          </div>
          
          <div class="itens">
            <div class="itens_icon">
              <img src="images/coffee_cup.jpg" alt="coffee cup icon" width="100" height="150" />
            </div>
            
            <h4>Decaf Blend</h4>
            
            <p> 
              It is for you that deserve to taste our very well known coffee but without the caffeine.
              <br /><a href="#">Learn more</a>. 
            </p>
          
          </div>
            
            
          
        </article>
        
      </div>  
      <!-- End of Content -->
      
<?php 
 
 include 'inc/footer_inc.php';
 
 ?>
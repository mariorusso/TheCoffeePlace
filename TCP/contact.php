<?php
require '../inc/proj_config.php';

$title = 'CONTACT US';

include 'inc/header_inc.php';

?>         
      <div id="breadcrumbs">
        <p><?=$title?></p>
      </div>
      

      <!-- Start of Content --> 
      <div id="content_wrapper"> 
       
        <!-- Our Coffee Content starts  -->
        <article>
          
          <div class="column_top">
            <h1><?=$title?></h1>
          </div>
          <?php include 'inc/flash_messages.php' ?>
          
          
          <p>
            Use the form bellow to contact us. 
          </p>
          
         
          <!-- application form starts here -->
          <form 
            action="#"
            method="post"
           name="contactform"
           id="contactform"
           autocomplete="off"
          >
    
            <fieldset id="personal_info"><!-- start of personal info -->
              <legend>Contact Info</legend>
              <p>
                <input type="hidden" name="author" value="Mario Russo" />
                
                <label for="first_name">First Name:</label><!-- this is how you label a form field -->  
                <input type="text" name="first_name" id="first_name" maxlength="35" size="30"
                placeholder="Type your first name" required />
                
              </p>
              
              <p>
                <label for="last_name">Last Name:</label>  
                <input type="text" name="last_name" id="last_name" maxlength="35" size="30"
                placeholder="Type your last name" required />
              </p>
              
              <p>
                <label for="address">Address:</label>  
                <input type="text" name="address" id="address" maxlength="65" size="60" />
              </p>
                      
              <p>
                <label for="phone_number">Phone Number:</label>  
                <input type="tel" name="phone_number" id="phone_number" maxlength="20" size="20" />
              </p>
              
              <p>
                <label for="email">Email:</label>  
                <input type="email" name="email" id="email" maxlength="90" size="60" />
              </p>
              
              <p><!-- Comments box starts here -->
                <label for="comments">Tell us about your business idea.</label><br />
                <textarea name="comments" id="comments" cols="30" rows="6"></textarea>
              </p><!-- end of comments --> 
              
            </fieldset> <!-- end of personal info --> 
            
              <p>
                <input type="submit" value="Send" />&nbsp;
                <input type="reset" value="Clear Form" />  
              </p>
        
          </form>
          <!-- application form ends here -->  
            
          
        </article>
        
      </div>  
      <!-- End of Content -->
      
<?php 
 
 include 'inc/footer_inc.php';
 
 ?>
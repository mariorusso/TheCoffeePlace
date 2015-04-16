<?php
require '../inc/proj_config.php';

$title = 'FRANCHISING';

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
          
          
          <h3> mission statement </h3>
          
          <p>
            Our mission, in partnership with every Franchisee and Team Member, is to be the industry leader through commitment to excellence in people, product 
            quality, value, cleanliness, Guest service, and community leadership. 
          </p>
          
          <h3> franchise cost </h3>
            
          <p>
            At least $35,000 of the franchise cost must be unencumbered (cash or liquid assets) in addition to the $50,000 working capital that must also be 
            unencumbered. The remaining amount may be financed through various lending programs offered by the chartered banks, providing, of course, the candidate 
            meets the normal borrowing requirements. The specific cost of a The Coffee Palce license will depend upon the building size and the required 
            furnishings and equipment to be installed.<br /> 
            Included in the cost of a franchise is the following:</p>
            
          <ul>
            <li>All equipment, furniture, display equipment and signage.</li>
            <li>Seven (7) week training program.</li>
            <li>Right to use trademarks and trade names.</li>
            <li>Support from head office personnel who have vast knowledge in the food service business.</li>
          </ul>
              
          
          
          <h3>apply today</h3>
          
          <p>
            We are a new and dynamic company that encourange anyone interested in running a profitable and promising business. 
          </p>
         
          <!-- application form starts here -->
          <form 
            action="http://www.scott-media.com/test/form_display.php"
            method="post"
           name="contactform"
           id="contactform"
           autocomplete="off"
          >
    
            <fieldset id="personal_info"><!-- start of personal info -->
              <legend>Personal Info</legend>
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
              
            </fieldset> <!-- end of personal info --> 
              
            <fieldset id="business_info"><!-- Start of businnes info -->
              <legend>Business Information</legend>
              
              <p>
                <label for="openning_date">Desired Openning Date</label>
                <input type="date" id="openning_date" name="openning_date" />
              </p> 
              
              <p><!-- Comments box starts here -->
                <label for="comments">Tell us about your business idea.</label><br />
                <textarea name="comments" id="comments" cols="30" rows="6"></textarea>
              </p><!-- end of comments --> 
              
              <p><!-- Start of sex radio choices -->
                <strong>Sex</strong><br />
                <input type="radio" id="gender0" name="gender" value="Male"/>
                <label for="gender0">Male</label> <br />
                <input type="radio" id="gender1" name="gender" value="Female" />
                <label for="gender1">Female</label>
              </p><!-- End of sex -->
              
              <p><!-- Start of ages choices here -->
                <strong>Age</strong><br />
                    
                <input type="radio" id="age4" name="age" value="21 to 30" />
                <label for="age4">21 to 30</label> <br />
                
                <input type="radio" id="age5" name="age" value="31 to 40" />
                <label for="age5">31 to 40</label> <br />
                
                <input type="radio" id="age6" name="age" value="41 to 50" />
                <label for="age6">41 to 50</label> <br />
                
                <input type="radio" id="age7" name="age" value="Over 50" />
                <label for="age7">Over 50</label> <br />
              </p><!-- end of ages -->
              
              <p>
                <input type="checkbox" name="brochure_request" id="brochure_request" value="yes" checked="checked" />
                <label for="brochure_request">I want to recieve the franchising brochure by mail.</label>        
              </p>     
              
              <p><!-- select box -->
                <select name="available_investment" >
                
                  <option>Choose the Available Ivenstment</option>
                  <optgroup label="Low Investment">  
                    <option value="0-10000">Under 45,000</option>
                  </optgroup>
                  
                  <optgroup label="Midium Investment">
                    <option value="45000-65000">45,000 to 65,000</option>
                    <option value="65000-85000">65,000 to 85,000</option>
                  </optgroup>
                  
                  <optgroup label="High Investment">
                    <option value="85000-105000">85,000 to 105,000</option>
                    <option value="105000-155000">105,000 to 155,000</option>
                    <option value="155000+">Over 155,000</option>
                  </optgroup>  
                          
                </select>
              </p>
              
            </fieldset><!-- End of optional info --> 
              
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
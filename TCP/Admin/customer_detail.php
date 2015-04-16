<?php
/**
  file: customer_detail.php
  author: Mario Russo <mariorusso@gmail.com>
  updated: Feb 15 2015
  description: Customer Detail Page TCP   
*/
//Require the project config  
require '../../inc/proj_config.php';

$title = "CUSTOMER DETAIL";

if(isset($_GET['customer_id'])){
  
  $customer_id = intval($_GET['customer_id']);
                        
  //conect to database using PDO by the getPDO function
  $dbh = getPDO();

  //Query the database 
  $sql = "SELECT * FROM customer WHERE customer_id = ?";

  //Prepare the query to database.
  $query = $dbh->prepare($sql);

  $params = array($customer_id);
  
  //Execute the query.
  $query->execute($params);
  $customer = $query->fetch(PDO::FETCH_ASSOC);
  
}

//Include the adm header
include 'inc/header_inc.php';
?>          
      <div id="breadcrumbs">
      	<!--//Echo the $title variable -->
        <p><?=$title?></p>
      </div>
      
      <!-- Start of Content --> 
      <div id="content_wrapper"> 
       
        <!--//Include the admin sidebar div-->
        <?php include 'inc/sidebar_inc.php'; ?>
        
        <!-- admin main Content starts  -->
        <div id="main_content">
          
          <div class="column_top">
            <!-- //Display title in the column Top -->
            <h1><?=$title?></h1>
          </div>
           <?php include 'inc/flash_messages.php' ?>    
          
                    
          <!-- End of list items -->
          <div id="user_info">
        		
        		<h3>User Info:</h3>
        		<p><span class="tag">Customer ID:</span> <?=$customer['customer_id']?></p>
        		<p><span class="tag">Name:</span> <?=$customer['first_name']?> <?=$customer['last_name']?></p>
        		<p><span class="tag">Phone:</span> <?=$customer['phone']?></p>
        		<p><span class="tag">Email:</span> <?=$customer['email']?></p>
        		<p><span class="tag">Address:</span> <?=$customer['street_1']?>, <?=$customer['street_2']?> 
        			                                 <?=$customer['city']?> - <?=$customer['province']?> - <?=$customer['postal_code']?></p>
        		       		
        	</div>
        	
        	
            
            
          
          
  
        </div>
        <!-- End of main content -->
        </div>  
      <!-- End of Content -->
      
<?php 
 
  //Include admin footer 
  include 'inc/footer_inc.php';
 
 ?>
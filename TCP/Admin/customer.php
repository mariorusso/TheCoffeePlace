<?php
/**
  file: customer.php
  author: Mario Russo <mariorusso@gmail.com>
  updated: Feb 15 2015
  description: Orders Page TCP   
*/
//Require the project config  
require '../../inc/proj_config.php';

//Set title as Manage Products
$title = 'CUSTOMERS';

if (!isset($_SESSION['adm_logged_in']) || $_SESSION['adm_logged_in'] !== true) {
	$_SESSION['target'] = basename($_SERVER['PHP_SELF']);
	$_SESSION['error_message'] = 'You must be logged in to access the admin';
	header("location: login.php");
	exit ;
}

//conect to database using PDO by the getPDO function
$dbh = getPDO();

//Define the variable $searchtearm empty before search form is submited.
$searchterm = '';

//Check if isset GET search
if(isset($_GET['search'])){

  //Sanatize get search string 
  $searchterm = sanatizeString($_GET['search']);
}//End of GET is set

//Query the database to SELECT the product ID, product name, short description, image, category name as category 
//from products and category table, and where deleted is set to 0
  $sql = "SELECT customer_id, 
                 first_name,
                 last_name,
                 email,
                 phone,
                 created_at,
                 updated_at
                 FROM customer 
                 WHERE deleted = 0
                 AND first_name LIKE ? 
                 OR last_name LIKE ?
                 OR email LIKE ?
                 ";
  //Prepare the query 
  $query = $dbh->prepare($sql);
  
  //Assign the parameters to params variable
  $params = array("%$searchterm%", "%$searchterm%", "%$searchterm%"); 
  
  //Execute the query passing the parameters 
  $query->execute($params);
  $result = $query->fetchAll(PDO::FETCH_ASSOC);

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
          
          <!-- //Inside search form -->
          <div class="inside_search">
            <form id="insert_form" action="customer.php" method="get">
		      <p><input type="text" name="search" placeholder="Order search..." />&nbsp;<input type="submit" value="Search" /></p>
		    </form>  
          </div>  
          
          <!-- End of list items -->
          <div>
        	  <table class="cart">
                <tr>
                  <th>Customer ID</th>
                  <th>Customer</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                </tr>
                <!-- //Loop thru the $result as $row to extract the values  -->
          		<?php foreach($result as $row) : ?>
          		 <tr>
                  <td><h4><a href="customer_detail.php?customer_id=<?=$row['customer_id']?>"><?=$row['customer_id']?></a></h4></td>
                  <td><a href="customer_detail.php?customer_id=<?=$row['customer_id']?>"><?=$row['first_name']?> <?=$row['last_name']?></a></td>
                  <td><?=$row['email']?></td>
                  <td><?=$row['phone']?></td>
                  <td><?=$row['created_at']?></td>
                  <td><?=$row['updated_at']?></td>
                </tr>
               <?php endforeach; ?>
               </table>
                	
           </div>
            
            
          
          
  
        </div>
        <!-- End of main content -->
        </div>  
      <!-- End of Content -->
      
<?php 
 
  //Include admin footer 
  include 'inc/footer_inc.php';
 
 ?>
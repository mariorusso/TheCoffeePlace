<?php
/**
  file: orders.php
  author: Mario Russo <mariorusso@gmail.com>
  updated: Feb 15 2015
  description: Orders Page TCP   
*/
//Require the project config  
require '../../inc/proj_config.php';

//Set title as Manage Products
$title = 'ORDERS';

if (!isset($_SESSION['adm_logged_in']) || $_SESSION['adm_logged_in'] !== true) {
	$_SESSION['target'] = basename($_SERVER['PHP_SELF']);
	$_SESSION['error_message'] = 'You must be logged in to access the admin';
	header("location: login.php");
	exit ;
}

//conect to database using PDO by the getPDO function
$dbh = getPDO();

//Define the variable $searchtearm empty before search form is submited.
$searchterm = ' ';

//Check if isset GET search
if(isset($_GET['search'])){

  //Sanatize get search string 
  $searchterm = sanatizeString($_GET['search']);
}//End of GET is set

//Query the database to SELECT the product ID, product name, short description, image, category name as category 
//from products and category table, and where deleted is set to 0
  $sql = "SELECT o.order_id,
                 o.customer_id, 
                 o.total,
                 o.date,
                 c.first_name,
                 c.last_name
                 FROM orders o 
                 JOIN customer c on o.customer_id=c.customer_id
                 WHERE o.deleted = 0
                 AND c.first_name LIKE ? 
                 OR c.last_name LIKE ?
                 OR o.order_id LIKE ?
                 OR o.date LIKE ?
                 OR o.total LIKE ?
                 ORDER BY date
                 ";
  //Prepare the query 
  $query = $dbh->prepare($sql);
  
  //Assign the parameters to params variable
  $params = array("%$searchterm%", "%$searchterm%", "%$searchterm%", "%$searchterm%", "%$searchterm%"); 
  
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
            <form id="insert_form" action="orders.php" method="get">
		      <p><input type="text" name="search" placeholder="Order search..." />&nbsp;<input type="submit" value="Search" /></p>
		    </form>  
          </div>  
          
          <!-- End of list items -->
          <div>
        	  <table class="cart">
                <tr>
                  <th>Order ID</th>
                  <th>Date</th>
                  <th>Customer</th>
                  <th>Total</th>
                </tr>
                <!-- //Loop thru the $result as $row to extract the values  -->
          		<?php foreach($result as $row) : ?>
          		 <tr>
                  <td><h4><a href="order_details.php?order_id=<?=$row['order_id']?>"><?=$row['order_id']?></a></h4></td>
                  <td><?=$row['date']?></td>
                  <td><?=$row['first_name']?> <?=$row['last_name']?></td>
                  <td><?=$row['total']?></td>
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
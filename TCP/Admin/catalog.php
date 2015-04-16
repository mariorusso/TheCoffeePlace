<?php
//Require the project config  
require '../../inc/proj_config.php';

//Set title as Manage Products
$title = 'MANAGE PRODUCTS';

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
  $sql = "SELECT p.prod_id,
                 p.name, 
                 p.short_description, 
                 p.image, 
                 c.name as category,
                 p.price
                 FROM products p 
                 JOIN categories c on p.category_id=c.category_id
                 WHERE p.deleted = 0
                 AND p.name LIKE ? 
                 OR c.name LIKE ?
                 OR p.price LIKE ?
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
            <form id="insert_form" action="catalog.php" method="get">
		      <p><input type="text" name="search" placeholder="Product search..."  required/>&nbsp;<input type="submit" value="Search" /></p>
		    </form>  
          </div>  
          
          <!-- //Loop thru the $result as $row to extract the values  -->
          <?php foreach($result as $row) : ?>
          
          <!-- End of list items -->
          <div class="prod">
            <div class="prod_icon">
              <img src="images/<?=$row['image']?>" alt="<?=$row['name']?> photo" width="150" height="150" />
            </div>
            <!--//Echo the product ID and Product name link passing product ID -->
            <h4><a href="edit_prod.php?prod_id=<?=$row['prod_id']?>"><?=$row['name']?></a> - Prod id: <?=$row['prod_id']?></h4>
            
            <!--//Echo the category -->
            <p>Category: <?=$row['category']?></p>
            
            <!--//Echo the short description-->
            <p><?=$row['short_description']?></p>
            
            <!--//Echo the price and link to edit passing the product ID-->
            <p>Price: $<?=$row['price']?> | <a href="edit_prod.php?prod_id=<?=$row['prod_id']?>">Edit</a>.</p>
                       
          </div>
          <!-- End of list items -->
          <?php endforeach; ?>
          
  
        </div>
        <!-- End of main content -->
        </div>  
      <!-- End of Content -->
      
<?php 
 
  //Include admin footer 
  include 'inc/footer_inc.php';
 
 ?>
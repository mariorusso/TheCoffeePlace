<?php
/**
  file: manage_categories.php
  author: Mario Russo <mariorusso@gmail.com>
  updated: Feb 15 2015
  description: Manage Categories Page TCP   
*/

//Require the project config  
require '../../inc/proj_config.php';

$title = 'MANAGE CATEGORIES';

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
  $sql = "SELECT category_id,
                 name, 
                 description, 
                 image
                 FROM categories 
                 WHERE deleted = 0
                 AND name LIKE ? 
                 ORDER BY name
                 ";
  //Prepare the query 
  $query = $dbh->prepare($sql);
  
  //Assign the parameters to params variable
  $params = array("%$searchterm%"); 
  
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
            <form id="insert_form" action="manage_categories.php" method="get">
		      <p><input type="text" name="search" placeholder="Categories search..." />&nbsp;<input type="submit" value="Search" /></p>
		    </form>  
          </div>  
          
          <!-- //Loop thru the $result as $row to extract the values  -->
          <?php foreach($result as $row) : ?>
          
          <!-- End of list items -->
          <div class="prod">
            <div class="prod_icon">
              <img src="images/<?=$row['image']?>" alt="<?=$row['name']?> photo" width="100" height="150" />
            </div>
            <!--//Echo the product ID and Product name link passing product ID -->
            <h4><a href="edit_cat.php?category_id=<?=$row['category_id']?>"><?=$row['name']?></a> - Category id: <?=$row['category_id']?></h4>
            
            <!--//Echo the category -->
            <p>Category: <?=$row['description']?></p>
            
             <!--//Echo the price and link to edit passing the product ID-->
            <p><a href="edit_cat.php?category_id=<?=$row['category_id']?>">Edit</a>.</p>
                       
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
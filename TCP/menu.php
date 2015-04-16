<?php
require '../inc/proj_config.php';

$title = 'MENU';


$dbh = getPDO();

$sql = "SELECT name, image, description, category_id FROM categories WHERE is_active = 1";

//Prepare the query to database.
$query = $dbh->prepare($sql);

//Execute the query.
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

include 'inc/header_inc.php';

?>          
      <div id="breadcrumbs">
        <p><?=$title?></p>
      </div>
      
      <!-- Start of Content --> 
      <div id="content_wrapper"> 
       
        <!-- Menu Page Content starts  -->
        <div id="double_col">
          
          <div class="column_top">
            <h1><?=$title?></h1>
          </div>
          <?php include 'inc/flash_messages.php' ?>
          
          <?php foreach($result as $row) : ?>
          <div class="menu_item">
            <div class="itens_icon">
              <img src="images/<?=$row['image']?>" alt="<?=$row['name']?> icon" width="100" height="150" />
            </div>
            
            <h4><?=$row['name']?></h4>
            
            <p> 
              <?=$row['description']?>
              <br /><a href="cat_list.php?cat_id=<?=$row['category_id']?>">Learn more</a>. 
            </p>
           
          </div> 
          <?php endforeach; ?>
            
        </div>
        <!-- End of menu double col content -->
        
        <!-- //include the specials column -->
        <?php include'inc/specials_inc.php'; ?> 
      
      </div>  
      <!-- End of Content -->
      
<?php 
 
 include 'inc/footer_inc.php';
 
 ?>
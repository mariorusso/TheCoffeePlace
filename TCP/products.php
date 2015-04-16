<?php
require '../inc/proj_config.php';

$title = 'SEARCH RESULTS';

//conect to database using PDO by the getPDO function
$dbh = getPDO();

//Define the variable $searchtearm empty before search form is submited.
$searchterm = ' ';

//Check if isset GET search
if(isset($_GET['search_field'])){

  //Sanatize get search string 
  $searchterm = sanatizeString($_GET['search_field']);
}//End of GET is set

//Query the database to SELECT the product ID, product name, short description, image, category name as category 
//from products and category table, and where deleted is set to 0
  $sql = "SELECT p.prod_id,
                 p.name, 
                 p.short_description, 
                 p.image,
                 p.quantity, 
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

if($_SERVER['REQUEST_METHOD'] == 'POST'){
   if(!isset($_POST['xsrf_token']) || $_POST['xsrf_token'] !== $_SESSION['xsrf_token']) {
          die("Something went wrong, Invalid form submission. SORRY!");
    }
  
  $sql = "SELECT name, price FROM products WHERE prod_id = ?";
  
  $prod_id = intval($_POST['prod_id']);
  $qty = intval($_POST['qty']);
  
  $query = $dbh->prepare($sql);
  
  $params = array($prod_id); 
  
  $query->execute($params);
  $row = $query->fetch(PDO::FETCH_ASSOC);
  
  $line_total = number_format($row['price'] * $qty, 2);
  
  $line_item = array(
    'prod_id'=>$prod_id,
    'name'=>$row['name'],
    'price'=>number_format($row['price'], 2),
    'qty'=>$qty,
    'line_total'=>$line_total    
  );
  
  $cart[$prod_id] = $line_item;
  $_SESSION['success_message'] =  'Item successfully added to cart!';
}   
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
          <div class="prod">
            <div class="prod_icon">
              <img src="images/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?> photo" width="150" height="150" />
            </div>
            
            <h4><a href="prod_detail.php?prod_id=<?php echo $row['prod_id']; ?>"><?php echo $row['name']; ?></a></h4>
            
            <!--//Echo the category -->
            <p>Category: <?=$row['category']?></p>
            
            <p><?php echo $row['short_description']; ?></p>
            <p>Price: $<?php echo $row['price']; ?> | <a href="prod_detail.php?prod_id=<?php echo $row['prod_id']; ?>">Details</a>.</p>
            
            <p>
              <form action="<?php basename($_SERVER['PHP_SELF']); ?>" method="post">
                <input type="hidden" name="xsrf_token" value="<?php echo $_SESSION['xsrf_token'] ?>" />
                <input type="hidden" name="prod_id" value="<?=$row['prod_id']; ?>" />
                    <select name="qty">
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                      <option>6</option>
                      <option>7</option>
                      <option>8</option>
                      <option>9</option>
                      <option>10</option>
                    </select>
                    <input type="submit" value="add to cart" />
                    
                  </form> 
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
<?php
require '../inc/proj_config.php';

$addtocart = false;

if(isset($_GET['prod_id'])){
  
  $prod_id = intval($_GET['prod_id']);
                        
  //conect to database using PDO by the getPDO function
  $dbh = getPDO();

  //Query the database 
  $sql = "SELECT prod_id, name, short_description, long_description, image, price FROM products WHERE prod_id = ?";

  //Prepare the query to database.
  $query = $dbh->prepare($sql);

  $params = array($prod_id);
  
  //Execute the query.
  $query->execute($params);
  $result = $query->fetch(PDO::FETCH_ASSOC);
  
  $title = prettyString($result['name']);
  
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $qty = intval($_POST['qty']);
    
    $line_total = number_format($result['price'] * $qty, 2);
  
    $line_item = array(
      'prod_id'=>$prod_id,
      'name'=>$result['name'],
      'price'=>number_format($result['price'], 2),
      'qty'=>$qty,
      'line_total'=>$line_total    
    );
  
    $cart[$prod_id] = $line_item;
    $_SESSION['success_message'] =  'Item successfully added to cart!';
	
    foreach($cart as $row){
     $addtocart = $row['prod_id'];	 
   }
  }
    

}


include 'inc/header_inc.php';

?>        
      <div id="breadcrumbs">
        <p><?=$title?></p>
      </div>
      <!-- Start of Content --> 
      <div id="content_wrapper"> 
       
        
        <div>
          
          <div class="column_top">
            <h1><?=$title?></h1>
          </div>
          <?php include 'inc/flash_messages.php' ?>
          
          <div class="prod_img">
            <img src="images/<?=$result['image']?>" alt="<?=$result['name']?> photo" width="300" height="300" />
            <div class="prod_bottom">
              <h2>Long Description</h2>
              <p><?=$result['long_description']?></p>
            </div>
          </div>
          
          
          <div class="prod_info">
            <h2>Short Description</h2>
            <p><?=$result['short_description']?></p>
            
            <p><span class="price">$<?=$result['price']?></span>
              <form action="<?php basename($_SERVER['PHP_SELF']); ?>" method="post">
                <input type="hidden" name="prod_id" value="<?=$addtocart; ?>" />
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
        
      	<!-- //include the specials column -->
        <?php include'inc/specials_inc.php'; ?> 
         
        </div>
        
      </div>  
      <!-- End of Content -->
      
<?php 
 
 include 'inc/footer_inc.php';
 
 ?>
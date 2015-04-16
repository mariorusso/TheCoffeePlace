<?php

require '../inc/proj_config.php';

$title = 'PRODUCTS';

//conect to database using PDO by the getPDO function
$dbh = getPDO();

//Query the database 
$sql = "SELECT p.prod_id, p.name, c.name as category, c.category_id, p.price FROM products p JOIN categories c on p.category_id=c.category_id";

//Prepare the query to database.
$query = $dbh->prepare($sql);
  
//Execute the query.
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
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
          
          <table id="product">
            <tr>
              <th>Product ID</th>
              <th>Name</th>
              <th>Category</th>
              <th>Price</th>
              <th>Add to cart</th>
              
            </tr>
            <?php foreach($result as $row) : ?>
            <tr>
              <td><?php echo $row['prod_id']; ?></td>
		      <td><a href="prod_detail.php?prod_id=<?php echo $row['prod_id']; ?>"><?php echo $row['name']; ?></a></td>
		      <td><a href="publisher_detail.php?category_id=<?php echo $row['category_id']; ?>"><?php echo $row['category']; ?></a></td>
		      <td>$ <?php echo $row['price']; ?></td>
              <td><form action="products.php" method="post">
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
                    <input type="submit" value="add" />
                    
                  </form> 
              </td>
            </tr>
             
            
            <?php endforeach; ?>
            
            
          </table>
          
        </div>
        <!-- End of menu double col content -->
        
        <!-- Start of menu special itens right col --> 
        <div id="menu_special">
          <h2 style="color: #eee;">specials</h2>
          
          <div class="itens">
            <div class="itens_icon">
              <img src="images/coffee_cup.jpg" alt="coffee cup icon" width="100" height="150" />
            </div>
            
            <h4>Dark Blend</h4>
            
            <p> 
              The dark blend is the perfect blend of the dark and very dark roast giving you the perfect taste.
              <br /><a href="#">Learn more</a>. 
            </p>
                                                                                                                                      
          </div>
          
          <div class="itens">
            <div class="itens_icon">
              <img src="images/coxinha_icon.jpg" alt="coxinha icon" width="100" height="150" />
            </div>
            
            <h4>Chicken Drop</h4>
            
            <p> 
              The Chicken Drop is a very common and tastefull snack from Brazil that you can try at The Coffee Place.
              <br /><a href="#">Learn more</a>. 
            </p>
                                                                                                                                      
          </div>
          
          <div class="itens">
            <div class="itens_icon">
              <img src="images/combo.jpg" alt="combo icon" width="100" height="150" />
            </div>
            
            <h4>$3 Combo</h4>
            
            <p> 
              The 3 dollar combo is a great opportunity to try a tasty Brazilian snack with a great coffee.
              <br /><a href="#">Learn more</a>. 
            </p>
                                                                                                                                      
          </div>
     
        </div>
        <!-- End of menu special itens right col --> 
          
      </div>  
      <!-- End of Content -->
      
<?php 
 
 include 'inc/footer_inc.php';
 
 ?>
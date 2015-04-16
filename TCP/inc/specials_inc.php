<?php

$title = 'MENU';


$dbh = getPDO();

$sql = "SELECT name, image, short_description, prod_id FROM products WHERE featured = 1";

//Prepare the query to database.
$query = $dbh->prepare($sql);

//Execute the query.
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);



?>
<!-- Start of menu special itens right col --> 
        <div id="menu_special">
          <h2 style="color: #eee;">specials</h2>
          
          <?php foreach ($result as $row) : ?>
              
          <div class="itens">
            <div class="itens_icon">
              <img src="images/<?=$row['image']?>" alt="<?=$row['name']?> icon" width="100" height="100" />
            </div>
            
            <h4><?=$row['name']?></h4>
            
            <p> 
              <?=$row['short_description']?>
              <br /><a href="prod_detail.php?prod_id=<?=$row['prod_id']?>">Learn more</a>. 
            </p>
                                                                                                                                      
          </div>
          <?php endforeach; ?>
               
        </div>
        <!-- End of menu special itens right col -->
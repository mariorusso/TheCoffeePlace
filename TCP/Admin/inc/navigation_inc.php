<!-- Start of navigation bar -->
      <nav>
      
        <div id="menubutton"><a href="#" id="menulink"> </a>
        
          <ul>
            <li><a class="<?php if($title == 'DASHBOARD'){echo 'current';}?>" href="index.php" title="Admin dashboard">
                 DASHBOARD
                </a>
            </li>
            <li><a class="<?php if($title == 'ORDERS'){echo 'current';}?>" href="orders.php" title="View sales">
                  ORDERS
                </a>
            </li>
            <li><a class="<?php if($title == 'MANAGE PRODUCTS'){echo 'current';}?>" href="catalog.php" title="Catalog and product infromation">
                  CATALOG
                </a>
              <ul>
                <li><a class="<?php if($title == 'ADD PRODUCTS'){echo 'current';}?>" href="add_products.php">ADD PRODUCTS</a></li>
                <li><a class="<?php if($title == 'MANAGE PRODUCTS'){echo 'current';}?>" href="catalog.php">MANAGE PRODUCTS</a></li>
                <li><a class="<?php if($title == 'ADD CATEGORIES'){echo 'current';}?>" href="add_categories.php">ADD CATEGORIES</a></li>
                <li><a class="<?php if($title == 'MANAGE CATEGORIES'){echo 'current';}?>" href="manage_categories.php">MANAGE CATGORIES</a></li>
              </ul>
            </li>
            <li><a class="<?php if($title == 'MANAGE CUSTOMERS'){echo 'current';}?>" href="customer.php" 
                   title="Learn more about our rewards program">
                   CUSTOMER
                </a>
              <ul>
                <li><a class="<?php if($title == 'ADD CUSTOMER'){echo 'current';}?>" href="add_customer.php">ADD CUSTOMER</a></li>
                <li><a class="<?php if($title == 'MANAGE CUSTOMERS'){echo 'current';}?>" href="customer.php">MANAGE CUSTOMER</a></li>
              </ul>
            </li>                     
          </ul>
          
        </div>
      </nav><!-- End of the navigation bar -->
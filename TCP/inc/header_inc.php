<!doctype html>
<html lang="en">
  <head> 
    <title><?=$title?></title>
    <meta charset="utf-8" />
    <meta name="description" content="The Coffee Place. We offer Fresh Coffee everytime, hot beverages and many quick meal options." />
    <meta name="keywords" content="coffee, brazilian coffee, quick meal" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    
    <!-- google fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,700%7cOxygen:300,700' rel='stylesheet' type='text/css'> 
    
    <!-- desktop css -->
    <link rel="stylesheet" type="text/css" media="screen and (min-width: 601px)" href="styles/tcp_desktop.css" />
    
    <!-- mobile css -->
    <link rel="stylesheet" type="text/css" media="screen and (max-width: 601px)" href="styles/tcp_mobile.css" /> 
    
    <!-- Print css -->
    <link rel="stylesheet" type="text/css" media="print" href="styles/tcp_print.css" />  
    
    <!-- Start of CSS styles -->
    
    <!--[if IE]>
    
       <link rel="stylesheet" type="text/css" href="styles/tcp_desktop.css" />
  
    </style>
    <![endif]-->
  
    <!--[if LT IE 9]>
      <script type="text/javascript">
        document.createElement('header');
        document.createElement('nav');
        document.createElement('footer');
        document.createElement('article');
      </script>     
      <style type="text/css">
        header, nav, footer, article{
         display:block;
        }
      </style>
    <![endif]-->
    <!-- End of CSS styles -->
    
  </head>
  <!-- End of head -->

  <!-- Start of body -->
  <body>
    <!-- Start of page wrapper -->
    <div id="wrapper">
    
      <!-- Start of header -->
      <header>
        <div id="logo">
          <a href="index.php" title="The Coffee Place Home Page"><img src="images/logo_mobile.jpg" alt="logo the coffee place" width="162" height="98"/> </a>
        </div>
        
        <!-- Start of Header Social Icons -->
        <div class="social_icons">
        
          <div class="fb"><a href="#"> </a></div>
          
          <div class="tw"><a href="#"> </a></div>
          
          <div class="ist"><a href="#"> </a></div>
        
        </div>
        <!-- End of Header Social Icons -->
      
        <!-- Start of search box -->
        <div id="search">
        
          <form 
            action="products.php"
            method="get"
            name="search_form"
            id="search_form"
           >
           
             <input type="text" name="search_field" id="search_field" placeholder="Search on this site..." required />
             <input type="submit" value=""/>
             
          </form>
          
        </div>
        <!-- end of search box -->
        <a href="cart.php">
          
        <div id='cart'>
              
            <img src="images/cartl.jpg" alt="cart icon"/> <p> Items in cart: <strong><?=count($cart)?></strong></p>
            
        </div>
          
        </a>
        
        <div class="logout">
          <?php if(!isset($_SESSION['logged_in']) ||  $_SESSION['logged_in'] != true) : ?>
            <p><a href="register.php">Register</a> | <a href="login.php">Login</a></p>
            
          <?php else : ?> 
            <p><a href="register.php">Register</a> | <a href="login.php?logged_out=1">Logout</a></p>
            
          <?php endif; ?>
        </div>
        
      </header><!-- End of header -->
      
      <?php include 'inc/navigation_inc.php'; ?>
      
      <!-- Top banner -->
      <div id="top_banner">
      </div>
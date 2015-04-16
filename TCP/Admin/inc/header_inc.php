<!doctype html>
<html lang="en">
  <head> 
    <title><?=$title?></title>
    <meta charset="utf-8" />
    <meta name="description" content="The Coffee Place. Administration Page." />
    <meta name="keywords" content="coffee, brazilian coffee, quick meal" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    
    <!-- google fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,700%7cOxygen:300,700' rel='stylesheet' type='text/css'> 
    
    <!-- desktop css -->
    <link rel="stylesheet" type="text/css" media="screen and (min-width: 601px)" href="styles/adm_desktop.css" />
    
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
          <a href="index.php" title="Admin dashboard page"></a>
        </div>
        
        <div id="adm">
          <p>Admin Panel</p>          
        </div>
        
        <div class="logout">
          <?php if(!isset($_SESSION['adm_logged_in']) ||  $_SESSION['adm_logged_in'] != true) : ?>
            <p><a href="register.php">Register new user</a> | <a href="login.php">Login</a></p>
            
          <?php else : ?> 
            <p><a href="register.php">Register new user</a> | <a href="login.php?logged_out=1">Logout</a></p>
            
          <?php endif; ?>
        </div>
      </header><!-- End of header -->
      
      <?php include 'inc/navigation_inc.php'; ?>
      
      
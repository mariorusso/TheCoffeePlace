<?php

$title = 'Upload Files';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  
  $tmp = $_FILES['fileToUpload']['tmp_name'];
  $path = '/wamp/www/advancedPHP/ShoppingCart/images/';
  $file = $_FILES['fileToUpload']['name'];
  $target = $path . $file;
  
  move_uploaded_file($tmp, $target);
 
}
?><!doctype html>

<html lang="en">
  <head> 
    <title><?=$title?></title>
    <meta charset="utf-8" />
  </head>

  <body>
   <form action="upload_file.php" method="post" enctype="multipart/form-data">
     Select Image to Upload:<br />
     <input type="file" name="fileToUpload" id="fileToUpload"><br />
     <input type="submit" value="Upload Image" name="submit">
     
        
   </form>        
    
    <img src="images/<?=$file?>" />

  </body>  
</html>
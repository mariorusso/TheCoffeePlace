<?php if(isset($_SESSION['error_message']) or isset($_SESSION['success_message'])) : ?>
    
  <?php 
    $class = (isset($_SESSION['error_message'])) ? 'error_message' : 'success_message' ;

    $message = (isset($_SESSION['error_message'])) ? $_SESSION['error_message'] : $_SESSION['success_message'];
?>

<div class="flash_message <?=$class?>">
    <p><?=$message?></p>
  
  <?php unset($_SESSION['error_message']); unset($_SESSION['success_message']); ?>

</div>

<?php endif; ?>
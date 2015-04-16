      <!-- Start of footer -->
      <footer>
        
        <div id="admin_info">
        	
          <?php if(!isset($_SESSION['adm_logged_in']) ||  $_SESSION['adm_logged_in'] != true) : ?>
            <p>You are using the admin page <a href="login.php">Login</a></p>
            
          <?php else : ?> 
            <p>You are using the admin page <a href="login.php?logged_out=1">Logout</a></p>
            
          <?php endif; ?>
         
        </div>
        
        <div id="copyright">
          <p>&copy;2015 The Coffee Place. All rights reserved.</p> 
        </div>        
        
        
      </footer>
      <!-- End of footer -->
    
    </div>
    <!-- End of wrapper -->
  
  </body><!-- End of body -->   
</html>
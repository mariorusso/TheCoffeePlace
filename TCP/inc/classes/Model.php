<?php
/**
  file: Model.php
  author: Mario Russo <mariorusso@gmail.com>
  updated: Jan 26 2015
  description: Model Class
*/

class Model {
  
  protected $dbh;
  
  public function __construct() {
    
       $this->dbh = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME , DB_USER, DB_PASS);
             $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
 
  public function getDbh(){
    return $this->$dbh;
  }
}//End of Model 

<?php
/**
  file: Model.php
  author: Mario Russo mariorusso@gmail.com>
  updated: Jan 26 2015
  description: Customer Class
*/

class Admuser_model extends Model {
  
  private $user_id;
  private $name;
  private $email;
  private $password;
  
  
  public function __construct($adm_user = null){
    parent::__construct();
    if(!is_null($adm_user)){
    $this->hydrateUser($adm_user);
    }
    
  }
  
  public function insert(){
    
        
   //Query the database 
    $sql = "INSERT INTO adm_user ( email, password, name )
            VALUES ( :email, :password, :name )";
    
    //Prepare the query to database.
    $query = $this->dbh->prepare($sql);
    
    //Set the parameters to be executed associating the prepared statement 
    //to the the variables with the values that we got from the form POST.
    $params = array( 
                ':name'=>$this->name,
                ':email'=>$this->email,
                ':password'=>$this->password
              );
    
    //Execute the query.
    $query->execute($params); 
    
  }
  
  private function generatePassword($password){
    //encrypt the password. 
    $salt = uniqid('$2y$10$', true);
    $this->password = crypt($password, $salt);
  }
  
  public function hydrateUser($adm_user){
   foreach($adm_user as $key => $value){
     $this->$key = $value;
   }
    $this->generatePassword($adm_user['password']);
  }
  
  public function getOne(){
    $customer_id = $dbh->lastInsertId();
    
    $query = $dbh->prepare('SELECT * FROM customer WHERE user_id = ?');
    
    $params = array($user_id);
    
    $query->execute($params);
    
    $customer = $query->fetch(PDO::FETCH_ASSOC);
  }
    
  
  
}// End of customer class

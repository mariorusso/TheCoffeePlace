<?php
/**
  file: Model.php
  author: Mario Russo <mariorusso@gmail.com>
  updated: Jan 26 2015
  description: Customer Class
*/

class Customer_model extends Model {
  
  private $customer_id;
  private $first_name;
  private $last_name;
  private $email;
  private $street_1;
  private $street_2;
  private $city;
  private $province;
  private $postal_code;
  private $phone;
  private $password;
  
  
  public function __construct($customer = null){
    parent::__construct();
    if(!is_null($customer)){
    $this->hydrateCustomer($customer);
    }
    
  }
  
  public function insert(){
    
        
   //Query the database 
    $sql = "INSERT INTO customer ( email, password, first_name, last_name, street_1, street_2, city, province, postal_code, phone )
            VALUES ( :email, :password, :firstname, :lastname, :street1, :street2, :city, :province, :postal_code, :phone )";
    
    //Prepare the query to database.
    $query = $this->dbh->prepare($sql);
    
    //Set the parameters to be executed associating the prepared statement 
    //to the the variables with the values that we got from the form POST.
    $params = array( 
                ':firstname'=>$this->first_name,
                ':lastname'=>$this->last_name,
                ':email'=>$this->email,
                ':street1'=>$this->street_1,
                ':street2'=>$this->street_2,
                ':city'=>$this->city,
                ':province'=>$this->province,
                ':postal_code'=>$this->postal_code,
                ':phone'=>$this->phone,
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
  
  public function hydrateCustomer($customer){
   foreach($customer as $key => $value){
     $this->$key = $value;
   }
    $this->generatePassword($customer['password']);
  }
  
  public function getOne(){
    $customer_id = $dbh->lastInsertId();
    
    $query = $dbh->prepare('SELECT * FROM customer WHERE customer_id = ?');
    
    $params = array($customer_id);
    
    $query->execute($params);
    
    $customer = $query->fetch(PDO::FETCH_ASSOC);
  }
    
  
  
}// End of customer class

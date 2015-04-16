<?php
/**
  file: User.php
  author: Mario Russo <mariorusso@gmail.com>
  updated: Jan 27 2015
  description: User Class
*/

$title = "User Class";

class User {
  
  private $first_name;
  private $last_name;
  private $street1;
  private $street2;
  private $city;
  private $province;
  private $email;
  private $phone;
  private $password;
  
  
  public function __construct($email, $password) {
    
    $this->email = $email;
    $this->password = $password;
  }
  
  public function setFirstName($first_name){
    $this->first_name = $first_name;
  }
  
  public function setLastName($last_name){
    $this->last_name = $last_name;
  }
  
   public function setStreet1($street1){
    $this->street1 = $street1;
  }
  
   public function setStreet2($street2){
    $this->street2 = $street2;
  }
  
   public function setCity($city){
    $this->city = $city;
  }
  
   public function setProvince($province){
    $this->province = $province;
  }
  
   public function setEmail($email){
    $this->email = $email;
  }
  
   public function setPhone($phone){
    $this->phone = $phone;
  }
  
   public function setPassword($password){
    $this->password = $password;
  }
  
  // need to finish the get function
  
  public function getEmail() {
    return $this->email;
  }
  
  
  public function getPass() {
    return $this->password;
  }
  
 }// End User

$mario = new User('mariorusso@gmail.com', 'weuijdsn');

print_r($mario);

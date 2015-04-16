<?php
/**
  file: Person.php
  author: Mario Russo <mariorusso@gmail.com>
  updated: Jan 26 2015
  description: Person Clas
*/

$title = "Person Class";

class Person {
  
  protected $name;
  protected $age;
  
  public function __construct($name, $age) {
    
    $this->name = $name;
    $this->age = $age;
  }
  
  
  public function getAge() {
    return $this->age;
  }
  
  
  public function getName() {
    return $this->name;
  }
  
  public function ageOneYear(){
    $this->age += 1;
  }
}// End Person

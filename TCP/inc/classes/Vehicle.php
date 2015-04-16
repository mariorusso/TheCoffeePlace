

<?php
/**
  file: Vehicle.php
  author: Mario Russo <mariorusso@gmail.com>
  updated: Jan 27 2015
  description: Vehicle Class
*/

class Vehicle {
  
  protected $wheels;
  protected $engine_size;
  
  public function __construct($wheels, $engine_size) {
    
  }
 
  protected function setWheels($wheels){
    $this->wheels = $wheels;
  }
  
  
  protected function setEngineSize($engine_size){
    $this->engine_size = $engine_size;
  }
  
  public function getWheels() {
    return $this->wheels;
  }
  
  public function getEngineSize() {
    return $this->engine_size;
  }
}//End of Vehicle

class Car extends Vehicle {
  
  private $model = null;
  private $year = null;
  private $color = null;
  private $price = null;
  
}

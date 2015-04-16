<?php
/**
  file: Validtor.php
  author: Mario Russo <mariorusso@gmail.com>
  updated: Jan 26 2015
  description: Validator Class
*/
class Validator {
 
  /**
	strips tags and removes surrounding whitespace from strings
  */
  static function sanitizeString($string){
    $string = strip_tags($string);
    $string = trim($string);
    return $string;
  }
  
  /*
	Check to ensure number is within range
  */
  static function validateInteger($int, $min , $max, $field){
  
    $int = intval($int);
    
    if($int < $min){
    return "$field is less than $min";
    }
    elseif($int > $max){
      return "$field is greater than $max";
    }
    else{
    return '';
    }
  }
  
  /*
	Validate a string and return and error message if required
  */
  static function checkRequired($string, $field){
  
    if(empty($string)) {
      return "$field, is a required field.";
    }
    else{
      return '';  
    }
  }
}//End of Validator 

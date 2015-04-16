<?php
/**
  file: Student.php
  author: Mario Russo <mariorusso@gmail.com>
  updated: Jan 26 2015
  description: Student Clas
*/

$title = "Student Class";

class Student extends Person {
  
  private $student_id;
  private $school;
  private $gpa;
  
  public function __construct($name, $age, $student_id, $school) {
    
    parent::__construct($name, $age);
    
    $this->student_id = $student_id;
    $this->school = $school;
  }
  
}// End Student

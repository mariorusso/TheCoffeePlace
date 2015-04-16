<?php
/*
My functions
*/

/**
  getPDO - returns a PHP PDO object
*/
function getPDO(){
  //Connect to Database
  $dbh = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
	
  return $dbh;
}

/**
	getLink - returns a MySQL connection resource
*/
function getlink(){
  //Connect to Database
  $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)
         or die(mysqli_connect_error($link)); 
  
  return $link;
}

function getSubTotal($cart){
$subtotal = 0;	
 foreach($cart as $row){
	foreach($row as $key => $value){
		if($key == 'line_total'){
			$subtotal += $value;
		}
    }
 }
 return $subtotal;
}

function getGST($subtotal){
	$GST = $subtotal*0.05;
	return $GST;
}

function getPST($subtotal){
	$PST = $subtotal*0.08;
	return $PST;
}

/*
	Validate a string and return and error message if required
*/
function validateString($string, $field){
  
  if(empty($string)) {
     return "$field, is a required field.";
  }
  else{
    return '';  
  }
}


/*
	strips tags and removes surrounding whitespace from strings
*/
function sanatizeString($string){
  $string = strip_tags($string);
  $string = trim($string);
  return $string;
}

/*
	Check to ensure number is within range
*/
function validateInteger($int, $min , $max, $field){
  
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

function getColumns($result){
  //Get columns
  $row = current($result); //get first result
  $columns = array_keys($row);//array_keys returns an array of just keys 
  
  // Convert the Id fields into a reading friendly format using & before $heading so it refers to the $columns variable. 
  foreach($columns as &$heading){
    
    //Call function to fix the field to a readble way.
    $heading = prettyString($heading);
    
  }
  
  //Return columns with the new format assigned to $heading.
  return $columns;
}

/* FORM FUNCTIONS */

/**
  Create the opening part of a form.
*/
function formOpen($method = 'post', $action = '#', $form_id){
if($action == '#'){
  $action = basename($_SERVER['PHP_SELF']); 
}
  $form = <<<EOT
      <form method='$method' action='$action' id='$form_id'>\n
EOT;
  return $form;
}

/**
  Create the closing tag of a form.
*/
function formClose(){
  $form = <<<EOT
      </form>
EOT;
  return $form;
}

function createFilledTextInput($field, $length, $info){
  $label = prettyString($field);
  $value = $info;
  $input = <<<EOT
    
      <label for='$field'>$label</label>
       <input type='text' name='$field' id='$field' maxlength='$length' value='$value' />
         
EOT;
  return $input;
}

/** 
  Create an Input field, for the form accept 2 values 
  $field and $length adds the values to the determined field.
*/
function createTextInput($field, $length){
  $label = prettyString($field);
  $value = getPost($field);
  $input = <<<EOT
    
      <label for='$field'>$label</label>
       <input type='text' name='$field' id='$field' maxlength='$length' value='$value' />
          
EOT;
  return $input;
}


function createTextArea($field){
  $label = prettyString($field);
  $value = getPost($field);  
  $input = <<<EOT
    
       <label for="$field">$label</label>
       <textarea name="$field" id="$field" cols="30" rows="6">$value</textarea>
    
EOT;
  return $input;
}

function createFilledTextArea($field, $info){
  $label = prettyString($field);
  $value = $info;  
  $input = <<<EOT
       <label for="$field">$label</label>
       <textarea name="$field" id="$field" cols="30" rows="6">$value</textarea>
    
EOT;
  return $input;
}

function createCheckbox($field){
 $label = prettyString($field);
  $value = getPost($field);
  $input = <<<EOT
    <p>
      <input type="checkbox" name="$field" id="$field" value="1" />
      <label for="$field">$label</label>        
    </p>
EOT;
  return $input;
}
/** 
  Create an Input field, for the form accept 2 values 
  $field and $length adds the values to the determined field.
*/
function createPasswordInput($field, $length){
  $label = prettyString($field);
  $value = getPost($field);
  $input = <<<EOT
    <p>
      <label for='$field'>$label</label>
       <input type='password' name='$field' id='$field' maxlength='$length' value='$value' />
          </p>
EOT;
  return $input;
}

/**
  Create the submit button to the form.
*/
function createSubmit(){
$input = <<<EOT
  <p><input type="reset" value="Clear" /> <input type="submit" value="Send" /></p>
EOT;
  return $input;
}
/**
  Convert string to a nice human readable string
  accept one value $string, replace the underscor
  "_" with a blank space on the string. 
  And capitalize the the first letter with ucwords. 
*/
function prettyString($string){
  //Replace underscore for space
    $string = str_replace('_', ' ', $string);
    
    //Capitalize words in the heading 
    $string = ucwords($string);
  
  return $string;
}
/**
  Function that get the $_POST field and display it if is not empty.
*/
function getPost($field){
  if(!empty($_POST[$field])){
    
    return $_POST[$field];
  } 
  else {
      return '';
    }
}

/**
  function to create a select box with the canadian provinces.
*/
function getRegion($field){

// Array of canadian provinces.
$provinces = array( 
    "BC" => "British Columbia", 
    "ON" => "Ontario", 
    "NL" => "Newfoundland and Labrador", 
    "NS" => "Nova Scotia", 
    "PE" => "Prince Edward Island", 
    "NB" => "New Brunswick", 
    "QC" => "Quebec", 
    "MB" => "Manitoba", 
    "SK" => "Saskatchewan", 
    "AB" => "Alberta", 
    "NT" => "Northwest Territories", 
    "NU" => "Nunavut",
    "YT" => "Yukon Territory"
);
  $label = prettyString($field);
  $select = "<p><label for='$field'>$label</label>\n";
  $select .= "<select name='$field'>";  
  $select .= "<option>Select Province</option>\n";
  foreach($provinces as $key => $value){
    $select .= "<option value='$key'>$value</option></p>\n";  
  }
  
  $select .= "</select>\n";
  return $select;
}

/**
 function to get the category,  from DB acepts two parameters @field wich is the name value 
 and @id that is by default empty and receive the value of the cat_id for the populated form. 
 */
function getCategory($field, $id=' '){
 	//connect to database
    $dbh = getPDO();
    
    //Query the database 
    $sql = "SELECT category_id, name FROM categories";
    
    //Prepare the query to database.
    $query = $dbh->prepare($sql);
       
    //Execute the query.
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
     
    //define the label as a readable for humam.
    $label = prettyString($field);
	
	//Define the select box label
    $select = "<label for='$field'>$label</label>\n";
    
    //Start the select box 
    $select .= "<select name='$field' id='$field'>";  
    
	//Define the first option in the define box
    $select .= "<option>Select a Category</option>\n";
    
	//Loop through the $result to get each row to populate the option form 
    foreach($result as $row){
    	
		//if $row category id is == the passed id define it as selected. Else selected is empty  	 
		if($row['category_id'] == $id){
			$selected = 'selected="selected"';
		}else{
			$selected = ' ';
		}
		
	  //Display each option.			
      $select .= "<option value='{$row['category_id']}' {$selected}>{$row['name']}</option>\n";

    } 
    $select .= "</select>\n";
	
	//return the $select variable.
    return $select;
}

/*  
function __autoload($class_name){
  include '../inc/classes/' . $class_name . '.php';
}*/
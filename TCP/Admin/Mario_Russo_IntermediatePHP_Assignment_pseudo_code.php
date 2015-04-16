<?php
/**
  file: pseudo_code.php
  author: Mario Russo <mariorusso@gmail.com>
  updated: Feb 01 2015
  description: pseudo code assignment intermediate php 
*/

//START

  //Set title variable to the page title. 

  //require the config files that include the functions.

  //set errors into false.

  //check if have post method.
  
    //If have POST method true.

      //Use a foreach loop trhu $_POST and ensure all fields were filled in or set error
  
        //If empty display set error. 
      
    //End of If statement.
 
    //If NO errors
      
      //Sanatize $_POST and ssign the $_POST variable to normal variables. 
    
      //Setting the checkbox Featured

        //If check box is checked assign it to a variable and set a value 1
    
        //$featured is checked and value = 1

        //ELSE $featured is not checked and value=0
      
    //End of If statement.

    //conect to database using PDO by the getPDO function
       
    //Query the database to insert into Products, passing the values with placeholders.
    
    //Prepare the query to database.
      
    //Set the parameters to be executed associating the prepared statement 
    //to the the variables with the values that we got from the form POST.

    //Execute the query.
  
    
    // SELECT THE NEW PRODUCT FOR DISPLAY
  
    //assign the prod_id to the last insetrted ID.
  
    
    //Query the database t SELECT every field from products WHERE the ID is the last ID.
      
    //Set the parameters to execute the Query using prod_id variable as the parameter.
      
    //execute the query with the parameter and get the result assigning the $product variable.
      
    //End of if not errors
  
  // End of have $_post

  //include the header for the admin.
        
  //Echo the title variable in the breadcrumb div

  //Echo the title variable in the H1

  //Include the admin sidebar div

  //If Errors display the errors in a SPECIAL DIV

    //Loop trhu the $errors array and assign it as key and variable
                
      //Echo the Error variable using the prettyString Function.    
        
    //End the loop trhu the $errors array

  //End if errors statement
        
  //Check if the variable product is set

    //If the product variable is set, create a table and show the product information

      //To show the result use foreach loop trhu the $product array as key and value

        //Echo the key using prettyString function and and the value 
              
      //End the foreach loop 

  //ELSE show the form -->  
  
  //Open the form using the function FromOpen passing the method, action, and id

  //Create the necessary inputs to the form using the functions.

  //Close the form -->
    
  //End the if statement -->
  
  // Include the admin footer. 

//END

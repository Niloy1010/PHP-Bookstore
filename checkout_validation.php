<?php
   // Check for form submission:
    require('mysqli_connect.php');
    $errors = [];
  //  $numberRegex = "`^[4-9]{4}[0-9]{12}$`";
    $yearRegex = "`^20[0-9]{2}$`";
    $cvvRegex = "`^[0-9]{3}$`";

   if ($_SERVER['REQUEST_METHOD'] == 'POST') {   
       
      // Check for a first name:
      if (empty($_REQUEST["firstname"]) ) {
          $errors = "error";
         $fname = 'Please enter your First name';
      
      } else {
          $fname="";
         $fn= mysqli_real_escape_string($dbc,  trim($_REQUEST['firstname']));
      }
   
     // Check for a last name:
     if (empty($_REQUEST['lastname'])) {
        $errors = "error";
        $lname = 'Please enter your Last name.';
     } else {
         $lname = "";
         $ln = mysqli_real_escape_string($dbc, trim($_REQUEST['lastname']));
     }
       
    if (empty($_REQUEST['address'])) {
        $errors = "error";
        $address = 'You forgot to enter your address.';
     } else {
         $address= "";
         $add = mysqli_real_escape_string($dbc, trim($_REQUEST['address']));
     }
       
      
      if (empty($_REQUEST['cardname'])) {
        $errors = "error";
        $cname = 'You forgot to enter your cardname.';
     } else {
        $cname = '';
         $cnm = mysqli_real_escape_string($dbc, trim($_REQUEST['cardname']));
     }
       
    //  if (empty($_REQUEST['cardnumber']) || !preg_match($numberRegex,$_REQUEST['cardnumber'])) {
        if (empty($_REQUEST['cardnumber'])) {
        $errors = "error";
        $cardnumber = 'Please enter valid number for card.';
     } else {
        $cardnumber = '';
         $cn = mysqli_real_escape_string($dbc, trim($_REQUEST['cardnumber']));
     }
         if (empty($_REQUEST['expdate']) || !preg_match($yearRegex,$_REQUEST['expdate'])) {
            $errors = "error";
        $expdate= 'You forgot to enter your expiry date.';
     } else {
        $expdate= '';
         $ed = mysqli_real_escape_string($dbc, trim($_REQUEST['expdate']));
     }
        if (empty($_REQUEST['cvv']) || !preg_match($cvvRegex,$_REQUEST['cvv'])) {
            $errors = "error";
        $cvve = 'You forgot to enter your cvv.';
     } else {
        $cvve = '';
         $cvv = mysqli_real_escape_string($dbc, trim($_REQUEST['cvv']));
     }

    
       

     if (empty($errors)) { // If everything's OK.
        $q = 'INSERT INTO user_details (first_name,last_name,address,card_name,card_number,exp_date,cvv)
         VALUES (?,?,?,?,?,?,?)';
        $stmt = mysqli_prepare($dbc, $q);
        mysqli_stmt_bind_param($stmt, 'ssssssi',$fn, $ln, $add, $cnm,$cn,$ed,$cvv);
        
        $fn = strip_tags($fn);
        $ln = strip_tags($ln);
        $add = strip_tags($add);
        $cnm = strip_tags($cnm);
        $cn = strip_tags($cn);
        $ed = strip_tags($ed);
        $cvv = strip_tags($cvv);
        
        
        mysqli_stmt_execute($stmt);
        
        if(mysqli_stmt_affected_rows($stmt) == 1){

                $qu = "SELECT user_id FROM user_details WHERE
                 first_name LIKE '".$_REQUEST["firstname"]."' AND
                 last_name LIKE '".$_REQUEST["lastname"]."' AND
                 card_number LIKE'".$_REQUEST["cardnumber"]."'
                  ";
                  $ru =  @mysqli_query($dbc, $qu);
                  while ($row = mysqli_fetch_array($ru, MYSQLI_ASSOC)) {
                    echo '{
                        "id":"'.$row['user_id'].'"
                    }';
                break;
                }
                
                
        }
        else{
          
            
            echo '{"error":"cannot enter in database"}';
        }
    }
    else{
        echo '{
                "error":"error",
                "fname":"'.$fname.'",
                "lname":"'.$lname.'",
                "address":"'.$address.'",
                "cname":"'.$cname.'",
                "cardnumber":"'.$cardnumber.'",
                "expdate":"'.$expdate.'",
                "cvv":"'.$cvve.'"
            }';
    }
    
    //     else { // If it did not run OK.
    
    //        // Public message:
    //        echo '<h1>System Error</h1>
    //        <p class="error">You could not be registered due to a system error. We apologize for
    //          any inconvenience.</p>';
    
    //        // Debugging message:           cecho '<p>' . mysqli_error($dbc) . '<br><br>Query: ' . $q . '</p>';
    
    //     } // End of if ($r) IF.
    
    //     mysqli_close($dbc); // Close the database connection.
   
    //     // Include the footer and quit the script:
    //     include('includes/footer.html');
    //     exit();
    
    //  } else { // Report the errors.
   
    //     echo '<h1>Error!</h1>
    //     <p class="error">The following error(s) occurred:<br>';
    //    foreach ($errors as $msg) { // Print each error.
    //        echo " - $msg<br>\n";
    //     }
    //     echo '</p><p>Please try again.</p><p><br></p>';
    
    //  } // End of if (empty($errors)) IF.
    
  } // End of the main Submit conditional.
  ?>
        
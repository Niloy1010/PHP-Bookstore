
<html>

<head>
    
  <meta charset="utf-8">
  <title>Post a Message</title>
</head>

<body>
    
    <?php 
require('mysqli_connect.php');
$q = "select comment FROM message";
$r = @mysqli_query($dbc, $q); 

    
while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        echo "<p>".$row['comment']."</p>";
    }
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    
        $comment= mysqli_real_escape_string($dbc,  trim($_POST['comment']));
    $filteredComment = filter_var($comment,FILTER_SANITIZE_STRING);
    
    $q2 = "INSERT INTO message(comment) VALUES ( '$filteredComment' ) ";
    $r2 = mysqli_query($dbc, $q2); 
    
    
    
    if($r2) {
             echo '<h1>THANK YOU </h1>
             <p>You are now Regestered </p>';
                
         }
    
        else { 
           echo '<h1>System Error</h1>
           <p class="error">You could not be registered due to a system error. We apologize for
             any inconvenience.</p>';
    
    
    
    
        }		
}

        mysqli_close($dbc);
?>
<form action="security.php" method="post">
    
     <fieldset><legend>Message</legend>
         <label for="comment">Enter a comment</label>
     <textarea name="comment" rows="5" cols="30"></textarea>
         <input type="submit" value="Submit">
    
     </fieldset>
    </form>
</body>
</html>
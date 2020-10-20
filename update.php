<?php

require('mysqli_connect.php');

foreach ($_REQUEST as $key=>$val){
    $result = str_replace('_',' ',$key);
    echo $result;
    if($key==='id') {
        $user_id = $val;
    }
    else{
    $q = "Update bookinventory set quantity=quantity-".$val." WHERE name='".$result."'   ";
    $r = @mysqli_query($dbc, $q);
    $num = mysqli_num_rows($r);
    
    $qp = "SELECT book_id from bookinventory WHERE name='".$result."' ";
    $r = @mysqli_query($dbc, $qp);
    $product_id_row =  mysqli_fetch_assoc($r);
    $product_id = $product_id_row['book_id'];

    
    $q_insert = 'INSERT INTO order_details (user_id,book_id,order_quantity)
         VALUES (?,?,?)';
        $stmt = mysqli_prepare($dbc, $q_insert);
        mysqli_stmt_bind_param($stmt, 'iii',$user_id,$product_id,$val);
        
        mysqli_stmt_execute($stmt);

    }
        }



        $past = time() - 3600;
        foreach ( $_COOKIE as $key => $value )
        {
            setcookie( $key, '', $past, '/project1' );
        }
        echo 'Cart updated';
   
      





?>
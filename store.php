
<?php include('header.html'); ?>
<script>
    $(document).ready(function(){
       

        $('.addToCart').click(function(){
            console.log($(this).attr('name'));
            document.cookie = $(this).attr('name').replace(/ /g,'')+"="+$(this).attr('name');
            window.alert($(this).attr('name')+" added to cart");
            $(this).text("Already Added");
            $(this).attr('disabled','true');
    })
    })
</script>
<!--Carousal -->
<div class="row">
    
<div class="page-heading-div col-12"><span class="page-heading">Latest collection of books</span></div>
<?php
    require('mysqli_connect.php');

    $q = "SELECT * FROM bookinventory ORDER BY name ASC";
    $r = @mysqli_query($dbc, $q);
    $num = mysqli_num_rows($r);
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        $quantity = $row['quantity'] > 1 ? $row['quantity'] : 'Out of Stock';
        $cartButton = $row['quantity'] > 1 ? 'Add to cart' : 'Out of Stock';
        $cartDisabled = $row['quantity'] > 1 ? '' : 'disabled';
        echo
            '  
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="card">
  <div class="card-body">
    <strong class="card-title">'.$row['name'].'</strong>
    <p class="card-text">'.$row['author'].'</p>
    <p class="card-text listPrice"><strong>List Price:</strong> '.$row['price'].'</p>
    <p class="card-text"><strong>In Stock:</strong> <span id="quantity">'.$quantity.'</span></p>
  </div>
  
    <button name="'.$row['name'].'" class="addToCart btn btn-success" '.$cartDisabled.'  >'.$cartButton.'</button>
 
</div>
            </div>'
                
            
            ;
    }
    
    mysqli_close($dbc);
?>
    
</div>
<?php include('footer.html'); ?>
   
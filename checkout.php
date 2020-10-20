
<?php include('header.html'); ?>


<div>
    
<div class="page-heading-div col-12"><span class="page-heading">Shopping Cart</span></div>
    <hr>
    <div class="row">
        
    <div class="col-sm-12 col-md-3">
        <div class="banner">
           <strong> ITEM </strong>
        </div>
        
    </div>
        
    <div class="col-sm-12 col-md-3">
         <div class="banner">
         <strong>Quantity</strong>
        </div>
    </div>
        
    <div class="col-sm-12 col-md-3">
        <div class="banner">
        <strong>Price</strong>
        </div>
    </div>
        
     <div class="col-sm-12 col-md-3">
        <div class="banner">
        <strong> Total</strong>
        </div>
    </div>
    </div>
    
    <hr>
<?php
    require('mysqli_connect.php');
    
    if(empty($_COOKIE)){
      echo '

      <div class="text-center"><img src="./images/cart.png" height="200px" width="200px"></div>
      <h3 class="text-center card-title" style="margin-bottom:50px;margin-top:50px">Your cart is empty. Forgot to add items? Click here</h3>
      <a href="./store.php"><div class="text-center" style="margin-bottom:50px;margin-top:50px"><button class="btn btn-success">Check out books</button></div>
      </a>
      
      ';
    }
    else{
    
    foreach ($_COOKIE as $key=>$val)
  {
        
        $q = "SELECT * FROM bookinventory WHERE name LIKE '".$val."' ";
        $r = @mysqli_query($dbc, $q);
        $num = mysqli_num_rows($r);
        $row = mysqli_fetch_assoc($r);
       
   echo  "   
   <div class='row chkout'>
        
    <div class='col-sm-12 col-md-3'>
        <div class='banner bookName'>
            ".$val."
        </div>
        <p class='authorName'>by : ".$row['author']."</p>
        
    </div>
        
    <div class='col-sm-12 col-md-3'>
    
         <div class='banner'>
            <span class='fa fa-sort-desc fa-rotate-90 fa-2x faIcon removeItem'></span>
            <span style='font-size:24px; margin-left:10px; margin-right:10px;'class='item detailItem' id='".$key."'>1</span>
            <span class='fa fa-sort-desc fa-rotate-270 fa-2x faIcon addItem' ></span>
            <span class='invisible '>".$row['quantity']." </span>
            <h6 class='invisible'>".$row['price']." </h6>
            <span class='removeItem'>Remove From Cart </span>
            <button class='removeItemCookie invisible'>".$key."</button>
        </div>
    </div>
        
    <div class='col-sm-12 col-md-3'>
        <div class='banner detailItem'>
            ".$row['price']."
        </div>
    </div>
        
     <div class='col-sm-12 col-md-3 resultElement'>
        <div class='banner totalSinglePrice detailItem'>
            ".$row['price']."
        </div>
        
    </div>
    </div>"    ;
  }
  echo '
  <p class="totalText">Order Total</p>
    <h4 class="total"></h4>
    <div class="ml-auto" style="text-align:right;margin-top:50px;margin-bottom:50px">
  <button type="button" class="btn btn-info btn-lg" id="myBtn">Proceed to checkout</button>
</div>  
  ';
  }

?>  
   
    
    
    <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header"> <h4 class="modal-title">Checkout</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         
        </div>
        <div class="modal-body">
             
            
            
            <h1 id="test"></h1>
    
            
            
            
            <!--User Details-->
      <form class="form-group"> 
      <div class="cardinforow">
    <div class="cardinfocol2">
      <h3>Billing Address</h3>
      <label for="firstname"><i class="fa fa-user"></i>&nbsp;&nbsp;First Name</label>
      <input class="form-control" type="text" id="firstname" name="firstname" placeholder="First Name">
      <span id="errorFirstName" class="errorShow">*Please enter your First name</span></br>
      <label for="lastname"><i class="fa fa-envelope"></i>&nbsp;&nbsp;Last Name</label>
      <input class="form-control" type="text" id="lastname" name="lastname" placeholder="Last name">
      <span id="errorLastName" class="errorShow">*Please enter your last name</span></br>
      <label for="address"><i class="fa fa-address-card-o"></i>&nbsp;&nbsp;Address</label>
      <input class="form-control" type="text" id="address" name="address" placeholder="542 W. 15th Street">
      <span id="errorAddress" class="errorShow">*Please enter your address</span></br>
    </div>
</div>
            
            
            
            
            <!--Card Details-->
    <div class="cardinfo">
    <h3 style="padding-top: 15px;">Payment</h3>
    <label for="cards">Accepted Cards</label>
    <div class="cardincon">
      <i class="fa fa-cc-visa" style="color:navy;"></i>
      <i class="fa fa-cc-amex" style="color:blue;"></i>
      <i class="fa fa-cc-mastercard" style="color:red;"></i>
      <i class="fa fa-cc-discover" style="color:orange;"></i>
    </div>
    <label for="cardname">Name on Card</label>
    <input class="form-control" type="text" id="cardname" name="cardname" placeholder="John More Doe">
    <span id="errorCardName" class="errorShow">*Please enter your name on card</span></br>
              
    <label for="cardnumber">Please Enter Your Card Number (e.g. 6555 5555 5555 5555)</label>
    <input class="form-control" type="number" id="cardnumber" name="cardnumber" placeholder="1111-2222-3333-4444">
    
    <span id="errorCardNumber" class="errorShow">*Please enter correct card number</span></br>
    <div class="cardinforow">
      <div class="cardinfocol2">
        <label for="expdate">Exp Date</label>
        <input class="form-control" type="text" id="expdate" name="expdate" placeholder="2018">
        
    <span id="errorExpDate" class="errorShow">*Please enter correct expiry date(e.g. 2033)</span></br>
      </div>
      <div class="cardinfocol2">
        <label for="cvv">CVV</label>
        <input class="form-control" type="text" id="cvv" name="cvv" placeholder="352">
        
    <span id="errorCVV" class="errorShow">*Please enter ccv(e.g. 433)</span></br>
      </div>
    </div>
<!-- --------------------------------------------------------------------------------------------- -->

        </div>
            
    <button class="checkoutbtn">Checkout</button>
    </form> 
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
    
    
    </div>
</div>
    
<?php include('footer.html'); ?>
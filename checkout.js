 $(document).ready(function(){
            let finalTotal = [];
         $('.totalSinglePrice').each(function(index,obj){
                finalTotal.push(parseFloat($(this).text()));
            })
            var t = finalTotal.reduce((sum,current)=> sum+current,0);
            $('.total').text(t.toFixed(2));
        
        
        $('.addItem').click(function(){
            let finalTotal = [];
            let res = 0;
           let range = parseInt($(this).next("span").text());
            
            
            let val = parseInt($(this).prev("span").text());
            val = (val<range-1)?val+1:range-1;
            $(this).prev("span").text(val);
            
            res = (val* parseFloat($(this).siblings("h6").text())).toFixed(2);
            $(this)
             .parent()
             .parent()
            .siblings(".resultElement")
            .children(".totalSinglePrice").text(res);
            
            
             $('.totalSinglePrice').each(function(index,obj){
                finalTotal.push(parseFloat($(this).text()));
            })
            var t = finalTotal.reduce((sum,current)=> sum+current,0);
            $('.total').text(t.toFixed(2));
            
        });

        $('.removeItem').click(function() {
            let keyValue=  $(this).next(".removeItemCookie").text();
            console.log(keyValue);
            document.cookie = $(this).next(".removeItemCookie").text()+'=; Max-Age=-99999999;';
            location.reload();
          })

     
        
        $('.removeItem').click(function(){
            
            
            
            let finalTotal = [];
            
            let val = parseInt($(this).next("span").text());
            val = (val <=1) ? 1 : val-1;
            $(this).next("span").text(val);
            res = (val* parseFloat($(this).siblings("h6").text())).toFixed(2);
            $(this)
             .parent()
             .parent()
            .siblings(".resultElement")
            .children(".totalSinglePrice").text(res);
          
           
             $('.totalSinglePrice').each(function(index,obj){
                finalTotal.push(parseFloat($(this).text()));
            })
            var t = finalTotal.reduce((sum,current)=> sum+current,0);
            $('.total').text(t.toFixed(2));
            
        })
        
        //modal
        $("#myBtn").click(function(){
        $("#myModal").modal();
  });
     
     $(".checkoutbtn").click((e)=>{
         e.preventDefault();
        






        let fname = $("#firstname").val() ? $("#firstname").val() : "";
        let lname = $("#lastname").val() ? $("#lastname").val() : "";
        let address = $("#address").val() ? $("#address").val() : "";
        let cardname = $("#cardname").val() ? $("#cardname").val() : "";
        let cnumber = $("#cardnumber").val() ? $("#cardnumber").val() : "";
        let expdate = $("#expdate").val() ? $("#expdate").val() : "";
        let cvv = $("#cvv").val() ? $("#cvv").val() : "";

       

        let post_str = "firstname="+fname+
                        "&lastname="+lname+
                        "&address="+address+
                        "&cardname="+cardname+
                        "&cardnumber="+cnumber+
                        "&expdate="+expdate+
                        "&cvv="+cvv;
        console.log(post_str);

        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function() {
        if( xml.readyState==4 && xml.status==200 ){
            var res = JSON.parse(xml.responseText);
            console.log(res);
            console.log(res.error==="error");
            if(res.error==="error") {
            res.fname ? $("#errorFirstName").show() : $("#errorFirstName").hide();
            res.lname ? $("#errorLastName").show() : $("#errorFirstName").hide();
            res.address ? $("#errorAddress").show() : $("#errorAddress").hide();
            res.cname ? $("#errorCardName").show() : $("#errorCardName").hide();
            res.cardnumber ? $("#errorCardNumber").show() : $("#errorCardNumber").hide();
            res.expdate ? $("#errorExpDate").show() : $("#errorExpDate").hide();
            res.cvv ? $("#errorCVV").show() : $("#errorCVV").hide();
            }
            else{
                
            console.log(res);
                window.alert("Checkout Completed");

             console.log(res.id);

             
         let update_str = "id="+res.id+"&";
         let pairs = document.cookie.split(';');
         console.log(pairs);
         for(let i=0 ; i<pairs.length; i++) {
             
            firstPair =  pairs[i].split('=');
            if(i === pairs.length-1){
                update_str += firstPair[1] + "=" + $("#"+firstPair[0].trim()).text();
            }
            else{

                update_str += firstPair[1] + "=" + $("#"+firstPair[0].trim()).text() + "&";
            }
         }
         console.log(update_str);
    


                 var xmlNew = new XMLHttpRequest();

                 xmlNew.onreadystatechange = function() {
                    if( xmlNew.readyState==4 && xmlNew.status==200 ){
                        console.log("received");
                        console.log(xmlNew.responseText);
                        
                location.reload();
                    }
                 }
                 xmlNew.open("POST", "./update.php?"+update_str, false);
                 xmlNew.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                 xmlNew.send();

            }

            }
        };

        xml.open("POST", "./checkout_validation.php?"+post_str, false);
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xml.send();
     })
     
     
     
     
    })
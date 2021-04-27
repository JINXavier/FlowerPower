
<?php    
 $conn = mysqli_connect("localhost", "root", "", "flowerpower");  
 ?>  
  
      <?php
include("layout/navbar.php")
?>
      <body> 
       
           <br />  
           <div class="container" style="width:1200px;">  

                <div class="tab-content">  
                 
                     <?php  
                     $query = "SELECT * FROM artikel ORDER BY idartikel ASC";  
                     $result = mysqli_query($conn, $query);  
                     while($row = mysqli_fetch_array($result)){  
                     ?>  
                     <div class="col-sm-3" style="margin-top:12px; float:left;">  
                          <div style="border:1px solid #333; border-radius:15px; padding:16px; height:450px;" align="center">  
                               <img src="images/products/<?php echo $row["plaatje"]; ?>" class="img-fluid" /><br />  
                               <h4 class="text-info"><?php echo $row["artikelnaam"]; ?></h4>  
                               <h8 class="text-info"><?php echo $row["omschrijving"]; ?></h8>
                               <h4>€ <?php echo $row["prijs"]; ?></h4>  
                               <input type="text" name="quantity" id="quantity<?php echo $row["idartikel"]; ?>" class="form-control" value="1" />  
                               <input type="hidden" name="hidden_name" id="name<?php echo $row["idartikel"]; ?>" value="<?php echo $row["artikelnaam"]; ?>" />  
                               <input type="hidden" name="hidden_price" id="price<?php echo $row["idartikel"]; ?>" value="<?php echo $row["prijs"]; ?>" />  
                               <input type="button" name="add_to_cart" id="<?php echo $row["idartikel"]; ?>" style="margin-top:5px;" class="btn btn-outline-success add_to_cart" value="Bestel" />  
                          </div>  
                     </div>  
                     <?php  
                     }  
                     ?>  
                     
                  </div>  
                       
                </div>  
           </div>  
      </body>  
 </html>  
 <script>  
 $(document).ready(function(data){  
      $('.add_to_cart').click(function(){  
           var productID = $(this).attr("id");  
           var productName = $('#name'+productID).val();  
           var productPrice = $('#price'+productID).val();  
           var productQuantity = $('#quantity'+productID).val();  
           var action = "add";  
           if(productQuantity > 0)  
           {  
                $.ajax({  
                     url:"./includes/winkel.inc.php",  
                     method:"POST",  
                     dataType:"json",  
                     data:{  
                          productID:productID,   
                          productName:productName,   
                          productPrice:productPrice,   
                          productQuantity:productQuantity,   
                          action:action  
                     },  
                     success:function(data)  
                     {  
                          $('#order_table').html(data.order_table);  
                          $('.badge').text(data.cart_item);  
                          alert("Het artikel is toegevoegd aan de winkelwagen.");  
                     }  
                });  
           }  
           else  
           {  
                alert("Kies het aantal!")  
           }  
      });   
 });  
 </script>


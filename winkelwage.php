<?php   
 $conn = mysqli_connect("localhost", "root", "", "flowerpower");  
?>
<?php
include("layout/navbar.php")
?> 
<body>

<div class="container" style="width:800px; margin-top:50px;">
    <div id="order_table">  
        <table class="table table-bordered">  
              <tr class="table-active">  
                    <th width="40%">Product naam</th>  
                    <th width="10%">Aantal</th>  
                    <th width="20%">Prijs</th>  
                    <th width="15%">Totaal</th>  
                    <th width="5%"></th>  
              </tr>    
            <?php  
            if(!empty($_SESSION["shopping_cart"]))  
            {  
                $total = 0;  
                foreach($_SESSION["shopping_cart"] as $keys => $values)  
                {                                               
            ?>  
            <tr>  
                <td><?php echo $values["productName"]; ?></td>  
                <td><input type="text" name="quantity[]" id="quantity<?php echo $values["productID"]; ?>" value="<?php echo $values["productQuantity"]; ?>" data-productID="<?php echo $values["productID"]; ?>" class="form-control quantity" /></td>  
                <td align="right">€ <?php echo $values["productPrice"]; ?></td>  
                <td align="right">€ <?php echo number_format($values["productQuantity"] * $values["productPrice"], 2); ?></td>  
                <td><button name="delete" class="btn btn-danger btn-block delete" id="<?php echo $values["productID"]; ?>">Verwijder</button></td>  
            </tr>  
            <?php  
                    $total = $total + ($values["productQuantity"] * $values["productPrice"]);  
                }  
            ?>  
            <tr>  
                    <td colspan="3" align="right">Totaal</td>  
                    <td align="right">€ <?php echo number_format($total, 2); ?></td>  
                    <td></td>  
            </tr>  
            <tr>  
                    <td colspan="5" align="center">  
                        <form method="POST" action="checkout.php">  
                        <input type="submit" name="placeOrder" class="btn btn-warning" value="Plaats bestelling" />  
                        </form>  
                    </td>  
            </tr>  
            <?php  
            }  
            ?>  
        </table>  
    </div>  
</div>
</body>
</html>
<script>
$(document).ready(function(data){  
        $(document).on('click', '.delete', function(){  
           var productID = $(this).attr("id");  
           var action = "remove";  
           if(confirm("Weet u zeker dat u dit product wil verwijderen?"))  
           {  
                $.ajax({  
                     url:"./includes/winkel.inc.php",  
                     method:"POST",  
                     dataType:"json",  
                     data:{productID:productID, action:action},  
                     success:function(data){  
                          $('#order_table').html(data.order_table);  
                          $('.badge').text(data.cart_item);  
                     }  
                });  
           }  
           else  
           {  
                return false;  
           }  
      });  
      $(document).on('keyup', '.quantity', function(){  
           var productID = $(this).data("productID");  
           var quantity = $(this).val();  
           var action = "quantity_change";  
           if(quantity != '')  
           {  
                $.ajax({  
                     url :"../includes/winkel.inc.php",  
                     method:"POST",  
                     dataType:"json",  
                     data:{productID:productID, quantity:quantity, action:action},  
                     success:function(data){  
                          $('#order_table').html(data.order_table);  
                     }  
                });  
           }  
      });  
}); 
 </script> 
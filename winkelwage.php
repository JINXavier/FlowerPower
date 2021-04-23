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
                <td><?php echo $values["product_name"]; ?></td>  
                <td><input type="text" name="quantity[]" id="quantity<?php echo $values["product_id"]; ?>" value="<?php echo $values["product_quantity"]; ?>" data-product_id="<?php echo $values["product_id"]; ?>" class="form-control quantity" /></td>  
                <td align="right">€ <?php echo $values["product_price"]; ?></td>  
                <td align="right">€ <?php echo number_format($values["product_quantity"] * $values["product_price"], 2); ?></td>  
                <td><button name="delete" class="btn btn-danger btn-block delete" id="<?php echo $values["product_id"]; ?>">Verwijder</button></td>  
            </tr>  
            <?php  
                    $total = $total + ($values["product_quantity"] * $values["product_price"]);  
                }  
            ?>  
            <tr>  
                    <td colspan="3" align="right">Totaal</td>  
                    <td align="right">€ <?php echo number_format($total, 2); ?></td>  
                    <td></td>  
            </tr>  
            <tr>  
                    <td colspan="5" align="center">  
                        <form method="POST" action="cart.php">  
                        <input type="submit" name="place_order" class="btn btn-warning" value="Plaats bestelling" />  
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
           var product_id = $(this).attr("id");  
           var action = "remove";  
           if(confirm("Weet u zeker dat u dit product wil verwijderen?"))  
           {  
                $.ajax({  
                     url:"action.php",  
                     method:"POST",  
                     dataType:"json",  
                     data:{product_id:product_id, action:action},  
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
           var product_id = $(this).data("product_id");  
           var quantity = $(this).val();  
           var action = "quantity_change";  
           if(quantity != '')  
           {  
                $.ajax({  
                     url :"action.php",  
                     method:"POST",  
                     dataType:"json",  
                     data:{product_id:product_id, quantity:quantity, action:action},  
                     success:function(data){  
                          $('#order_table').html(data.order_table);  
                     }  
                });  
           }  
      });  
}); 
 </script> 
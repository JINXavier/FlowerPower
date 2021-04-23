<?php  
session_start();  
$conn = mysqli_connect("localhost", "root", "", "flowerpower");  
if(isset($_POST["product_id"]))  
{  
  $order_table = '';  
  $message = '';  
  if($_POST["action"] == "add")  
  {  
   if(isset($_SESSION["shopping_cart"]))  
   {  
    $is_available = 0;  
    foreach($_SESSION["shopping_cart"] as $keys => $values)  
    {  
     if($_SESSION["shopping_cart"][$keys]['product_id'] == $_POST["product_id"])  
     {  
      $is_available++;  
      $_SESSION["shopping_cart"][$keys]['product_quantity'] = $_SESSION["shopping_cart"][$keys]['product_quantity'] + $_POST["product_quantity"];  
    }  
  }  
  if($is_available < 1)  
  {  
   $item_array = array(  
    'product_id' => $_POST["product_id"],  
    'product_name' => $_POST["product_name"],  
    'product_price'  => $_POST["product_price"],  
    'product_quantity' => $_POST["product_quantity"]  
  );  
   $_SESSION["shopping_cart"][] = $item_array;  
 }  
}  
else  
{  
  $item_array = array(  
   'product_id' => $_POST["product_id"],  
   'product_name' => $_POST["product_name"],  
   'product_price' => $_POST["product_price"],  
   'product_quantity' => $_POST["product_quantity"]  
 );  
  $_SESSION["shopping_cart"][] = $item_array;  
}  
}  
if($_POST["action"] == "remove")  
{  
 foreach($_SESSION["shopping_cart"] as $keys => $values)  
 {  
  if($values["product_id"] == $_POST["product_id"])  
  {  
   unset($_SESSION["shopping_cart"][$keys]);  
   $message = '<label class="text-success">Product is verwijderd.</label>';  
 }  
}  
}  
if($_POST["action"] == "quantity_change")  
{  
 foreach($_SESSION["shopping_cart"] as $keys => $values)  
 {  
  if($_SESSION["shopping_cart"][$keys]['product_id'] == $_POST["product_id"])  
  {  
   $_SESSION["shopping_cart"][$keys]['product_quantity'] = $_POST["quantity"];  
 }  
}  
}  
$order_table .= '  
'.$message.'  
<table class="table table-bordered">  
  <tr class="table-active">  
    <th width="40%">Product Naam</th>  
    <th width="10%">Aantal</th>  
    <th width="20%">Prijs</th>  
    <th width="15%">Totaal</th>  
  <th width="5%"></th>  
</tr>  
';  
if(!empty($_SESSION["shopping_cart"]))  
{  
 $total = 0;  
 foreach($_SESSION["shopping_cart"] as $keys => $values)  
 {  
  $order_table .= '  
  <tr>  
    <td>'.$values["product_name"].'</td>  
      <td><input type="text" name="quantity[]" id="quantity'.$values["product_id"].'" value="'.$values["product_quantity"].'" class="form-control quantity" data-product_id="'.$values["product_id"].'" /></td>  
      <td align="right">€ '.$values["product_price"].'</td>  
      <td align="right">€ '.number_format($values["product_quantity"] * $values["product_price"], 2).'</td>  
    <td><button name="delete" class="btn btn-danger btn-block delete" id="'.$values["product_id"].'">Verwijder</button></td>  
  </tr>  
  ';  
  $total = $total + ($values["product_quantity"] * $values["product_price"]);  
}  
$order_table .= '  
<tr>  
  <td colspan="3" align="right">Totaal</td>  
  <td align="right">€ '.number_format($total, 2).'</td>  
  <td></td>  
</tr>  
<tr>  
  <td colspan="5" align="center">  
    <form method="post" action="cart.php">  
      <input type="submit" name="place_order" class="btn btn-warning" value="Plaats bestelling" />  
    </form>  
  </td>  
</tr>  
';  
}  
$order_table .= '</table>';  
$output = array(  
 'order_table' => $order_table,  
 'cart_item' => count($_SESSION["shopping_cart"])  
);  
echo json_encode($output);  
}  
?>

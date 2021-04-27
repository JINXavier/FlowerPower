<?php  
session_start();  
$conn = mysqli_connect("localhost", "root", "", "flowerpower");  
if(isset($_POST["productID"]))  
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
     if($_SESSION["shopping_cart"][$keys]['productID'] == $_POST["productID"])  
     {  
      $is_available++;  
      $_SESSION["shopping_cart"][$keys]['productQuantity'] = $_SESSION["shopping_cart"][$keys]['productQuantity'] + $_POST["productQuantity"];  
    }  
  }  
  if($is_available < 1)  
  {  
   $item_array = array(  
    'productID' => $_POST["productID"],  
    'productName' => $_POST["productName"],  
    'productPrice'  => $_POST["productPrice"],  
    'productQuantity' => $_POST["productQuantity"]  
  );  
   $_SESSION["shopping_cart"][] = $item_array;  
 }  
}  
else  
{  
  $item_array = array(  
   'productID' => $_POST["productID"],  
   'productName' => $_POST["productName"],  
   'productPrice' => $_POST["productPrice"],  
   'productQuantity' => $_POST["productQuantity"]  
 );  
  $_SESSION["shopping_cart"][] = $item_array;  
}  
}  
if($_POST["action"] == "remove")  
{  
 foreach($_SESSION["shopping_cart"] as $keys => $values)  
 {  
  if($values["productID"] == $_POST["productID"])  
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
  if($_SESSION["shopping_cart"][$keys]['productID'] == $_POST["productID"])  
  {  
   $_SESSION["shopping_cart"][$keys]['productQuantity'] = $_POST["quantity"];  
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
    <td>'.$values["productName"].'</td>  
      <td><input type="text" name="quantity[]" id="quantity'.$values["productID"].'" value="'.$values["productQuantity"].'" class="form-control quantity" data-productID="'.$values["productID"].'" /></td>  
      <td align="right">€ '.$values["productPrice"].'</td>  
      <td align="right">€ '.number_format($values["productQuantity"] * $values["productPrice"], 2).'</td>  
    <td><button name="delete" class="btn btn-danger btn-block delete" id="'.$values["productID"].'">Verwijder</button></td>  
  </tr>  
  ';  
  $total = $total + ($values["productQuantity"] * $values["productPrice"]);  
}  
$order_table .= '  
<tr>  
  <td colspan="3" align="right">Totaal</td>  
  <td align="right">€ '.number_format($total, 2).'</td>  
  <td></td>  
</tr>  
<tr>  
  <td colspan="5" align="center">  
    <form method="post" action="checkout.php">  
      <input type="submit" name="placeOrder" class="btn btn-warning" value="Plaats bestelling" />  
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

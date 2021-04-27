<?php   
session_start();
$conn = mysqli_connect("localhost", "root", "", "flowerpower");  
?>

 <?php
// allow when logged in with the right session
if(!isset($_SESSION['idklant']))
{
    // not logged in
    header('Location: login.php');
    exit();
}
?>

 <!DOCTYPE html>  
 <html>  
      <head>  
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      </head>  
      <body>  
           <br />  
           <div class="container" style="width:800px;">  
                <?php  
                if(isset($_POST['placeOrder'])){
                  $insert_order = "
                  INSERT INTO factuur(idklant, datum, factuurnummer, afgehaald, idmedewerker, idwinkel)
                  VALUES('{$_SESSION['idklant']}', '".date('Y-m-d')."', '".time()."', 'Nog niet afgehaald', '1', '1')
                  ";
                  $order_id = "";
                  if(mysqli_query($conn, $insert_order)){
                    $order_id = mysqli_insert_id($conn);
                  }
                  $_SESSION["order_id"] = $order_id;
                  $lastcheck = False;
                  $order_details = "";
                  foreach($_SESSION["shopping_cart"] as $keys => $values){
                    $order_details = "
                    INSERT INTO artikel_has_factuur (idfactuur, artikelnaam, artikelprijs, aantal) 
                    VALUES('".$order_id."', '".$values["productName"]."', '".$values["productPrice"]."', '".$values["productQuantity"]."')
                    ";
                    if(mysqli_multi_query($conn, $order_details)){
                      $lastcheck = True;
                      unset($_SESSION["shopping_cart"]);  
                      echo '<script>alert("Uw bestelling is geplaatst!")</script>';  
                      echo '<script>window.location.href="checkout.php"</script>';
                    }
                  }
                }
                if(isset($_SESSION["order_id"])){
                  $customer_details = '';
                  $order_details = '';
                  $factuurnummer = '';
                  $order_number = '';
                  $total = 0;
                  $query = '
                  SELECT * FROM factuur
                  INNER JOIN artikel_has_factuur
                  ON artikel_has_factuur.idfactuur = factuur.idfactuur
                  INNER JOIN klant
                  ON klant.idklant = factuur.idklant
                  WHERE factuur.idfactuur = "'.$_SESSION["order_id"].'"
                  ';
                  $result = mysqli_query($conn, $query);
                  while($row = mysqli_fetch_array($result)){
                  $customer_details = '  
                          <label>'.$row["voornaam"].' '.$row["tussenvoegsel"].' '.$row["achternaam"].'</label>  
                          <p>'.$row["adres"].' '.$row["huisnummer"].'</p>  
                          <p>'.$row["postcode"].', '.$row["plaats"].' </p>
                          <p>'.$row["telefoon"].'</p>    
                          <p>'.$row["email"].'</p>  

                          '; 
                          $order_number = '
                            <h5 align="center">Factuurnummer: '.$row["factuurnummer"].'</h5>
                          '; 
                          $order_details .= "  
                               <tr>  
                                    <td>".$row["artikelnaam"]."</td>  
                                    <td>".$row["aantal"]."</td>  
                                    <td>€ ".$row["artikelprijs"]."</td>  
                                    <td>".number_format($row["aantal"] * $row["artikelprijs"], 2)."</td>  
                               </tr>  
                          ";  
                          $total = $total + ($row["aantal"] * $row["artikelprijs"]);  
                     }  
                     echo '  
                    <tr>'.$order_number.'</tr>
                     <div class="table-responsive">  
                          <table class="table">  
                               <tr>  
                                    <td><b>Klant gegevens</b></td>  
                               </tr>  
                               <tr>  
                                    <td>'.$customer_details.'</td>  
                               </tr>  
                               <tr>  
                                    <td><b>Bestelling overzicht</b></td>  
                               </tr>  
                               <tr>  
                                    <td>  
                                         <table class="table table-bordered">  
                                              <tr>  
                                                   <th width="50%">Product Naam</th>  
                                                   <th width="15%">Aantal</th>  
                                                   <th width="15%">Prijs</th>  
                                                   <th width="20%">Totaal</th>  
                                              </tr>  
                                              '.$order_details.'  
                                              <tr>  
                                                   <td colspan="3" align="right"><label>Total</label></td>  
                                                   <td>€ '.number_format($total, 2).'</td>  
                                              </tr>  
                                         </table>  
                                    </td>  
                               </tr>  
                          </table>  
                     </div>  
                     ';  
                }  
                ?>    
            </div>
      </body>
</html>
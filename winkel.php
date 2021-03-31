<?php  
$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "flowerpower";

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
    .product-img {
        width: 100% !important;
        height: 100px !important;
        object-fit: contain
    }

    h3 {
        text-align: center;
        white-space: nowrap
    }

    h6 {
        text-align: center
    }
    </style>
    
</head>
<?php
include("layout/navbar.php")
?>

<body>
    <div class="container">

            <div class="row">

                <?php
                $sql = "SELECT * FROM artikel";
                $result = mysqli_query($conn, $sql); 
                while($row = mysqli_fetch_assoc($result)) {
                // echo $row['id'] ." ". $row['artikelnaam'] ." ". $row['plaatje'] ." ". $row['prijs']."<br>";
                ?>

                    <div class="col-md-3 text-center mt-5">
                        <img class ="product-img" src="images/products/<?php echo $row['plaatje']?>" alt="">
                        <h3><?php echo $row['artikelnaam']?></h3>
                        <h6>Prijs: €<?php echo $row['prijs']?></h6>
                        <h7><?php echo $row['omschrijving']?></h7>
                        <div class="form-group">
                            <label>Select list:</label>
                            <select class="form-control" id="quantity<?php echo $row['id']?>">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>
                            <input type="hidden" id="name<?php echo $row['idartikel']?>" value='<?php echo $row['artikelnaam']?>'>
                            <input type="hidden" id="description<?php echo $row['idartikel']?>" value='<?php echo $row['omschrijving']?>'>
                            <input type="hidden" id="price<?php echo $row['idartikel']?>" value='<?php echo $row['prijs']?>'>

                            <button class='btn btn-danger add' data-id="<?php echo $row['idartikel']?>">Bestel</button>

                        </div>
                    </div>

                <?php
            }
            ?>

     
    </div>
            <!-- <div class="col-md-1">

            </div>
            <div class="col-md-4">
            <h3 class='text-center'> </h3>
            <div id="displayCheckout">
            <?php 
                if(!empty($_SESSION['cart'])){
                    $outputTable = '';
                    $total = 0;
                    $outputTable .= "<table class='table table-bordered'><thead><tr><td>Naam</td><td>Prijs</td><td>Quantity</td><td>Action</td> </tr></thead>";
                    foreach($_SESSION['cart'] as $key => $value){
                        $outputTable .= "<tr><td>".$value['p_name']."</td><td>".($value['p_price'] * $value['p_quantity']) ."</td><td>".$value['p_quantity']."</td><td><button id=".$value['p_id']." class='btn btn-danger delete'>Delete</button></td></tr>";  
                        $total = $total + ($value['p_price'] * $value['p_quantity']);
                    }
                    $outputTable .= "</table>";
                    $outputTable .= "<div class='text-center'><b>Total: ".$total."</b></div>";
                    echo $outputTable;
                }
            ?>
            </div> 
            </div>
        </div>       
    </div> -->


    <script>
    $(document).ready(function() {
         alldeleteBtn = document.querySelectorAll('.delete')
         alldeleteBtn.forEach(onebyone => {
            onebyone.addEventListener('click',deleteINsession)
         })

function deleteINsession(){
    removable_id = this.id;
    $.ajax({
                url:'cart.php',
                method:'POST',
                dataType:'json',
                data:{ 
                      id_to_remove:removable_id,
                      action:'remove' 
                },
                success:function(data){
                        $('#displayCheckout').html(data);
           alldeleteBtn = document.querySelectorAll('.delete')
         alldeleteBtn.forEach(onebyone => {
            onebyone.addEventListener('click',deleteINsession)
         })
                      }
              }).fail( function(xhr, textStatus, errorThrown) {
        alert(xhr.responseText);
    });

}


        $('.add').click(function() { 
            id = $(this).data('id');
            name = $('#name' + id).val();
            price = $('#price' + id).val();
            quantity = $('#quantity' + id).val();
              $.ajax({
                url:'cart.php',
                method:'POST',
                dataType:'json',
                data:{
                      cart_id : id,
                      cart_name : name,
                      cart_price : price,
                      cart_quantity : quantity,
                      action:'add' 
                },
                success:function(data){
                        $('#displayCheckout').html(data);
                        alldeleteBtn = document.querySelectorAll('.delete')
         alldeleteBtn.forEach(onebyone => {
            onebyone.addEventListener('click',deleteINsession)
         })
                      }
              }).fail( function(xhr, textStatus, errorThrown) {
        alert(xhr.responseText);
    });
        
        })
    })
    </script>

</body>

</html>


<?php


mysqli_close($conn);
 
 
?>
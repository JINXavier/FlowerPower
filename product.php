<?php
include("layout/adminnavbar.php")
?>
<?php
// allow when logged in with the right session
if(!isset($_SESSION['idmedewerker']))
{
    // not logged in
    header('Location: index.php');
    exit();
}
?>
<?php require_once './includes/product.inc.php' ; 

    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $edit = true;

        $rec = mysqli_query($conn, "SELECT * FROM artikel WHERE idartikel = $id");
        $record = mysqli_fetch_array($rec);
        $plaatje = $record['plaatje'];
        $artikelnaam = $record['artikelnaam'];
        $omschrijving = $record['omschrijving'];
        $prijs = $record['prijs'];
    }
?>

<?php
$mysqli = new mysqli('localhost','root','','flowerpower') or die(mysqli_error($mysqli));
$result = $mysqli->query("SELECT * FROM artikel") or die($mysqli->error);
?>
<div class="admin-panel">
    <section class="sign-up">
    <h1>Artikelen</h1>
    <form action="includes/product.inc.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="idartikel" value="<?php echo $id; ?>">
    <input type="file" name="plaatje" id="plaatje" value="<?php echo $plaatje; ?>">
    <input type="text" name="artikelnaam" value="<?php echo $artikelnaam; ?>" placeholder="artikelnaam..."required>
    <textarea class="form-control" rows="4" cols="50" type="text" name="omschrijving" placeholder="omschrijving..."><?php echo $omschrijving; ?></textarea>
    <input type="text" name="prijs"  value="<?php echo $prijs; ?>" placeholder="prijs..."required>
    <?php if ($edit == false): ?>
    <button type="submit" name="submit">Toevoegen</button>
    <?php else: ?>
    <button type="submit" name="update">Update</button>
    <?php endif ?>
    </form>
    </section>
    </br>
    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "none") {
        echo"<b>Artikel is gewijzigd!</b>";
    } else if ($_GET["error"] == "deleted") {
        echo"<b>Artikel is verwijderd!</b>";
    }
}
    ?>
    <div>
</div>
<br>
<div class="row justify-content-center">
        <table class="table">
            <thread>
                <tr>
                    <th>Plaatje</th>
                    <th>Artikelnaam</th>
                    <th>Omschrijving</th>
                    <th>Prijs</th>
                    <th>Opties</th>
                </tr>
            </thread>
    <?php
        while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><img src="./images/products/<?php echo $row['plaatje'];?>" width="80" height="80"></td>
            <td><?php echo $row['artikelnaam']; ?></td>
            <td><?php echo $row['omschrijving']; ?></td>
            <td><?php echo $row['prijs']; ?></td>
            <td>
                <a href="product.php?edit=<?php echo $row['idartikel']; ?>"
                    class="btn btn-info">Wijzig
                </a>

                <a href="./includes/product.inc.php?delete=<?php echo $row['idartikel']; ?>"
                    class="btn btn-danger">Verwijder
                </a>
            </td>
        </tr>
        <?php endwhile; ?>
        </table>
    </div>


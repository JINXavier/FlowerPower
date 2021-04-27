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
<?php require_once './includes/editorder.inc.php' ; 

    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $edit = true;

        $rec = mysqli_query($conn, "SELECT * FROM factuur WHERE idfactuur = $id");
        $record = mysqli_fetch_array($rec);
        $afgehaald = $record['afgehaald'];
    }
?>

<?php
$mysqli = new mysqli('localhost','root','','flowerpower') or die(mysqli_error($mysqli));
$result = $mysqli->query("SELECT * FROM factuur") or die($mysqli->error);
?>
<div class="admin-panel">
    <section class="sign-up">
    <h1>Bestellingen</h1>
    <form action="includes/editorder.inc.php" method="post">
    <input type="hidden" name="idfactuur" value="<?php echo $id; ?>">
  
    <!-- <input type="text" name="afgehaald" value="<?php echo $afgehaald; ?>" placeholder="status..."required> -->
    <?php if ($edit == false): ?>
    <h6>Klik op wijzig om de bestelling status te wijzigen.</h6>
    <?php else: ?>
    <select name="afgehaald">
        <option name="option1" value="Nog niet afgehaald">Nog niet afgehaald</option>
        <option name="option2" value="Afgehaald">Afgehaald</option>
    </select>
    <br>
    <button type="submit" name="update">Update</button>
    <?php endif ?>
    </form>
    </section>
    </br>
    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "none") {
        echo"<b>Status is gewijzigd!</b>";
    } 
}
    ?>
</div>
<br>
<div class="row justify-content-center">
        <table class="table">
            <thread>
                <tr>
                    <th>Datum</th>
                    <th>Factuurnummer</th>
                    <th>Status bestelling</th>
                    <th>Opties</th>
                </tr>
            </thread>
    <?php
        while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['datum']; ?></td>
            <td><?php echo $row['factuurnummer']; ?></td>
            <td><?php echo $row['afgehaald']; ?></td>
            <td>
                <a href="order.php?edit=<?php echo $row['idfactuur']; ?>"
                    class="btn btn-info">Wijzig
                </a>
            </td>
        </tr>
        <?php endwhile; ?>
        </table>
    </div>
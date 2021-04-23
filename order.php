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
<?php require_once './includes/edit.inc.php' ; 

    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $edit = true;

        $rec = mysqli_query($conn, "SELECT * FROM medewerker WHERE idmedewerker = $id");
        $record = mysqli_fetch_array($rec);
        $voornaam = $record['voornaam'];
        $tussenvoegsel = $record['tussenvoegsel'];
        $achternaam = $record['achternaam'];
        $email = $record['email'];
        $wachtwoord = $record['wachtwoord'];
        $id = $record['idmedewerker'];
    }
?>

<?php
$mysqli = new mysqli('localhost','root','','flowerpower') or die(mysqli_error($mysqli));
$result = $mysqli->query("SELECT * FROM factuur") or die($mysqli->error);
?>
<div class="admin-panel">
    <section class="sign-up">
    <h1>Medewerkers paneel</h1>
    <form action="includes/edit.inc.php" method="post">
    <input type="hidden" name="idmedewerker" value="<?php echo $id; ?>">
    <input type="text" name="voornaam"  value="<?php echo $voornaam; ?>" placeholder="Voornaam..."required>
    <input type="text" name="tussenvoegsel" value="<?php echo $tussenvoegsel; ?>" placeholder="tussenvoegsel...">
    <input type="text" name="achternaam" value="<?php echo $achternaam; ?>" placeholder="achternaam..."required>
    <input type="email" name="email" value="<?php echo $email; ?>" placeholder="E-mailadres..."required>
    <input type="password" name="wachtwoord"  value="<?php echo $wachtwoord; ?>" placeholder="Wachtwoord..."required>
    <input type="password" name="wachtwoord2" placeholder="Herhaal wachtwoord..."required>
    <?php if ($edit == false): ?>
    <button type="submit" name="submit">Registreer</button>
    <?php else: ?>
    <button type="submit" name="update">update</button>
    <?php endif ?>
    </form>
    </section>
    </br>
    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
        echo"<p>Vul alle velden in.</p>";
    } 
    else if ($_GET["error"] == "invalidemail") {
    echo"<p>De e-mail adres klopt niet.</p>";
    }
    else if ($_GET["error"] == "passwordnomatch") {
    echo"<p>Wachtwoord komt niet overeen.</p>";  
    }
    else if ($_GET["error"] == "emptyinput") {
    echo"<p>Oops er ging iets fout probeer het opnieuw.</p>";  
    }
    else if ($_GET["error"] == "emailused") {
    echo"<p>De e-mail adres die u heeft ingevoerd is al in gebruik.</p>";
    }
    else if ($_GET["error"] == "none") {
    echo"<p>Uw account is aangemaakt u kunt nu inloggen.</p>";
    }
}
    ?>
    <?php
if (isset($_SESSION['message'])): ?>
<?$_SESSION['msg_type']?>
<?php
    echo $_SESSION['message'];
    unset($_SESSION['message']);
?>
</div>
<?php endif ?>
</div>

<div class="row justify-content-center">
        <table class="table">
            <thread>
                <tr>
                    <th>Datum</th>
                    <th>Factuurnummer</th>
                    <th>Afgehaald</th>
                </tr>
            </thread>
    <?php
        while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['datum']; ?></td>
            <td><?php echo $row['factuurnummer']; ?></td>
            <td><?php echo $row['afgehaald']; ?></td>
            <td>
                <a href="adminpanel.php?edit=<?php echo $row['afgehaald']; ?>"
                    class="btn btn-info">Wijzig
                </a>

<!--                 <a href="./includes/edit.inc.php?delete=<?php echo $row['idmedewerker']; ?>"
                    class="btn btn-danger">Verwijder
                </a> -->
            </td>
        </tr>
        <?php endwhile; ?>
        </table>
    </div>
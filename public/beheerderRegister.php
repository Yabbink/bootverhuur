<?php
require_once('header.php');
require_once('../src/gebruikersFuncties.php');

try {
    $PDO = new PDO("mysql:host=localhost;dbname=bootverhuur","root","");

    $newAdmin = null;
    if (isset($_POST['register'])){
        $adminName = $_POST['adminName'];
        $email = $_POST['email'];
        $mobileNumber = $_POST['mobileNumber'];
        $newAdmin= registerAdmin("$adminName", "$email", "$mobileNumber");
    }
}catch (PDOException $e){
    die("error!: " . $e->getMessage());
}
?>
<section>
    <div class="page registreren">
        <div class="container">
    <h1>Registreren Beheerder</h1>
    <?php if($newAdmin === 1){ ?>
        <p class="registrenp">nieuwe beheerder succesvol toegevoegd</p>
    <?php }else{ ?>
        <form action="#" method="post">
            <div class="inputRow">
                <label for="adminName" class="label1">Voornaam</label>
                <input type="text" name="adminName">
            </div>
            <div class="inputRow">
                <label for="mobileNumber" class="label2">Telefoon</label>
                <input type="tel" name="mobileNumber">
            </div>
            <div class="inputRow">
                <label for="email" class="label2">Email</label>
                <input type="email" name="email">
            </div>
            <div class="inputRow">
                <input type="submit" value="Registreren" name="register">
            </div>
        </form>
    <?php } ?>
</section>
<?php require_once 'footer.php'; ?>

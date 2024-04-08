<?php require_once 'header.php';
require_once '../src/databaseFuncties.php';
require_once '../src/gebruikersFuncties.php';

try {
    $PDO = new PDO("mysql:host=localhost;dbname=bootverhuur", "root", "");
    $sql = "select * from orders";
    $orders = $PDO->prepare($sql);
    $orders->execute();
    $beheerder = null;
    $nieuwesql = null;
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $mobileNumber = $_POST['mobileNumber'];
        $sql = "SELECT email, mobileNumber FROM adminLogin WHERE email = '$email' AND mobileNumber = '$mobileNumber'";
        $admin = $PDO->prepare($sql);
        $beheerder = $admin->fetchAll(PDO::FETCH_ASSOC);
    }
    if (isset($_SESSION['id']) !== null) {
        session_start();
        $_SESSION['id'] = $beheerder['id'];
        $_SESSION['firstName'] = $beheerder['adminName'];
        $_SESSION['email'] = $beheerder['email'];
        $_SESSION['mobileNumber'] = $beheerder['mobileNumber'];
        echo "uitloggen";
    } else {
        echo "inloggen";
    }
}catch (PDOException $e){
    die("error!: " . $e->getMessage());
}
?>
<section>
    <?php if($beheerder !== 'no admin found' && $beheerder !== null){?>
        <div class="page login">
            <div class="container">
        <h1 >Reservaties van vandaag</h1>
        <?php $order=$orders->fetchAll();
        foreach($order as $reservaties){?>
                    <table border="1">
                        <tr>
                            <th>dagdeel</th>
                            <th>plaats</th>
                            <th>categorie</th>
                        </tr>
                        <tr>
                            <td><?php echo $reservaties['dagDeel'] ?></td>
                            <td><?php echo $reservaties['plaats'] ?></td>
                            <td><?php echo $reservaties['categorie'] ?></td>
                        </tr>
                    </table>
                    <?php } ?>
            </div>
        </div>
        <?php } else if($beheerder == 'no admin found' && $beheerder == null) { ?>
        <p class="label1">je bent geen beheerder, ga naar de inlog of registreer pagina om het opnieuw te proberen</p>
    <?php } else{ ?>
    <div class="page login">
        <div class="container">
        <h1 class="inloggenh1">Inloggen Beheerder</h1>
        <form action="#" method="post">
            <div class="inputRow">
                <label for="email" class="label1">Email</label>
                <input type="email" name="email">
            </div>
            <div class="inputRow">
                <label for="mobileNumber" class="label2">Telefoon</label>
                <input type="tel" name="mobileNumber">
            </div>
            <div class="inputRow">
                <input type="submit" value="login" name="login">
            </div>
        </form>
    <?php } ?>
</section>
<?php require_once 'footer.php'; ?>


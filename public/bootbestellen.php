<?php require_once 'header.php';
require_once '../src/databaseFuncties.php';
require_once '../src/gebruikersFuncties.php';

try {
    $PDO = new PDO("mysql:host=localhost;dbname=bootverhuur", "root", "");
    $sql = "SELECT * FROM huur";
    $huur = $PDO->prepare($sql);
    $huur->execute();

    $user = null;
    $nieuwesql = null;
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $mobileNumber = $_POST['mobileNumber'];
        $sql3 = "SELECT * FROM users WHERE email = '$email' AND mobileNumber = '$mobileNumber'";
        $result = $PDO->prepare($sql);
        $result->execute();
        $user = $result->fetchAll(PDO::FETCH_ASSOC);
    }
    if (isset($_SESSION['id']) != null) {
        session_start();
        $_SESSION['id'] = $user['id'];
        $_SESSION['firstName'] = $user['firstName'];
        $_SESSION['lastName'] = $user['lastName'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['mobileNumber'] = $user['mobileNumber'];
        echo "uitloggen";
    } else {
        echo "inloggen";
    }
}catch (PDOException $e){
    die("error!: " . $e->getMessage());
}
?>
<section>
    <div class="page login">
    <div class="container">
        <h1>Inloggen</h1>
<?php if ($user !== 'no user found' && $user !== null){?>
            <form action="orderConformation.php" method="post">
                <div class="inputRow1">
                <label for="plaats">plaats:</label>
                    <select name="plaatsSelect">
                        <?php $orders=$huur->fetchAll();
                        foreach($orders as $order) {?>
                            <option><?php echo($order['plaats']);?></option>
                        <?php }?>
                    </select>
                </div>
                <br>
                <div class="inputRow1">
                <label for="categorie">categorie:</label>
                    <select name="categorieSelect">
                        <?php
                        foreach ($orders as $order){?>
                            <option><?php echo($order['categorie']);?></option>
                        <?php }?>
                    </select>
                </div>
                <br>
                <div class="inputRow1">
                    <label for="dagDeel">dagdeel:</label>
                    <select name="dagdeelSelect">
                        <?php
                        foreach ($orders as $order){
                            ?>
                        <option><?php echo($order['dagDeel']);?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="inputRow">
                    <input type="submit" name="order" class="inputZoek" value="bestellen">
                </div>
        </div>
    </div>
    </form>
    <?php }else{ ?>
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
<?php require_once 'header.php';
require_once '../src/databaseFuncties.php';

try{
$PDO = new PDO("mysql:host=localhost;dbname=bootverhuur","root","");
if(isset($_POST['order'])) {
    $plaatsSelect = $_POST['plaatsSelect'];
    $categorieSelect = $_POST['categorieSelect'];
    $dagdeelSelect = $_POST['dagdeelSelect'];
    $sql = "INSERT INTO orders (plaats,categorie,dagDeel) values('$plaatsSelect' ,'$categorieSelect','$dagdeelSelect')";
    $boten = $PDO->prepare($sql);
    $boten->execute();

    $sql = "SELECT plaats AS 'plaats', categorie as 'boot', dagDeel AS 'dagdeel', dagDeel * price AS 'prijs' FROM orders INNER JOIN boten ON orders.categorie = boten.categorie WHERE orders.plaats = '$plaatsSelect', LIMIT 1";
    $result = $PDO->prepare($sql);
    $result->execute();
    $orderData = $result->fetchAll(PDO::FETCH_ASSOC);
}
}catch (PDOException $e){
    die("error!: " . $e->getMessage());
}
?>
    <div class="page orderConfirmation">
        <div class="container">
            <h1>Bedankt voor de bestelling!</h1>
            <table class="orderOverview" border="1">
                <tr>
                    <th>boot</th>
                    <th>plaats</th>
                    <th>dagdeel</th>
                    <th>prijs</th>
                </tr>
                <tr>
                    <?php foreach ($orderData as $order) { ?>
                    <td><?php echo $order['boot']; ?></td>
                    <td><?php echo $order['plaats']; ?></td>
                    <td><?php echo $order['dagdeel'];?></td>
                    <td><?php echo $order['prijs'];?></td>
                              <?php } ?>
                </tr>
            </table>
        </div>
    </div>
<?php include_once 'footer.php';?>
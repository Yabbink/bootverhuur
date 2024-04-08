<?php include_once 'header.php';?>
<?php include_once '../src/databaseFuncties.php';?>
<?php include_once '../src/gebruikersFuncties.php';?>
<?php include_once '../config/config.php';?>
<?php
$PDO="";
$boten ="";
try {
    $PDO = new PDO("mysql:host=localhost;dbname=bootverhuur","root","");
    $boten = db_getData('select * from boten');
}catch (PDOException $e){
    die("Error!: " . $e->getMessage());
}
?>
    <div class="page boats">
        <div class="container">
            <h1>boten</h1>
            <div class="boten">
                <?php
                foreach ($boten as $boot) {
                    echo "<div class='boot'>";
                    echo "<img src=". IMG_FOLDER . "/" . $boot['bootImage'] .  " alt=''>";
                    echo "<h2>" . $boot['categorie'] . "</h2>";
                    echo "</div>";
                }

                ?>
            </div>
        </div>
    </div>
<?php include_once 'footer.php';?>
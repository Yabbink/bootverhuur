<?php include_once '../config/database.php';?>
<?php
function db_connect(){
    try{
        $PDO = new PDO("mysql:host=localhost;dbname=bootverhuur","root","");
        return $PDO;
    }catch (PDOException $e){
        die("error!: " . $e->getMessage());
    }

}
//print_r(db_connect());
function db_getData($query){
    try {
        $PDO = new PDO("mysql:host=localhost;dbname=bootverhuur","root","");
        $query = $PDO->prepare($query);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }catch (PDOException $e){
        die("error!: " . $e->getMessage());
    }
}
//print_r(db_getData("select * from orders"));
function db_insertData($query){
    try {
        $PDO = new PDO("mysql:host=localhost;dbname=bootverhuur","root","");
        $result = $query;
        if($PDO->query($query) === true){
            $last_id = $PDO->insert_id;
            echo "New record created successfully. Last inserted ID is: " . $last_id;
        }else{
            $result = "Error: " . $query . "<br>" . $PDO->errorCode();
        }
        return $result;
    }catch (PDOException $e){
        die("error!: " . $e->getMessage());
    }
}
//print_r(db_insertData("select * from users"));

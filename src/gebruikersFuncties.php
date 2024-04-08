<?php include_once '../config/database.php';
function registerUser($firstName, $lastName, $email, $mobileNumber){
    try {
        $PDO = new PDO("mysql:host=localhost;dbname=bootverhuur","root","");
        $db = $PDO;
        $result = $db->prepare("INSERT INTO users (firstName, lastName, email, mobileNumber) 
                                  values ('$firstName' , '$lastName' , '$email' , '$mobileNumber')");
        $result->execute();
        return 1;
    } catch (PDOException $e){
    die("error!: " . $e->getMessage());
}
}
//registerUser("john", "doe","johndoe@outlook.com","06- 25 32 57 83");
function registerAdmin($adminName, $email, $mobileNumber){
    try {
        $PDO = new PDO("mysql:host=localhost;dbname=bootverhuur","root","");
        $db = $PDO;
        $result = $db->prepare("INSERT INTO adminLogin (adminName, email, mobileNumber) 
                                  values ('$adminName' , '$email' , '$mobileNumber')");
        $result->execute();
        return 1;
    } catch (PDOException $e){
    die("error!: " . $e->getMessage());
}
}
//registerAdmin("john", "doe","johndoe@outlook.com","06- 25 32 57 83");
function getAdmin($adminEmail, $adminMobileNumber){
    try {
        $PDO = new PDO("mysql:host=localhost;dbname=bootverhuur","root","");

        $adminResult = $PDO->prepare("select * from users where email = '$adminEmail', and  mobileNumber = '$adminMobileNumber'");
        $adminResult->execute();
        $beheerder = $adminResult->fetchAll(PDO::FETCH_ASSOC);
        if($beheerder > 0){
            return $beheerder;
        }else{
            return "No admin found";
        }
    }catch (PDOException $e){
        die("error!: " . $e->getMessage());
    }
}
//print_r(getAdmin("johndoe@outlook.com","06- 25 32 57 83"));
function getUser($email, $mobileNumber){
    try {
        $PDO = new PDO("mysql:host=localhost;dbname=bootverhuur","root","");

        $result = $PDO->prepare("select * from users where email = '$email', and  mobileNumber = '$mobileNumber'");
        $result->execute();
        $user = $result->fetchAll(PDO::FETCH_ASSOC);
        if($user > 0){
            return $user;
        }else{
            return "No user found";
        }
    }catch (PDOException $e){
        die("error!: " . $e->getMessage());
    }
}
//print_r(getUser("johndoe@outlook.com","06- 25 32 57 83"));

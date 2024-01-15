<?php
//include DatabaseHelper.php file
require_once('DatabaseHelper.php');

//instantiate DatabaseHelper class
$database = new DatabaseHelper();

$accountID = '';
if(isset($_POST['id'])){
    $accountID = $_POST['id'];
}

$accountName = '';
if(isset($_POST['name'])){
    $accountName = $_POST['name'];
}

$email = '';
if(isset($_POST['email'])){
    $email = $_POST['email'];
}

$age = '';
if(isset($_POST['age'])){
    $age = $_POST['age'];
}

$accountHouseID = '';
if(isset($_POST['houseID'])){
    $accountHouseID = $_POST['houseID'];
}

$accountHouseRoleID = '';
if(isset($_POST['houseRoleID'])){
    $accountHouseRoleID = $_POST['houseRoleID'];
}


//Update method
if($database->houseExists($accountHouseID) == false){
    echo"House with the ID: {$accountHouseID} does not exist!";    
}else if($database->houseRoleExists($accountHouseRoleID) == false){
    echo"HouseRole with the ID: {$accountHouseRoleID} does not exist!";    
}else{
    $success = $database->updateAccount($accountID, $accountName, $email, $age, $accountHouseID, $accountHouseRoleID);

    // Check result
    if ($success){
        echo "Account '{$accountName} {$email} {$age} {$accountHouseID} {$accountHouseRoleID}' successfully updated!'";
    }
    else{
        echo "Error can't update Account '{$accountName} {$email} {$age} {$accountHouseID} {$accountHouseRoleID}'!";
    }
}
?>


<!-- link back to index page-->
<link rel="stylesheet" href="css/styles.css">
<br>
<a href="index.php">
    go back
</a>
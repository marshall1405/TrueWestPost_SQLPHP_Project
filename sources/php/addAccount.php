<?php
require_once('DatabaseHelper.php');

$database = new DatabaseHelper();

$accountName = '';
if(isset($_POST['accountName'])){
    $accountName = $_POST['accountName'];
}

$email = '';
if(isset($_POST['email'])){
    $email = $_POST['email'];
}

$age = 0;
if(isset($_POST['age'])){
    $age = (INT)$_POST['age'];
}

$accountHouseID = 0;
if(isset($_POST['accountHouseID'])){
    $accountHouseID = (INT)$_POST['accountHouseID'];
}

$accountHouseRoleID = 0;
if(isset($_POST['accountHouseRoleID'])){
    $accountHouseRoleID = (INT)$_POST['accountHouseRoleID'];
}


if($database->houseExists($accountHouseID) == false){
    echo"House with the ID: {$accountHouseID} does not exist!";    
}else if($database->houseRoleExists($accountHouseRoleID) == false){
    echo"HouseRole with the ID: {$accountHouseRoleID} does not exist!";    
}else{
    $success = $database->insertIntoAccounts($accountName, $email, $age, $accountHouseID, $accountHouseRoleID);

    if ($success){
        echo "Account '{$accountName} {$email} {$age} {$accountHouseID} {$accountHouseRoleID}' successfully added!'";
    }
    else{
        echo "Error can't insert Account '{$accountName} {$email} {$age} {$accountHouseID} {$accountHouseRoleID}'!";
    }
}
?>

<!-- link back to index page-->
<br>
<link rel="stylesheet" href="css/styles.css">
<a href="index.php">
    go back
</a>
<?php
//include DatabaseHelper.php file
require_once('DatabaseHelper.php');

//instantiate DatabaseHelper class
$database = new DatabaseHelper();

$houseID = '';
if(isset($_POST['id'])){
    $houseID = $_POST['id'];
}

$houseName = '';
if(isset($_POST['name'])){
    $houseName = $_POST['name'];
}

$creatorCount = '';
if(isset($_POST['creatorCount'])){
    $creatorCount = $_POST['creatorCount'];
}

$fanCount = '';
if(isset($_POST['fanCount'])){
    $fanCount = $_POST['fanCount'];
}

// Update method
$success = $database->updateHouse($houseID,$houseName);

// Check result
if ($success){
    echo "House '{$houseName} {$creatorCount} {$fanCount}' successfully updated!'";
}
else{
    echo "Error can't update House '{$houseName} {$creatorCount} {$fanCount}'!";
}
?>

<!-- link back to index page-->
<link rel="stylesheet" href="css/styles.css">
<br>
<a href="index.php">
    go back
</a>
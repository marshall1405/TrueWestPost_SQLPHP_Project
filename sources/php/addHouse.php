<?php
require_once('DatabaseHelper.php');

$database = new DatabaseHelper();

$houseName = '';
if(isset($_POST['houseName'])){
    $houseName = $_POST['houseName'];
}

$creatorCount = 0;
if(isset($_POST['creatorCount'])){
    $creatorCount = (INT)$_POST['creatorCount'];
}

$fanCount = 0;
if(isset($_POST['fanCount'])){
    $fanCount = (INT)$_POST['fanCount'];
}

$success = $database->insertIntoHouses($houseName);

if ($success){
    echo "House '{$houseName} {$creatorCount} {$fanCount}' successfully added!'";
}
else{
    echo "Error can't insert House '{$houseName} {$creatorCount} {$fanCount}'!";
}
?>

<!-- link back to index page-->
<link rel="stylesheet" href="css/styles.css">
<br>
<a href="index.php">
    go back
</a>
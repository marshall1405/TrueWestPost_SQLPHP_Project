<?php
//include DatabaseHelper.php file
require_once('DatabaseHelper.php');

//instantiate DatabaseHelper class
$database = new DatabaseHelper();

//Grab variable id from POST request
$houseID = '';
if(isset($_POST['id'])){
    $houseID = $_POST['id'];
}

// Delete method
$error_code = $database->deleteHouse($houseID);

// Check result
if ($error_code == 1){
    echo "House with ID: '{$houseID}' successfully deleted!'";
}
else{
    echo "Error can't delete House with ID: '{$houseID}'. Errorcode: {$error_code}";
}
?>

<!-- link back to index page-->
<link rel="stylesheet" href="css/styles.css">
<br>
<a href="index.php">
    go back
</a>
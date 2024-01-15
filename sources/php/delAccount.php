<?php
//include DatabaseHelper.php file
require_once('DatabaseHelper.php');

//instantiate DatabaseHelper class
$database = new DatabaseHelper();

//Grab variable id from POST request
$accountID = '';
if(isset($_POST['id'])){
    $accountID = $_POST['id'];
}


if($database->accountExists($accountID)){
    // Delete method
    $success = $database->deleteAccount($accountID);

    // Check result
    if ($success){
        echo "Account with ID: '{$accountID}' successfully deleted!'";
    }
    else{
        echo "Error can't delete Account with ID: '{$accountID}";
    }
}else{
    echo"Account with ID: {$accountID} does not exist";
}

?>

<!-- link back to index page-->
<link rel="stylesheet" href="css/styles.css">
<br>
<a href="index.php">
    go back
</a>
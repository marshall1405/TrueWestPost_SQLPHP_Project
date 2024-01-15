<?php
//include DatabaseHelper.php file
require_once('DatabaseHelper.php');

//instantiate DatabaseHelper class
$database = new DatabaseHelper();

$accountID = '';
if(isset($_POST['id'])){
    $accountID = $_POST['id'];
}

$flag = $database->accountExists($accountID);

if($database->accountExists($accountID)){
    $accountName = $database->getCurrentAccountName($accountID);

    $email = $database->getCurrentEmail($accountID);

    $age = $database->getCurrentAge($accountID);

    $accountHouseID = $database->getCurrentAccountHouseID($accountID);

    $accountHouseRoleID = $database->getCurrentAccountHouseRoleID($accountID);

    ?>

    <html>
        <h1>Update Window</h1>
        <br>
        <hr>
        <form method="post" action="updateAccount.php">
            <div>
                <label for="currentAccountID">ID: </label>
                <span id="currentAccountID"><?php echo htmlspecialchars($accountID); ?></span>
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($accountID); ?>">
            </div>
            <div>
                <label for="updateAccountName">Name: </label>
                <input id="updateAccountName" name = "name" type="text" value="<?php echo htmlspecialchars($accountName); ?>">
            </div>
            <br>
            <div>
                <label for="updateEmail">Email: </label>
                <input id="updateEmail" name="email" type="text" value="<?php echo htmlspecialchars($email); ?>">
            </div>
            <br>
            <div>
                <label for="updateAge">Age: </label>
                <input id="updateAge" name="age" type="number" value="<?php echo htmlspecialchars($age);?>">
            </div>
            <br>
            <div>
                <label for="updateAccountHouseID">HouseID: </label>
                <input id="updateAccountHouseID" name="houseID" type="number" value="<?php echo htmlspecialchars($accountHouseID);?>">
            </div>
            <br>
            <div>
                <label for="updateAccountHouseRoleID">HouseRoleID: </label>
                <input id="updateAccountHouseRoleID" name="houseRoleID" type="number" value="<?php echo htmlspecialchars($accountHouseRoleID);?>">
            </div>
            <div>
                <button type="submit">
                    Update
                </button>
            </div>
        </form>
    </html>
    <?php
}else{
    echo"The account with ID: {$accountID} does not exist.";
}
?>

<br>
<link rel="stylesheet" href="css/styles.css">
<a href="index.php">
    go back
</a>

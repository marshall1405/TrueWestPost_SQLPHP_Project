<?php

// Include DatabaseHelper.php file
require_once('DatabaseHelper.php');

// Instantiate DatabaseHelper class
$database = new DatabaseHelper();

//HOUSE

$houseID = '';
if(isset($_GET['houseID'])){
    $houseID = $_GET['houseID'];
}

$houseName = '';
if(isset($_GET['houseName'])){
    $houseName = $_GET['houseName'];
}

$creatorCount = 0;
if(isset($_GET['creatorCount'])){
    $creatorCount = (INT)$_GET['creatorCount'];
}

$fanCount = 0;
if(isset($_GET['fanCount'])){
    $fanCount = (INT)$_GET['fanCount'];
}

//HOUSEROLE

$houseRoleID = '';
if(isset($_GET['houseRoleID'])){
    $houseRoleID = $_GET['houseRoleID'];
}

//ACCOUNT
$accountID = '';
if(isset($_GET['accountID'])){
    $accountID = $_GET['accountID'];
}

$accountName = '';
if(isset($_GET['accountName'])){
    $accountName = $_GET['accountName'];
}

$email = '';
if(isset($_GET['email'])){
    $email = $_GET['email'];
}

$age = 0;
if(isset($_GET['age'])){
    $age = (INT)$_GET['age'];
}

$accountHouseID = '';
if(isset($_GET['accountHouseID'])){
    $accountHouseID = $_GET['accountHouseID'];
}

$accountHouseRoleID = '';
if(isset($_GET['accountHouseRoleID'])){
    $accountHouseRoleID = $_GET['accountHouseRoleID'];
}


//Fetch data from database
$houseArray = $database->selectAllHouses($houseID, $houseName, $creatorCount, $fanCount);
$accountArray = $database->selectAllAccounts($accountID, $accountName, $email, $age, $accountHouseID, $accountHouseRoleID);
?>

<html>
<link rel="stylesheet" href="css/styles.css">
<head>
    <title>TrueWestPost</title>
</head>

<body>
<br>
<h1>Accounts</h1>
<!-- Add Accounts -->
<h2>Add Account: </h2>
<form method="post" action="addAccount.php">
    <div>
        <label for="newAccountName">Account Name:</label>
        <input id="newAccountName" name="accountName" type="text">
    </div>
    <br>

    <!-- Email textbox -->
    <div>
        <label for="newEmail">Email:</label>
        <input id="newEmail" name="email" type="text">
    </div>
    <br>

    <!-- Age textbox -->
    <div>
        <label for="newAge">Age:</label>
        <input id="newAge" name="age" type="number" maxlength="3">
    </div>
    <br>

    <div>
        <label for="newAccountHouseID">Account HouseID:</label>
        <input id="newAccountHouseID" name="accountHouseID" type="text">
    </div>
    <br>

    <div>
        <label for="newAccountHouseRoleID">Account HouseRoleID:</label>
        <input id="newAccountHouseRoleID" name="accountHouseRoleID" type="text">
    </div>
    <br>

    <!-- Submit button -->
    <div>
        <button type="submit">
            Add Account
        </button>
    </div>
</form>

<br>
<hr>

<!-- Delete Account -->
<h2>Delete Account: </h2>
<form method="post" action="delAccount.php">
    <!-- ID textbox -->
    <div>
        <label for="del_account">ID:</label>
        <input id="del_account" name="id" type="number" min="0">
    </div>
    <br>

    <!-- Submit button -->
    <div>
        <button type="submit">
            Delete Account
        </button>
    </div>
</form>
<br>
<hr>

<!-- Update Account -->
<h2>Update Account: </h2>
<form method="post" action="updateWindowAccount.php">
    <div>
        <label for="updateID">ID: </label>
        <input id="updateID" name = "id" type="number" mind = "0">
    </div>
    <br>
    <div>
        <button type="submit">
            Update
        </button>
    </div>
</form>
<br>
<hr>
<a href="index.php">
    go back
</a>
<!-- Search result -->
<h2>Accounts:</h2>
<div class="array">
    <table>
        <tr>
            <th>ID</th>
            <th>AccountName</th>
            <th>Email</th>
            <th>Age</th>
            <th>AccountHouseID</th>
            <th>AccountHouseRoleID</th>
        </tr>
        <?php foreach ($accountArray as $Accounts) : ?>
            <tr>
            <td><?php echo $Accounts['ACCOUNTID']; ?> </td>
            <td><?php echo $Accounts['ACCOUNTNAME']; ?> </td>
            <td><?php echo $Accounts['EMAIL']; ?> </td>
            <td><?php echo $Accounts['AGE']; ?> </td>
            <td><?php echo $Accounts['HOUSEID']; ?> </td>
            <td><?php echo $Accounts['HOUSEROLEID']; ?> </td>
            </tr>
        <?php endforeach; ?>
    </table>   
</div>

<br>
<hr>
<br>
<a href="index.php">
    go back
</a>
</body>
</html>
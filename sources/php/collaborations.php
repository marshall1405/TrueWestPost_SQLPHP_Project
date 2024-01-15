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

$houseRoleName = '';
if(isset($_GET['houseRoleName'])){
    $houseRoleName = $_GET['houseRoleName'];
}

$tasks = '';
if(isset($_GET['tasks'])){
    $tasks = $_GET['tasks'];
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

//CREATOR
$creatorID = '';
if(isset($_GET['creatorID'])){
    $creatorID = $_GET['creatorID'];
}

$creatorAccountID = '';
if(isset($_GET['creatorAccountID'])){
    $creatorAccountID = $_GET['creatorAccountID'];
}

$creatorFanCount = '';
if(isset($_GET['creatorFanCount'])){
    $creatorFanCount = $_GET['creatorFanCount'];
}

$monthlyReaderCount = '';
if(isset($_GET['monthlyReaderCount'])){
    $monthlyReaderCount = $_GET['monthlyReaderCount'];
}

//COLLABORATIONS
$collaborationID = '';
if(isset($_GET['collaborationID'])){
    $collaborationID = $_GET['collaborationID'];
}

$collaborationCreator1 = '';
if(isset($_GET['collaborationCreator1'])){
    $collaborationCreator1 = $_GET['collaborationCreator1'];
}

$collaborationCreator2 = '';
if(isset($_GET['collaborationCreator2'])){
    $collaborationCreator2 = $_GET['collaborationCreator2'];
}


//Fetch data from database
$houseArray = $database->selectAllHouses($houseID, $houseName, $creatorCount, $fanCount);
$accountArray = $database->selectAllAccounts($accountID, $accountName, $email, $age, $accountHouseID, $accountHouseRoleID);
$houseRoleArray = $database->selectAllHouseRoles($houseRoleID, $houseRoleName, $tasks);
$creatorArray = $database->selectAllCreators($creatorID, $creatorAccountID, $creatorFanCount, $monthlyReaderCount);
$collaborationArray = $database->selectAllCollaborations($collaborationID, $collaborationCreator1, $collaborationCreator2);
?>

<html>
<link rel="stylesheet" href="css/styles.css">
<head>
    <title>TrueWestPost</title>
</head>

<body>
<br>
<h1>Collaborations:</h1>

<!-- Search result -->
<div class="array">
    <table>
        <tr>
            <th>CollaborationID</th>
            <th>Creator1</th>
            <th>Creator2</th>
        </tr>
        <?php foreach ($collaborationArray as $Collaborations) : ?>
            <tr>
            <td><?php echo $Collaborations['COLLABORATIONID']; ?> </td>
            <td><?php echo $Collaborations['CREATOR1']; ?> </td>
            <td><?php echo $Collaborations['CREATOR2']; ?> </td>
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
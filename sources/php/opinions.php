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

//OPINIONS
$opinionCreatorID = '';
if(isset($_GET['opinionCreatorID'])){
    $opinionCreatorID = $_GET['opinionCreatorID'];
}

$opinionArticleID = '';
if(isset($_GET['opinionArticleID'])){
    $opinionArticleID = $_GET['opinionArticleID'];
}

$opinionReaderCount = '';
if(isset($_GET['opinionReaderCount'])){
    $opinionReaderCount = $_GET['opinionReaderCount'];
}

$opinionCommunityRating = '';
if(isset($_GET['opinionCommunityRating'])){
    $opinionCommunityRating = $_GET['opinionCommunityRating'];
}


//Fetch data from database
$houseArray = $database->selectAllHouses($houseID, $houseName, $creatorCount, $fanCount);
$accountArray = $database->selectAllAccounts($accountID, $accountName, $email, $age, $accountHouseID, $accountHouseRoleID);
$opinionArray = $database->selectAllOpinions($opinionCreatorID, $opinionArticleID, $opinionReaderCount, $opinionCommunityRating);
?>

<html>
<link rel="stylesheet" href="css/styles.css">
<head>
    <title>TrueWestPost</title>
</head>

<body>
<br>
<a href="index.php">
    go back
</a>
<h1>Opinions:</h1>

<!-- Search result -->
<div class="array">
<table>
    <tr>
        <th>CreatorID</th>
        <th>ArticleID</th>
        <th>Reader Count</th>
        <th>Community Rating</th>
    </tr>
    <?php foreach ($opinionArray as $Opinions) : ?>
        <tr>
        <td><?php echo $Opinions['CREATORID']; ?> </td>
        <td><?php echo $Opinions['ARTICLEID']; ?> </td>
        <td><?php echo $Opinions['READERCOUNT']; ?> </td>
        <td><?php echo $Opinions['COMMUNITYRATING']; ?> </td>
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
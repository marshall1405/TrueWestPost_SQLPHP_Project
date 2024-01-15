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

//ARTICLES
$arcticleID = '';
if(isset($_GET['articleID'])){
    $articleID = $_GET['articleID'];
}

$arcticleName = '';
if(isset($_GET['articleName'])){
    $articleName = $_GET['articleName'];
}

$isCollaboration = '';
if(isset($_GET['isCollaboration'])){
    $isCollaboration = $_GET['isCollaboration'];
}

$articleAuthor = '';
if(isset($_GET['articleAuthor'])){
    $articleAuthor = $_GET['articleAuthor'];
}

$articleCollaboration = '';
if(isset($_GET['articleCollaboration'])){
    $articleCollaboration = $_GET['articleCollaboration'];
}

$articleReaderCount = '';
if(isset($_GET['articleReaderCount'])){
    $articleReaderCount = $_GET['articleReaderCount'];
}

$articleOpinionCount = '';
if(isset($_GET['articleOpinionCount'])){
    $articleOpinionCount = $_GET['articleOpinionCount'];
}


//Fetch data from database
$houseArray = $database->selectAllHouses($houseID, $houseName, $creatorCount, $fanCount);
$accountArray = $database->selectAllAccounts($accountID, $accountName, $email, $age, $accountHouseID, $accountHouseRoleID);
$houseRoleArray = $database->selectAllHouseRoles($houseRoleID, $houseRoleName, $tasks);
$creatorArray = $database->selectAllCreators($creatorID, $creatorAccountID, $creatorFanCount, $monthlyReaderCount);
$articleArray = $database->selectAllArticles($articleID, $articleName, $isCollaboration,$articleAuthor,$articleCollaboration, $articleReaderCount, $articleOpinionCount);
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
<h1>Articles:</h1>

<!-- Search result -->
<div class="array">
<table>
    <tr>
        <th>ArticleID</th>
        <th>ArticleName</th>
        <th>IsCollaboration</th>
        <th>Author</th>
        <th>Collaboration</th>
        <th>ReaderCount</th>
        <th>OpinionCount</th>
    </tr>
    <?php foreach ($articleArray as $Articles) : ?>
        <tr>
        <td><?php echo $Articles['ARTICLEID']; ?> </td>
        <td><?php echo $Articles['ARTICLENAME']; ?> </td>
        <td><?php echo $Articles['ISCOLLABORATION']; ?> </td>
        <td><?php echo $Articles['AUTHOR']; ?> </td>
        <td><?php echo $Articles['COLLABORATION']; ?> </td>
        <td><?php echo $Articles['READERCOUNT']; ?> </td>
        <td><?php echo $Articles['OPINIONCOUNT']; ?> </td>
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
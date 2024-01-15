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
    $monthlyReaders = $_GET['monthlyReaderCount'];
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
?>

<html>
    <link rel="stylesheet" href="css/styles.css">
    <h1>Main Menu</h1>
    <br>
    <hr>
    <div class="main_menu">
        <a href="houses.php">Houses</a>
        <a href="houseRoles.php">HouseRoles</a>
        <a href="accounts.php">Accounts</a>
        <a href="creators.php">Creators</a>
        <a href="collaborations.php">Collaborations</a>
        <a href="articles.php">Articles</a>
        <a href="opinions.php">Opinions</a> 
    </div>
    <br>
    <hr>
    <br>
    <h2>Procedure:</h2>
    <h4>Change Name Of The Most Influential Article</h4>
    <form method="post" action="updateMostInfluentialArticle.php">
        <div>
            <label for="articleName">Name: </label>
            <input id="articleName" name="name" type="text">
        </div>
        <div>
            <button type="submit">
                Update
            </button>
        </div>
    </form>
</html>
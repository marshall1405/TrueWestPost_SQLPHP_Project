<?php
//include DatabaseHelper.php file
require_once('DatabaseHelper.php');

//instantiate DatabaseHelper class
$database = new DatabaseHelper();

$houseID = '';
if(isset($_POST['id'])){
    $houseID = $_POST['id'];
}

$flag = $database->houseExists($houseID);

if($database->houseExists($houseID)){
    $houseName = $database->getCurrentHouseName($houseID);

    $creatorCount = $database->getCurrentCreatorCount($houseID);

    $fanCount = $database->getCurrentFanCount($houseID);
    ?>

    <html>
        <link rel="stylesheet" href="css/styles.css">
        <h1>Update Window</h1>
        <br>
        <hr>
        <form method="post" action="updateHouse.php">
            <div>
                <label for="currentHouseID">ID: </label>
                <span id="currentHouseID"><?php echo htmlspecialchars($houseID); ?></span>
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($houseID); ?>">
            </div>
            <div>
                <label for="updateHouseName">Name: </label>
                <input id="updateHouseName" name = "name" type="text" value="<?php echo htmlspecialchars($houseName); ?>">
            </div>
            <br>
            <div>
                <button type="submit">
                    Update
                </button>
            </div>
        </form>
    </html>
    <?php
}else{
    echo"The house with ID: {$houseID} does not exist.";
}
?>
<link rel="stylesheet" href="css/styles.css">
<br>
<a href="index.php">
    go back
</a>

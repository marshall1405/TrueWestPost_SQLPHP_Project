<?php
require_once('DatabaseHelper.php');

$database = new DatabaseHelper();

$articleName = '';
if(isset($_POST['name'])){
    $articleName = $_POST['name'];
}

$success = $database->updateMostInfluentialArticle($articleName);

$messages = $database->getMessages();
foreach ($messages as $message) {
    echo $message . "<br>";
}

?>
<html>
<link rel="stylesheet" href="css/styles.css">
<a href="index.php">go back</a>
</html>

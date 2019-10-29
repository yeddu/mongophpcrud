<?php
//including the database connection file
include("config.php");
 
//getting id of the data from url
$id = $_GET['id'];
 
//deleting the row from table/collection
$db->deleteOne(array('_id' => new MongoDB\BSON\ObjectID($id)));
 
//redirecting to the display page (index.php in our case)
header("Location:index.php");
?>
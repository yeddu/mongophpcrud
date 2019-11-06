<html>
<head>
    <title>Add Data</title>
</head>
 
<body>
<?php
//including the database connection file
include_once("config.php");
ini_set("max_execution_time", "6000");
ini_set("upload_max_filesize", "1000M");
ini_set("post_max_size", "1000M");
 
if(isset($_POST['Submit'])) {   
    if (isset($_FILES["cover"]) && !empty($_FILES["cover"]["tmp_name"])) {
        $user["cover"] =  new MongoDB\BSON\Binary(file_get_contents($_FILES["cover"]["tmp_name"]), MongoDB\BSON\Binary::TYPE_GENERIC);
    }
    $user["name"] = $_POST['name'];
    $user["age"]= $_POST['age'];
    $user["email"] = $_POST['email'];
        
    // checking empty fields
    $errorMessage = '';
    foreach ($user as $key => $value) {
        if (empty($value)) {
            $errorMessage .= $key . ' field is empty<br />';
        }
    }
    
    if ($errorMessage) {
        // print error message & link to the previous page
        echo '<span style="color:red">'.$errorMessage.'</span>';
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";    
    } else {
        //insert data to database table/collection named 'users'
        try{
            $db->insertOne($user);

            //display success message
            echo "<font color='green'>Data added successfully.";
            echo "<br/><a href='index.php'>View Result</a>";
        } catch(MongoDB\Driver\Exception\BulkWriteException $e) {
            $filename = basename(__FILE__);
            echo "The $filename script has experienced an error.<br/>"; 
            echo "It failed with the following exception:<br/>";
            echo "Exception:", $e->getMessage(), "<br/>";
            echo "In file:", $e->getFile(), "<br/>";
            echo "On line:", $e->getLine(), "<br/>";    
        }
    }
}
?>
</body>
</html>
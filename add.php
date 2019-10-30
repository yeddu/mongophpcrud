<html>
<head>
    <title>Add Data</title>
</head>
 
<body>
<?php
//including the database connection file
include_once("config.php");
 
if(isset($_POST['Submit'])) {   
    if (isset($_FILES["cover"]) && !empty($questionCover["tmp_name"])) {
        $questionCover = $_FILES["cover"];
        $user["cover"] =  new MongoDB\BSON\Binary(file_get_contents($questionCover["tmp_name"]), MongoDB\BSON\Binary::TYPE_GENERIC);
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
<?php


//var_dump( extension_loaded('mongodb') );
   // connect to mongodb
   
   /*$m = new MongoDB\Driver\Manager("mongodb://localhost:27017");
   //$m = new MongoClient();
   echo "Connection to database successfully";
	
   // select a database
   $db = $m->mydb;
   echo "Database mydb selected";
   $collection = $db->mycol;
   echo "Collection selected succsessfully";

   $cursor = $collection->find();
   // iterate cursor to display title of documents
	
   foreach ($cursor as $document) {
      echo $document["title"] . "\n";
   }*/
?>
<?php
//including the database connection file
include_once("config.php");


$page  = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$limit = 12;
$skip  = ($page - 1) * $limit;
$next  = ($page + 1);
$prev  = ($page - 1);

$options = [
    "limit" => $limit,
    "skip" => $skip
];

$result = $db->find([], $options);
// select data in descending order from table/collection "users"
//$result = $collection->findOne(['name' => 'Raju Sharma']);echo "<pre>";var_dump($result);
//$result = $db->users->find(array('_id' => -1));
?>
 
<html>
<head>    
    <title>Homepage</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>
 
<body>
<a href="add.html">Add New Data</a><br/><br/>
    <table width='80%' border=0>
 
        <tr bgcolor='#CCCCCC'>
            <td>Name</td>
            <td>Age</td>
            <td>Email</td>
            <td>Profile</td>
            <td>Update</td>
        </tr>
        <?php     
            foreach ($result as $res) {
                echo "<tr>";
                echo "<td>".$res['name']."</td>";
                echo "<td>".$res['age']."</td>";
                echo "<td>".$res['email']."</td>";    
                echo "<td>".'<img src="data:jpeg;base64,'.(!is_null($res['cover'])? base64_encode($res['cover']) : '').'" />'."</td>";;
                echo "<td><a href=\"edit.php?id=$res[_id]\">Edit</a> | <a href=\"delete.php?id=$res[_id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>"; 
                echo "</tr>";
            }
        ?>
    </table>
		<?php 
			$total= $db->count();
			if($page > 1){
			echo '<a href="?page=' . $prev . '">Previous</a>';
			if($page * $limit < $total) {
				echo ' <a href="?page=' . $next . '">Next</a>';
			}
		} else {
			if($page * $limit < $total) {
				echo ' <a href="?page=' . $next . '">Next</a>';
			}
		}
		?>
</body>
</html>
<?php
//including the database connection file
include_once("config.php");

$page  = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$limit = 30;
$skip  = ($page - 1) * $limit;
$next  = ($page + 1);
$prev  = ($page - 1);

$options = [
    "limit" => $limit,
    "skip" => $skip
];
$cnt = (new MongoDB\Client)->test->{"fs.files"};
$bucket = (new MongoDB\Client)->test->selectGridFSBucket();
$results = $bucket->find([], $options);
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
    <div class="container-fluid">
        <a href="add.html">Add New Data</a><br/><br/>
        <?php 
            echo "<div class='row'>";
            $i=1;
            foreach ($results as $res) {
                $path_info = pathinfo($res['filename']);
                if($i%6 == 0 ){$i=1;echo "</div><div class='row'>";}
                if(in_array($path_info['extension'], ['jpg', 'jpeg','png','bmp','webp'] )) {
                   echo '<div class="col-md-2">
                                <img src="./stream.php?name='.$res['filename'].'" width="300" height="240">'.$i.'
                        </div>';
                    //echo '<div class="col-lg-1 pics animation all 2"><img src="./stream.php?name='.$res['filename'].'" width="320" height="240"> </div>';
                } else if(in_array($path_info['extension'], ['mp3', 'mp4','3gp'] )){
                   echo '<div class="col-md-2">
                                <video width="300" height="240" autoplay controls><source src="./stream.php?name='.$res['filename'].'" type="video/mp4">Your browser does not support the video tag.</video>
                          '.$i.'
                        </div>';
                    //echo '<div class="col-lg-1"><video width="320" height="240" autoplay controls><source src="./stream.php?name='.$res['filename'].'" type="video/mp4">Your browser does not support the video tag.</video></div>';
                }
                $i++;
            }
            echo "</div>";
        ?>
        <div class='row' style="float:right">
            <b>
		<?php 
                    $total= $cnt->count();
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
            </b>
	</div>
    </div>
</body>
</html>
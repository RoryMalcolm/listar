<?php
$playlist_id = 0;
$db = new PDO('mysql:host=localhost;dbname=listar;charset=utf8', 'root', 'root');
try{

$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

$result = mysql_query('SELECT * FROM `tracks` WHERE `playlist_id` = '.$playlist_id.'');

if (!$result) {
    echo 'list does not exist';
}
    
    foreach($db->query('SELECT * FROM tracks WHERE playlist_id = '.$playlist_id.' ORDER BY karma DESC') as $row){ 
    ?>
        <li id="<? echo $row['id'] ?>" class = "trackwrap">
            <div class = "scorewrap">
                <div class = "trackscore"><? echo $row['karma'] ?> points</div>
                <button class = "upvote" type="button">+</button>
                <button class = "downvote" type="button">-</button>
                <button class = "deletebutt" type="button">delete</button>
            </div>
            <a  class = "tracklink" href="<? echo $row['url'] ?>"><? echo $row['title'] ?></a>
        </li>
    <?php
    }
    if (empty($row)){
      ?> <li id="emptylistmessage"><p>list is empty :(</p><p>add some stuff above</p></li> <?php
    }
}
catch(PDOException $ex) {
    echo "something is wrong";
    some_logging_function($ex->getMessage());
}
?>

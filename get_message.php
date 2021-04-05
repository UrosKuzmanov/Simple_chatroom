<?php 
include "DB/connect_db.php";
$username= stripslashes(htmlspecialchars($_GET['username']));
$result=$db_msqli->prepare("SELECT * FROM messages ");
$result->execute();
$result=$result->get_result();
while($r=$result->fetch_row()){
    echo $r[1]."\\".$r[2]."\n";
}

<?php 
include "DB/connect_db.php";
$username= stripslashes(htmlspecialchars($_GET['username']));
$message=stripslashes(htmlspecialchars($_GET['message']));
if(empty($username)|| empty($message)){
    die();
}
/*$query="INSERT INTO messages (username, message ) VALUE ('$username','$message')";
$query_do=mysqli_query($connect_db,$query);*/
$result=$db_msqli->prepare("INSERT INTO messages (username, message )  VALUE (?,?)");
$result->bind_param("ss", $username, $message);
$result->execute(); 
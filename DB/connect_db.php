<?php
$db["db_host"]="localhost"; //DB fro two diferent way of php coding
$db["db_user"]="root";
$db["db_pass"]="tribulus1";
$db["db_name"]="messeger";
foreach($db as $key=>$value){
    define(strtoupper($key),$value);
}
$connect_db=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
if(!$connect_db){
    echo " DB connecting problem";
}

$db_msqli=new mysqli("localhost","root","tribulus1","messeger");
if($db_msqli->connect_error){
    echo " DB connecting problem";
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

$DBMS = 'mysqli';
$dbname = "tsc";//"I4010_tlpao";
$dbhost = "tsc_db_1";
$dbuser = "root";
$dbpwd = "1234";


$conn = mysqli_connect($dbhost,$dbuser,$dbpwd,$dbname);
mysqli_query($conn,"SET NAMES 'UTF8'");

//$conn = mysqli_connect($db_server,$db_user,$db_passwd,$db_name);
//mysqli_query($conn,"SET NAMES 'UTF8'");

?>

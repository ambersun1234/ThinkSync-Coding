<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

/*$db_server = "localhost";
$db_name = "beta";
$db_user = "root";
$db_passwd = "";
*/
$DBMS = 'mysqli';
$dbname = "I4010_9608";//"I4010_tlpao";
$dbhost = "140.129.25.238";
//"140.129.25.238";//"i4010.cse.ttu.edu.tw";//140.12
$dbuser = "ui3a11";
$dbpwd = "tdhudinm0437";


$conn = mysqli_connect($dbhost,$dbuser,$dbpwd,$dbname);
mysqli_query($conn,"SET NAMES 'UTF8'");

//$conn = mysqli_connect($db_server,$db_user,$db_passwd,$db_name);
//mysqli_query($conn,"SET NAMES 'UTF8'");

?>

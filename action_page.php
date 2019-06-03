<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include_once("./include/mysql_connect.inc.php");
//include("./include/db/configure.php");
//include("./include/db/db_func.php");
//include("./include/commonFunction.php");
if(!empty($_POST["T1"])){
    $Name = $_POST["T1"];
    ini_set("SMTP","ssl://smtp.gmail.com");
    ini_set("smtp_port","587");
    echo $Name;
    $Subject = $_POST["T2"];
    $uEmail = $_POST["T3"];
    $Advice = $_POST["T4"];
    mb_internal_encoding("utf-8");
    //$to = "12016768877@mailinator.com";//填入自己的電子信箱
    $to = "u10506111@ms.ttu.edu.tw";
    $subject = mb_encode_mimeheader("$Subject", "utf-8");
    $message = "From: < "."$uEmail"." >"."<br>"."By: "."$Name"."<br>"."<br>******************************************<br>"."$Advice";
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";
    $headers .= "From:".mb_encode_mimeheader("$Name","utf-8")."<$uEmail>\r\n";
    ini_set('display_error', '1');
    mail($to, $Subject, $message, $headers);
    echo "寄件成功!";
}
?>
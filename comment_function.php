<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
    //include("mysql_connect.inc.php");
    //include("blue_head.inc.php");
    session_start();
    if (isset($_SESSION["uid"]) && !empty($_SESSION["uid"])) {
        $uid = $_SESSION["uid"];
    }
    if (isset($_SESSION["email"]) && !empty($_SESSION["email"])) {
        $email = $_SESSION["email"];
    }

    include_once("./include/db/configure.php");
    include_once("./include/db/db_func.php");
    include_once("./include/commonFunction.php");
    include_once("./include/head_line.inc.php");

    $db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);
    $text = $_POST["comment"];
    $id = $_POST["myid"]; //from session id
    $pid = $_POST["post_id"];//from hidden post
    //$currentPage = $_POST["currentState"];
    date_default_timezone_set('Asia/Taipei');
    $date = date("Y-m-d H:i:s");
    if($text != null) {
        $sql = "INSERT INTO tsc_comment (UserIndex, Time, PostIndex , CommentContent, Valid) VALUES ('$id', '$date', '$pid', '$text', '0')";
        $ret_sql = querydb($sql, $db_conn);
        if($ret_sql == TRUE) {
            //exit();
            
            //echo "<img src = './pic/Commentsuccess.png' width='90%' style='display:block; margin:auto;'>";
            //echo "<meta http-equiv=REFRESH CONTENT=1;url='view_article.php'>";
        }
        else {
            echo "Faild!";
            exit();
        }
    }
?>
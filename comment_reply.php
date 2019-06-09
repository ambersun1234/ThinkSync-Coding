<?php
    include_once("./include/db/configure.php");
    include_once("./include/db/db_func.php");
    include_once("./include/commonFunction.php");

    $db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);
    $returnData = array();

    if(isset($_POST['text'])) {
        $text = $_POST['text'];
        $commentIndex = $_POST['commentIndex'];
        $id = $_POST['ID'];
        date_default_timezone_set('Asia/Taipei');
        $date = date("Y-m-d H:i:s");
        $userIndexSql = "SELECT * FROM tsc_account WHERE tsc_account.UserIndex = '$id'";
        //$rs = mysqli_query($conn, $userIndexSql);
        //$res = mysqli_fetch_array($rs);
        $rs = querydb($userIndexSql, $db_conn);
        
        $UserIndex = $rs[0]['UserIndex'];
        
        $insertReply = "INSERT INTO tsc_reply (UserIndex, CommentIndex, Time, ReplyContent, Valid) VALUES ('$UserIndex', '$commentIndex', '$date', '$text', '0')";
        $result = updatedb($insertReply, $db_conn);
        
        
        if($result != TRUE) $returnData["sql"] = $insertReply;
        else $returnData["sql"] = "success";
        
        echo json_encode($returnData);
        //echo $text;
    } else {
        $returnData["sql"] = "text = null";
        echo json_encode($returnData);
    }
    /*function getReply($commentIndex)
    {
        global $conn;
        $sql = "SELECT AVG(tsc_ratin.Stars) FROM tsc_rating
                WHERE tsc_rating.PostIndex = '$PostIndex' GROUP BY (tsc_rating.PostIndex)";
        $rs = querydb($sql, $db_conn);
        //$result = mysqli_fetch_array($rs);
        return $result;//
    }*/
?>
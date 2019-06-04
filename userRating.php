<?php
    include_once("./include/db/configure.php");
    include_once("./include/db/db_func.php");
    include_once("./include/commonFunction.php");
    $db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);

    if(isset($_POST['stars'])) {
        $stars = $_POST['stars'];
        $PostIndex = $_POST['PostIndex'];
        $id = $_POST['ID'];
        //$userIndexSql = "SELECT * FROM tsc_account WHERE tsc_account.UserIndex = '$id'";
        //$rs = querydb($userIndexSql, $db_conn);
        $UserIndex = $id;//$res[0]['UserIndex'];
        
        $checkSql = "SELECT * FROM tsc_rating WHERE PostIndex = '$PostIndex' AND UserIndex = '$UserIndex'";
        $rs = querydb($checkSql, $db_conn);
        
        if(count($rs) > 0) {
            $sql = "UPDATE tsc_rating SET Stars = '$stars' WHERE PostIndex = '$PostIndex' AND UserIndex = '$UserIndex'";
        }
        else {
            $sql = "INSERT INTO tsc_rating VALUES ('$PostIndex', '$UserIndex', '$stars')";
        }
        $ret = updatedb($sql, $db_conn);
        
        $updateCurrentPostRating
         = "UPDATE tsc_post
            SET tsc_post.Stars 
                = (SELECT AVG(Stars) FROM tsc_rating WHERE tsc_rating.PostIndex = '$PostIndex')
            WHERE tsc_post.PostIndex = '$PostIndex'";
        //echo "<meta http-equiv=REFRESH CONTENT=1;url=view_article.php?PostIndex=$PostIndex>";
        $ret_updateCurrentPostRating = querydb($updateCurrentPostRating, $db_conn);
        $arr = [
            'sql1' => $sql,
            'sql2' => $$updateCurrentPostRating,
            'rating' => getRatingOfStar($PostIndex),
            'people' => getPeopleNumber($PostIndex)
        ];
        echo json_encode($arr);
        //echo getRatingOfStar($PostIndex);
    }
    function getRatingOfStar($PostIndex) {

        global $db_conn;
        $sql = "SELECT ROUND(AVG(tsc_rating.Stars), 1) FROM tsc_rating WHERE tsc_rating.PostIndex = '$PostIndex' GROUP BY (tsc_rating.PostIndex)";
        $rs = querydb($sql, $db_conn);
        return $rs[0][0];
    }
    function getPeopleNumber($PostIndex) {
        global $db_conn;
        $sql5 = "SELECT COUNT(RC.UserIndex) FROM tsc_rating AS RC WHERE RC.PostIndex = '$PostIndex'";
        $end = querydb($sql5, $db_conn);
        return $end[0][0];
    }
?>

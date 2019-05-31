<?php
    session_start();
    if (isset($_SESSION["uid"]) && !empty($_SESSION["uid"])) {
        $uid = $_SESSION["uid"];
    }
    if (isset($_SESSION["email"]) && !empty($_SESSION["email"])) {
        $email = $_SESSION["email"];
    }

    include("./include/db/configure.php");
    include("./include/db/db_func.php");
    include("./include/commonFunction.php");
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body>
        
    </body>
</html>
<?php    
    $db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);

    $sqlcmd = "SELECT * FROM namelist ORDER BY cid";
    $StdInfo = querydb($sqlcmd, $db_conn);

    //if(!empty($_SESSION['admin'])) include("head_admin.inc.php");
    $title = getData($_POST["title"]);
    echo $title."<br>";
    $content = getData($_POST["content"]);
    echo $content."<br>";
    $butt = getData($_POST["ensure"]);
    $stars = getData($_POST["stars"]);
    echo $stars."<br>";
    $cat = getData($_POST["category"]);
    echo $cat."<br>";
    //$id = $uid;//$id = $_SESSION["uid"];
    //echo $id."<br>";
    echo $email."<br>";
    $getcode = getData($_POST["code"]);
    echo $getcode."<br>";
    $username = NULL;
    
    $sqlcmd_getusername = "SELECT * FROM tsc_account WHERE Email = '$email'";
    $getusername = querydb($sqlcmd_getusername, $db_conn);
    if(count($getusername) > 0){
        $username = $getusername[0]['Username'];
        $id = $getusername[0]['UserIndex'];
        //print_r($getusername);
    }
    echo $id."<br>";
    
    date_default_timezone_set('Asia/Taipei');
    $date = date("Y-m-d H:i:s");
    //$sql_insert = "INSERT INTO tsc_code (UserIndex, CodeContent, Permission) VALUES ('$id', '$getcode', '$valid')";
    //$result = updatedb($sql_insert, $db_conn);
    $permission = '';
    if($cat == "private") {
        $permission = 'N';
    }else if($cat == "public"){
        $permission = 'Y';
    }
    /*$data = [
        'UserIndex' => $id,
        'CodeContent' => $getcode,
        'Permission' => $permission,
    ];*/
    $sql = "INSERT INTO tsc_code (UserIndex, CodeContent, Permission) VALUES ('$id', '$getcode', '$permission')";
    $result_sql = updatedb($sql, $db_conn);
    if($result) {
        echo "*";
        $codeIndexSql = "SELECT CodeIndex FROM tsc_code WHERE tsc_code.CodeContent = '$getcode'";
        $rs_code = querydb($codeIndexSql, $db_conn);
        $res_code = $rs_code->setFetchMode(PDO::FETCH_ASSOC);//mysqli_fetch_array($rs_code);
        $codeid = $res_code[0];
        if(mysqli_query($conn, "INSERT INTO tsc_post (UserIndex, CodeIndex, Time, Title, PostContent, Category, Stars, Valid) VALUES ('$id', '$codeid', '$date', '$title', '$content', '$cat', '$stars', '$valid')")) {
            $postIndexSql = "SELECT PostIndex FROM tsc_post WHERE tsc_post.Time = '$date'";
            //$rs = mysqli_query($conn, $postIndexSql);
            //$res = mysqli_fetch_array($rs);
            $rs = querydb($postIndexSql, $db_conn);
            $res = $rs->setFetchMode(PDO::FETCH_ASSOC);

            $userIndexSql = "SELECT tsc_account.Userindex FROM tsc_account WHERE tsc_account.Username = '$username'";
            //$rt = mysqli_query($conn, $userIndexSql);
            //$ret = mysqli_fetch_array($rt);
            $rt = querydb($userIndexSql, $db_conn);
            $ret = $rt->setFetchMode(PDO::FETCH_ASSOC);
            $idx  = $ret[0];

            $sql = "INSERT INTO tsc_rating VALUES ('$res[0]', '$idx', '$stars')";
            //mysqli_query($conn, $sql);
            querydb($sql, $db_conn);
            
            //跳轉
            echo "<meta http-equiv=REFRESH CONTENT=1;url=index_new.php#C#default>";
        }
        else {
            echo "Faild!";
            exit();
        }
    }
?>
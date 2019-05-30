<?php
session_start();
if (isset($_SESSION["uid"]) && !empty($_SESSION["uid"])) {
    $uid = $_SESSION["uid"];   
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
    include("./include/db/configure.php");
    include("./include/db/db_func.php");
    if(!empty($_SESSION['admin'])) include("head_admin.inc.php");
    $title = $_POST["title"];
    $content = mysqli_real_escape_string($conn, $_POST["content"]);
    $butt = $_POST["ensure"];
    $stars = $_POST["stars"];
    $cat = $_POST["category"];
    $id = $_SESSION["uid"];
    $getcode = mysqli_real_escape_string($conn, $_POST["code"]);
    $username = NULL;
    
    try {
        $conn = new PDO("mysql:host=$db_server;dbname=beta;charset=utf8", $db_user, $db_passwd);
        $stmt = $conn->prepare("SELECT * FROM user WHERE ID = '$id' "); 
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
        $result = $stmt->fetchAll();
        foreach($result as $k => $v){
            $username = $v['Username'];
        }
    }
    catch(PDOException $e){
    }
    $conn = mysqli_connect($db_server,$db_user,$db_passwd,$db_name);
    mysqli_query($conn,"SET NAMES 'UTF8'");
    date_default_timezone_set('Asia/Taipei');
    $date = date("Y-m-d H:i:s");
    
    if(mysqli_query($conn, "INSERT INTO tsc_code (CodeIndex, UserIndex, CodeContent, Permission) VALUES ('', '$id', '$getcode', '$valid')")) {
        $codeIndexSql = "SELECT CodeIndex FROM tsc_code WHERE tsc_code.CodeContent = '$getcode'";
        $rs_code = mysqli_query($conn, $codeIndexSql);
        $res_code = mysqli_fetch_array($rs_code);
        $codeid = $res_code[0];
        if(mysqli_query($conn, "INSERT INTO tsc_post (PostIndex, UserIndex, CodeIndex, Time, Title, PostContent, Category, Stars, Valid) VALUES ('', '$id', '$codeid', '$date', '$title', '$content', '$cat', '$stars', '$valid')")) {
            $postIndexSql = "SELECT PostIndex FROM tsc_post WHERE tsc_post.Time = '$date'";
            $rs = mysqli_query($conn, $postIndexSql);
            $res = mysqli_fetch_array($rs);

            $userIndexSql = "SELECT tsc_account.Userindex FROM tsc_account WHERE tsc_account.Username = '$username'";
            $rt = mysqli_query($conn, $userIndexSql);
            $ret = mysqli_fetch_array($rt);
            $idx  = $ret[0];

            $sql = "INSERT INTO tsc_rating VALUES ('$res[0]', '$idx', '$stars')";
            mysqli_query($conn, $sql);
            
            //跳轉
            echo "<meta http-equiv=REFRESH CONTENT=1;url=index_new.php#C#default>";
        }
        else {
            echo "Faild!";
            exit();
        }
    }
?>
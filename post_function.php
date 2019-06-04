<?php 
   /*
    * Input:
    *     Permission: 0( public ), 1( private )
    *     programlanguage: 0( c ), 1( cpp )
    *
    */

    session_start();
    if (isset($_SESSION["uid"]) && !empty($_SESSION["uid"])) {
        $uid = $_SESSION["uid"];
    }
    //echo $uid;
    if (isset($_SESSION["email"]) && !empty($_SESSION["email"])) {
        $email = $_SESSION["email"];
    }
    //echo $email;
    include_once("./include/db/configure.php");
    include_once("./include/db/db_func.php");
    include_once("./include/commonFunction.php");
    //include("./include/head_line.inc.php");
?>
<?php    
    $db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);

    //if(!empty($_SESSION['admin'])) include("head_admin.inc.php");
    $title = getData($_POST["title"]);
    $content = getData($_POST["content"]);
    $butt = getData($_POST["ensure"]);
    $stars = getData($_POST["stars"]);
    $cat = getData($_POST["category"]);
    $getcode = getData($_POST["code"]);
    $lang = getData($_POST["lang"]);
    $username = NULL;
 
    $sqlcmd_getusername = "SELECT * FROM tsc_account WHERE Email = '$email'";
    $getusername = querydb($sqlcmd_getusername, $db_conn);
    if(count($getusername) > 0){
        $username = $getusername[0]['Username'];
        $id = $getusername[0]['UserIndex'];
        //print_r($getusername);
    }

    date_default_timezone_set('Asia/Taipei');
    $date = date("Y-m-d H:i:s");
    
    $permission = '';
    if($cat == "private") {
        $permission = '1';
    }else if($cat == "public"){
        $permission = '0';
    }
    
    $programlanguage = '';
    if($lang == "c") {
        $programlanguage = '0';
    }else if($lang == "cpp"){
        $programlanguage = '1';
    }

    echo "Title : ".$title."<br>";
    echo "Content : ".$content."<br>";
    echo "Stars : ".$stars."<br>";
    echo "Category : ".$cat."<br>";
    echo "Email : ".$email."<br>";
    echo "Code : ".$getcode."<br>";
    echo "Lang : ".$lang."<br>";
    echo "UserIndex : ".$id."<br>";
    echo "Program Language : ".$programlanguage."<br>";
    echo "Date : ".$date."<br>";
    echo "Permission : ".$permission."<br>";

    $new_getcode = str_replace("'", "......",$getcode);
    echo "new_getcode : ".$new_getcode."<br>";
    $sql = "INSERT INTO tsc_code (UserIndex, CodeContent, Date, Permission) VALUES ('$uid', '$new_getcode', '$date' ,'$permission')";
    $result_sql = updatedb($sql, $db_conn);
    echo $sql;
    if($result_sql == TRUE) {
        //echo "*";
        $codeIndexSql = "SELECT * FROM tsc_code WHERE CodeContent = '$new_getcode' AND Date = '$date'";
        $rs_code = querydb($codeIndexSql, $db_conn);
        $codeid = $rs_code[0]['CodeIndex'];
        //echo "CodeIndex : ".$codeid."<br>";
        
        $sql_insertpost = "INSERT INTO tsc_post (UserIndex, CodeIndex, Date, Title, PostContent, Category, Stars, Permission, Valid) VALUES ('$uid', '$codeid', '$date', '$title', '$content', '$programlanguage', '$stars', '$permission', '0')";
        $result_insertpost = updatedb($sql_insertpost, $db_conn);
        
        if($result_insertpost == TRUE) {
            $postIndexSql = "SELECT * FROM tsc_post WHERE Date = '$date'";
            $rs = querydb($postIndexSql, $db_conn);
            $res_Postindex = $rs[0]['PostIndex'];
            
            $userIndexSql = "SELECT * FROM tsc_account WHERE Email = '$email'";
            $rt = querydb($userIndexSql, $db_conn);
            $res_Userindex  = $rt[0]['UserIndex'];
            
            //echo "\nPostIndex : ".$res_Postindex."<br>";
            //echo "\nUserindex : ".$res_Userindex."<br>";
            
            $sql_insertRating = "INSERT INTO tsc_rating (PostIndex, UserIndex, Stars) VALUES ('$res_Postindex', '$res_Userindex', '$stars')";
            $res_insertRating = updatedb($sql_insertRating, $db_conn);
            
            if($res_insertRating == TRUE) {
                echo "<img src = '../ThinkSync/homepage_pic/addSuccess_en.png' width='90%' style='display:block; margin:auto;'>";
                //跳轉
                echo "<meta http-equiv=REFRESH CONTENT=1;url=index_new.php#C#default>";
            } else {
                echo "****   Insert into rating Faild!   ****";
                exit();
            }
            
        } else {
            echo "****   Insert into post Faild!   ****";
            exit();
        }
    } else {
        echo "****   Insert into code Faild!   ****";
        exit();
    }
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body>
    </body>
</html>
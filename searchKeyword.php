<?php 
    session_start();
    include_once("./include/head_line.inc.php");
    include_once("./include/db/configure.php");
    include_once("./include/db/db_func.php");
    include_once("./include/commonFunction.php");
    $db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);

    if(!empty($_SESSION["uid"])) $user_id = $_SESSION["uid"];
    if (!$db_conn) {
      die("Error connecting to database: " . mysqli_connect_error($conn));
      exit();
    }
    $sql = "";
    if(isset($_POST['keyword'])) {
        $keyword = $_POST['keyword'];
        $sql = "SELECT * FROM tsc_post WHERE tsc_post.Title LIKE '%".$keyword."%' ORDER BY tsc_post.Date DESC, Stars DESC";
        $ret = querydb($sql, $db_conn);
        //return $ret[0];
    }
    else{
        $sql = "SELECT * FROM tsc_post ORDER BY tsc_post.Date DESC, Stars DESC";
        $ret = querydb($sql, $db_conn);
        //return $ret[0];
    }
    //print_r($ret);
    //echo $sql;
?>
<head>
    <style>
        body {
            height: 100%;
            font-family: "Inconsolata", sans-serif;
            color: black;
            background: "#rgb(207, 223, 226)";
        }

        table {
                height: 10%;
                left: 50%;
                position: static;
                width: 880px;
                border-top: 3px #333333 solid;
                border-bottom: 3px #333333 solid;
                border-collapse: collapse;
            }
            thead th {
                background: #555555;
                width: 880px;
                color: #FFF;
                font-family: 'Lato', font-family:DFKai-sb;
                font-size: 16px;
                text-align: left;
                font-weight: 100;
                letter-spacing: 2px;
                text-transform: uppercase;
            }
            tr {
                color: #333333;
                background: #fff; /*#e1eaf4*/
                /*border-collapse: collapse;*/
                width: 880px;
                margin-bottom: 5px;
                
            }
            th,
            td {
                font-family: 'Lato', serif;
                font-style: style="font-family:DFKai-sb";
                font-weight: 400;
                width: 880px;
                padding: 20px;
                text-align: center;
                color:#333333;
                border-bottom: 1px solid #ddd;
            }
    </style>
</head>
<body>  
    <div style="margin-top:10%;margin-left:20%;">
        <table>
            <tr>
                <th style="background-color:#EEE;"><h5>Article link</h5></th>
                <th style="background-color:#EEE;"><h5>Category</h5></th>
                <th style="background-color:#EEE;"><h5>★ Difficulty</h5></th>
            </tr>
            <?php  foreach ($ret as $k => $v) { ?>
                <tr>
                    <?php $var = $v['Title']; ?>
                    <td><?php echo '<a href=view_article.php?PostIndex='.$v['PostIndex'].' target="_blank style="text-decoration:none;">'.$var.'</a>'; ?> </td>
                    <td>
                        <?php
                            if($v['Category'] == '0') {
                                echo 'C'; 
                            }else if($v['Category'] == '1') {
                                echo 'C++';
                            }
                        ?>
                    </td>
                    <td> <?php echo ROUND($v['Stars'], 1); ?> </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
<?php
    require_once "../db/configure.php";
    require_once "../db/db_func.php";
    require_once "../commonFunction.php";

    checkLogin();

    // fetch session data
    if (isset($_SESSION["uid"]) && !empty($_SESSION["uid"])) {
        $suid = getData($_SESSION["uid"]);
    }
    if (isset($_SESSION["email"]) && !empty($_SESSION["email"])) {
        $semail = getData($_SESSION["email"]);
    }
    if (isset($_SESSION["mode"]) && !empty($_SESSION["mode"])) {
        $smode = getData($_SESSION["mode"]);
    }

    // fetch permission
    if (isset($_GET["permission"]) && !empty($_GET["permission"])) {
        $permission = getData($_GET["permission"]);
    }

    $db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);
    $sqlcmd = "SELECT * FROM tsc_post
               WHERE UserIndex = '$suid' AND Valid = '0' AND Permission = '$permission'";
    $rs = querydb($sqlcmd, $db_conn);
 ?>

<html>
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
                    width: 100%;
                    border-top: 3px #333333 solid;
                    border-bottom: 3px #333333 solid;
                    border-collapse: collapse;
                }
                thead th {
                    background: #555555;
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
                    margin-bottom: 5px;

                }
                th,
                td {
                    font-family: 'Lato', serif;
                    font-style: style="font-family:DFKai-sb";
                    font-weight: 400;
                    padding: 20px;
                    text-align: center;
                    color:#333333;
                    border-bottom: 1px solid #ddd;
                }
        </style>
    </head>

    <body>
        <table>
            <tr>
                <th style="background-color:#EEE;"><h5>Article</h5></th>
                <th style="background-color:#EEE;"><h5>Category</h5></th>
                <th style="background-color:#EEE;"><h5>★ Difficulty</h5></th>
            </tr>
            <?php
                foreach ($rs as $trash => $value) {
             ?>
                <tr>
                    <td>
                        <a href=../../view_article.php?PostIndex='<?php echo $value["PostIndex"]; ?>' target="_blank" style="text-decoration:none;">
                            <?php echo $value["Title"]; ?>
                        </a>
                    </td>
                    <td>
                        <?php
                            if($value["Category"] == '0') {
                                echo 'C';
                            }else if($value["Category"] == '1') {
                                echo 'C++';
                            }
                        ?>
                    </td>
                    <td>
                        <?php echo ROUND($value["Stars"], 1); ?>
                    </td>
                </tr>
            <?php
                }
             ?>
        </table>
    </body>
</head>

<?php
    session_start();
    include_once('./include/db/configure.php');
    include_once("./include/db/db_func.php");
    include_once("./include/commonFunction.php");
    //if(!empty($_SESSION['admin'])) include("head_admin.inc.php");
    //echo $_SESSION['uid'];
    //exit();
    $db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);
?>
<html>
    <head>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style>
            body, html {
                height: 100%;
                font-family: "Inconsolata", sans-serif;
                color : black;
                background: "#rgb(207, 223, 226)";
            }
            .bgimg {
                background-position: center;
                background-size: cover;
                min-height: 75%;
            }
            .menu {
                display: none;
            }
            .w3-top{
                font-family: "Inconsolata", sans-serif;
                color : white;
                background: "#rgb(101, 152, 146)";
            }
            .log_form {
                font-family: "Inconsolata", sans-serif;
                color : black;
                background: "#rgb(101, 152, 146)";
                position:absolute;
                top:80px;
                left:100px;
            }
        </style>
    </head>
    <body>
        <div class="w3-top" style="z-index:100">
          <div class="w3-row w3-padding w3-black">

            <div class="w3-col s1">
              <a href="../ThinkSync/home.php" class="w3-button w3-block w3-black scroll">HOME</a>
            </div>
            <!--div class="w3-col s1">
              <a href="home.php#about" class="w3-button w3-block w3-black scroll">ABOUT</a>
            </div>
            <div class="w3-col s1">
              <a href="home.php#where" class="w3-button w3-block w3-black scroll">WHERE</a>
            </div>
            <div class="w3-col s1">
              <a href="home.php#contact" class="w3-button w3-block w3-black scroll">CONTACT</a>
            </div-->
            <div class="w3-col s1">
                <a href="../ThinkSync/index_new.php#C#default" class="w3-button w3-block w3-black scroll">START</a>
            </div>
            <!--div class="w3-col s1">
                <a href="prizeTest.php" class="w3-button w3-block scroll">LOTTERY</a>
            </div-->
            <?php if(empty($_SESSION['uid'])) {?>
                <div id = "pic" class="w3-right w3-hide-small">
                    <a href="../ThinkSync/login.php" class="w3-bar-item w3-button">SIGNIN</a>
                    <a href="../ThinkSync/register.php" class="w3-bar-item w3-button">SIGNUP</a>
                </div>
            <?php }?>
            <?php if(!empty($_SESSION['uid'])) { ?>
                <div id = "pic" class="w3-right w3-hide-small">
                   <?php
                        //$ID = $_SESSION['uid'];
                        $email = $_SESSION['email'];
                        $sql = "SELECT * FROM tsc_account WHERE Email = '$email' AND Valid = '0'";
                        $result = querydb($sql, $db_conn);
                        $pic = $result[0]['Picture'];
                    ?>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($pic);?>" width="30" height="30"/>
                    <?php
                        echo "<font class='w3-bar-item' style='position:center;padding:8px 16px;vertical-align: middle;' align='center' valign='center' face='Inconsolata' size='3'>Hi! ".$result[0]['Username']."!&nbsp;&nbsp;</font>";

                    ?>
                  <a href="../ThinkSync/logout.php" class="w3-bar-item w3-button">LOGOUT</a>
                  <!--a href="../ThinkSync/post.php" class="w3-bar-item w3-button">POST</a-->
                  <a href="../ThinkSync/account_center.php" class="w3-bar-item w3-button">USER CENTER</a>
                </div>
            <?php }?>
          </div>
        </div>
    </body>
</html>

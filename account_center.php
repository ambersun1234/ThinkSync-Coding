<?php
    session_start();

    require_once "./include/db/configure.php";
    require_once "./include/db/db_func.php";
    require_once "./include/oauth/goauthData.php";
    require_once "./include/commonFunction.php";

    // head line
    require_once "./include/head_line.inc.php";

    checkLogin();

    // fetch session data
    $_email = getData($_SESSION["email"]);
    $_uid = getData($_SESSION["uid"]);
    $_token = getData($_SESSION["token"]);
    $_mode = getData($_SESSION["mode"]);

    // query user's basic data
    $db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);
    $sqlcmd = "SELECT * FROM tsc_account
               WHERE Email = '$_email' AND UserIndex = '$_uid'
               AND Mode = '$_mode' AND Valid = '0'";
    $rs = querydb($sqlcmd, $db_conn);
    if (count($rs) == 1) {
        $email = $rs[0]["Email"];
        $uid = $rs[0]["UserIndex"];
        $mode = $rs[0]["Mode"];
        $image = $rs[0]["Picture"];
        $username = $rs[0]["Username"];
        $password = $rs[0]["Password"];
    }

    // query user's all public post
    // tsc_post => Permission( 0 => public, 1 => private)
    $sqlcmd = "SELECT count(*) as public FROM tsc_post
               WHERE UserIndex = '$uid' AND Permission = '0'
               AND Valid = '0'";
    $rs = querydb($sqlcmd, $db_conn);
    $publicPostCount = $rs[0]["public"];

    // query user's all private post
    // tsc_post => Permission( 0 => public, 1 => private)
    $sqlcmd = "SELECT count(*) as private FROM tsc_post
               WHERE UserIndex = '$uid' AND Permission = '1'
               AND Valid = '0'";
    $rs = querydb($sqlcmd, $db_conn);
    $privatePostCount = $rs[0]["private"];
 ?>

<html>
    <head>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <title>Account Center</title>
        <style>
            input[type=text], input[type=password]{
                margin: 10px 0px;
                padding: 5px;
                width: 100%;
            }
            hr {
                border-color: #bababa;
                border-width: 2px;
            }
            .jump {
                color: #0366d6;
            }
            .attention {
                color: #24292e;
                font-weight: 600;
            }
            button {
                padding: 5px;
            }
        </style>

        <script type="text/javascript">
            $(document).ready(function() {
                $(".ps").on("click", function() {
                    var location = $(this).text();
                    var current = $("iframe").attr("src");

                    // remove parent
                    current = current.replace("./include/account/", "");
                    current = current.replace(".php", "");
                    // capitalize
                    current = current.charAt(0).toUpperCase() + current.slice(1);

                    // remove attention css to previous
                    $(".attention:contains('" + current + "')").removeClass("attention");
                    $(".ps:contains('" + current + "')").addClass("jump");

                    // add attention to next
                    $(".jump:contains('" + location + "')").removeClass("jump");
                    $(".ps:contains('" + location + "')").addClass("attention");

                    // redirect iframe
                    $("iframe").attr("src", "./include/account/" + location.toLowerCase() + ".php");
                });
            });
        </script>
    </head>

    <body>
        <br><br><br><br>
        <div class="w3-row">
            <!-- empty column -->
            <div class="w3-col m1 w3-container">
            </div>

            <div class="w3-col m3 w3-center">
                <h2>Profile Picture</h2>
                <img src="data:image/jpeg;base64,<?php echo base64_encode($image);?>" width="150" height="150"/>
                <br><br>
                <form method="post" action="#" enctype="multipart/form-data">
                    <input type="file" name="image" value="">
                </form>
            </div>

            <div class="w3-col m4">
                <iframe src="./include/account/profile.php" frameborder="0" scrolling="no" height="100%" width="100%"></iframe>
            </div>

            <div class="w3-col m2" style="margin: 0px 20px;">
                <div class="w3-bar-block">
                    <span class="w3-bar-item w3-light-gray">Personal Settings</span>
                    <button class="w3-bar-item w3-button ps jump attention">Profile</button>
                    <button class="w3-bar-item w3-button ps jump">Account</button>
                    <button class="w3-bar-item w3-button ps jump">Password</button>
                </div>
            </div>
        </div>
    </body>
</html>

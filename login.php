<?php
    session_start();
    include("head_line.inc.php");
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<html>
    <head>
        <style>
            body {
                /*background-image: url(pic/sketch-1474715249780.png);*/
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-position: center;
                background-size: cover;
            }
            input {
                margin: 10px;
            }
            .mylogin {
                width: 60%;
                text-align: center;
                margin: 0 auto;
                background-color: #cccccc;
            }
        </style>

        <!-- google oauth 2.0 API -->
        <meta name="google-signin-client_id" content="667132850870-99fts3leulmub66qp55otlarpe9cdnei.apps.googleusercontent.com">
        <script src="./include/oauth/oauthScript.js"></script>
        <script src="https://apis.google.com/js/platform.js?hl=en"></script>
    </head>
    <body>
        <div class="mylogin">
            <form class="log_form" name="form" method="post" action="connect.php">
                Username：<input type="text" name="id" /><br>
                Password：<input type="password" name="pw" /><br><br>
                <input type="submit" value="Sing in" name="button" style="width:80px;height:30px;border:2px blue none;color:#fff;background: #000;text-align: center;"  onclick="return CheckFunc();">
                <br>
                <a href="register.php">New to ThinkSync? Click me to create new account.</a><br><br><br>

                <div class="g-signin2" style="margin: 0 auto;" data-onsuccess="googleOnSignIn"></div>
                <a href="#" onclick="googleSignOut();">Sign out</a>
            </form>
        </div>
         <script>
            function CheckFunc() {
                msg = "";
                if(document.forms[0].id.value == "") msg = "Please enter your Username";
                else if(document.forms[0].pw.value == "") msg = "Please enter your password";
                else return true;
                alert(msg);
                return false;
            }
        </script>
    </body>
</html>

<?php
    session_start();
    require_once "./include/commonFunction.php";
    require_once "./include/oauth/goauthData.php";
    include("./include/head_line.inc.php");
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<html>
    <head>
        <style>
            body {
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-position: center;
                background-size: cover;
            }
            .bg-image {
              /* The image used */
              background-image: url(./homepage_pic/link_6.png);
              -webkit-filter:grayscale(1);
              filter: blur(8px);
              -webkit-filter:saturate(0.5);
              -webkit-filter: blur(4px);
              -webkit-filter:opacity(.3);
              -webkit-filter:brightness(.6);

              /* Full height */
              height: 100%; 

              /* Center and scale the image nicely */
              background-position: center;
              background-repeat: no-repeat;
              background-size: cover;
            }
            input {
                margin: 10px;
            }
            .mylogin {
                
                text-align: center;
                margin: 0 auto;
                background-color: #cccccc;
            }
            a{
                text-decoration: none;
            }
            .log_form{
                border: 15px solid rgb(85, 85, 85);
                border: 15px solid rgba(123, 123, 123, 0.5);
                -webkit-background-clip: padding-box; /* for Safari */
                background-clip: padding-box; /* for IE9+, Firefox 4+, Opera, Chrome */
                background: #ffffff;
                text-align: center;
                width:450px;
                position:absolute;
                top:40%;
                left:40%;
                margin: -80px 0 0 -80px;
                vertical-align: middle;
            }
        </style>

        <!-- google oauth 2.0 API -->
        <meta name="google-signin-client_id" content="<?php echo $goauthClientId; ?>">
        <script src="./include/oauth/oauthScript.js"></script>
        <script src="https://apis.google.com/js/platform.js?hl=en"></script>
    </head>
    <body>
        <div class="bg-image"></div>
        <div class="mylogin" style="text-align: center;margin: 0 auto;">
            <form class="log_form" name="form" method="post" action="./login_finish.php"><br>
                Email: &nbsp;&nbsp;&nbsp;<input type="text" name="email" /><br>
                Password: <input type="password" name="pwd" /><br><br><br>
                <a href="register.php">New to ThinkSync? Click me to create new account.</a><br><br>
                <input type="submit" value="Sing in" name="button" style="width:100px;height:35px;border:2px blue none;color:#fff;background: #000; margin-left: 60%;"  onclick="return CheckFunc();"><div class="g-signin2" style="margin: 0 auto; margin-left:30%;margin-top:-45px;" data-onsuccess="googleOnSignIn"></div>
                <input type="hidden" value="normal" name="mode"><br>
            </form>
        </div>
         <script>
            function CheckFunc() {
                msg = "";
                if(document.forms[0].email.value == "") msg = "Please enter your Email";
                else if(document.forms[0].pw.value == "") msg = "Please enter your password";
                else return true;
                alert(msg);
                return false;
            }
        </script>
        
    </body>
</html>

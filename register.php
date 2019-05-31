<?php
    session_start();
    require_once "./include/commonFunction.php";
    include ("./include/head_line.inc.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<html>
    <head>
        <!-- google oauth 2.0 API -->
        <meta name="google-signin-client_id" content="667132850870-99fts3leulmub66qp55otlarpe9cdnei.apps.googleusercontent.com">
        <script src="./include/oauth/oauthScript.js"></script>
        <script src="https://apis.google.com/js/platform.js?hl=en"></script>
        <style>
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
                border-radius:10px;
                margin: -80px 0 0 -80px;
                vertical-align: middle;
            }
        </style>
    </head>

    <body>
        <div class="bg-image"></div>
        <form class="log_form" name="form" method="post" action="register_finish.php">
            <br>
            Username：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="text" name="username" onblur="validateUsername()" />
            <span id="usernameValidate"></span>
            <br><br>

            Email:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="text" name="email" onblur="validateEmail()"/>
            <span id="emailValidate"></span>
            <br><br>

            Password：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="password" id='pw' name="pw"/>
            <input type="hidden" name="mode" value="normal">
            <br><br>

            Confirm password：
            <input type="password" id='pw2' name="pw2" onblur="validatePwd()"/>
            <span id="pwdValidate"></span>
            <br><br><br>
            
            <div class="g-signin2" style="margin: 0 auto; margin-left:30%;" data-onsuccess="googleOnSignUp"></div>
            <input id='submit' name="button" type="submit" disabled value="Register" style="width:120px;height:35px;border:2px blue none;color:#fff;background: #000;position:absolute;right:20px;margin-top:-35px">
            <br>
        </form>

        <script>
            var vp = false, vu = false, ve = false;
            function validatePwd() {
                var pw1 = document.getElementById("pw").value;
                var pw2 = document.getElementById("pw2").value;
                if(pw1 == pw2) {
                    vp = true;
                    document.getElementById("submit").disabled = vp & ve & vu;
                    document.getElementById("pwdValidate").innerHTML = ""; // clear error
                }
                else {
                    vp = false;
                    document.getElementById("submit").disabled = vp & ve & vu;
                    document.getElementById("pwdValidate").innerHTML = "<font color='red'>Invalid password.</font>";
                }
            }

            function validateUsername() {
                var username = document.querySelector("input[name=username]").value;
                if (username.length > 20) {
                    vu = false;
                    document.getElementById("submit").disabled = vp & ve & vu;
                    document.getElementById("usernameValidate").innerHTML = "<font color='red'>Username must be less than 20 characters.</font>"; // clear error
                }
                else {
                    $.post("./register_username.php", {"username": username}, function(data) {
                        if (data.code != 0) {
                            vu = true;
                            document.getElementById("submit").disabled = vp & ve & vu;
                            document.getElementById("usernameValidate").innerHTML = "<font color='red'>Username had been registerd.</font>"; // clear error
                        }
                        else {
                            vu = true;
                            document.getElementById("submit").disabled = vp & ve & vu;
                            document.getElementById("usernameValidate").innerHTML = ""; // clear error
                        }
                    }, "json");
                }
            }

            function validateEmail() {
                var email = document.querySelector("input[name=email]").value;
                var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                if (!re.test(String(email).toLowerCase())) {
                    ve = false;
                    document.getElementById("submit").disabled = vp & ve & vu;
                    document.getElementById("emailValidate").innerHTML = "<font color='red'>Invalid email format.</font>";
                }
                else {
                    $.post("./register_email.php", {"email": email}, function(data) {
                        if (data.code != 0) {
                            ve = false;
                            document.getElementById("submit").disabled = vp & ve & vu;
                            document.getElementById("emailValidate").innerHTML = "<font color='red'>Email had been registered.</font>";
                        }
                        else {
                            ve = true;
                            document.getElementById("submit").disabled = vp & ve & vu;
                            document.getElementById("emailValidate").innerHTML = ""; // clear error
                        }
                    }, "json");
                }
            }

            function signUp() {
                var signUpData = {
                    "username": document.querySelector("input[name=username]").value,
                    "email": document.querySelector("input[name=email]").value,
                    "pw": document.querySelector("input[name=pw]").value,
                    "pw2": document.querySelector("input[name=pw2]").value,
                    "mode": "normal"
                };

                $.post(
                    "./register_finish.php",
                    signUpData, function(data) {
                        if (data.code == 0) {
                            window.location = "./home.php";
                        }
                    }, "json");
            }
      </script>
    </body>
</html>

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

        <!-- jquery cdn -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    </head>

    <body>
        <form class="log_form" name="form" method="post" action="register_finish.php">
            Username：
            <input type="text" name="username" onblur="validateUsername()" />
            <span id="usernameValidate"></span>
            <br><br>

            Email:
            <input type="text" name="email" onblur="validateEmail()"/>
            <span id="emailValidate"></span>
            <br><br>

            Password：
            <input type="password" id='pw' name="pw"/><br><br>

            <input type="hidden" name="mode" value="normal">

            Enter your password again：
            <input type="password" id='pw2' name="pw2" onblur="validatePwd()"/>
            <span id="pwdValidate"></span>
            <br><br>

            <div id="g-signin2" class="g-signin2" style="margin: 0 auto;" data-onsuccess="googleOnSignUp"></div>
            <input id='submit' name="button" type="submit" disabled value="Register" style="width:120px;height:40px;border:2px blue none;color:#fff;background: #000;position:absolute;right:10px; ">
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

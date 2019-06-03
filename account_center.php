<?php
    session_start();

    require_once "./include/db/configure.php";
    require_once "./include/db/db_func.php";
    require_once "./include/oauth/goauthData.php";
    require_once "./include/commonFunction.php";
    require_once "./include/check_email.php";
    require_once "./include/check_username.php";

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
            .warning {
                background-color: #ffdce0;
                padding: 27px;
                color: #86181d;
                font-size: 17px;
            }
            button {
                padding: 5px;
                margin: 10px;
            }
        </style>

        <script type="text/javascript">
            function checkUsername() {
                var username = document.querySelector("input[name=username]").value;
                var thisUsername = "<?php echo $username; ?>";

                $.post("./include/check_username.php", {"username": username}, function(data) {
                    if (data.code == 0) {
                        document.querySelector("div.usernameErrMsg").innerHTML = "";
                    }
                    else {
                        // user enter new username is the same as the original username
                        if (username != thisUsername) {
                            document.querySelector("div.usernameErrMsg").innerHTML = "<font color='red'>Invalid username, it has been registered.</font>";
                        }
                        else {
                            document.querySelector("div.usernameErrMsg").innerHTML = "";
                        }
                    }
                }, "json");
            }

            function checkEmail() {
                var email = document.querySelector("input[name=email]").value;
                var thisEmail = "<?php echo $email; ?>";

                $.post("./include/check_email.php", {"email": email}, function(data) {
                    if (data.code == 0) {
                        document.querySelector("div.emailErrMsg").innerHTML = "";
                    }
                    else {
                        if (email != thisEmail) {
                            document.querySelector("div.emailErrMsg").innerHTML = "<font color='red'>Invalid email address, it has been registered.</font>";
                        }
                        else {
                            document.querySelector("div.emailErrMsg").innerHTML = "";
                        }
                    }
                }, "json");
            }

            function checkPassword() {
                var pwd1 = document.querySelector("input[name=newPassword]").value;
                var pwd2 = document.querySelector("input[name=new2Password]").value;

                if (pwd1 == "" || pwd2 == "") {
                    document.querySelector("div.passwordErrMsg").innerHTML = "<font color='red'>Password cannot be empty.</font>";
                }
                else if (pwd1 != pwd2){
                    document.querySelector("div.passwordErrMsg").innerHTML = "<font color='red'>Password validation failed.</font>";
                }
            }
        </script>
    </head>

    <body>
        <br><br><br><br>
        <div class="w3-row">
            <div class="w3-col m4 w3-center">
                <img src="data:image/jpeg;base64,<?php echo base64_encode($image);?>" width="300" height="300"/>
                <br><br>
                <form method="post" action="#" enctype="multipart/form-data">
                    <input type="file" name="image" value="">
                </form>
            </div>

            <div class="w3-col m4">
                <h2>Profile</h2>
                <hr>
                Username: <br>
                <input type="text" name="username" value="<?php echo $username; ?>" onblur="checkUsername();"><br>
                <div class="usernameErrMsg"></div>
                Email: <br>
                <input type="text" name="email" value="<?php echo $email; ?>" onblur="checkEmail();"><br>
                <div class="emailErrMsg"></div><br>
                Total <strong>Public</strong> post number = <a href="#"><?php echo $publicPostCount; ?></a><br>
                Total <strong>Private</strong> post number = <a href="#"><?php echo $privatePostCount; ?></a>

                <?php
                    if ($_mode == "normal") {
                 ?>
                     <h2>Change Password</h2>
                     <hr>
                     Old password:<br>
                     <input type="password" name="oldPassword" value="" placeholder="Your old password"><br>
                     New password:<br>
                     <input type="password" name="newPassword" value="" placeholder="Your New password" onblur="checkPassword();"><br>
                     Confirm new password:<br>
                     <input type="password" name="new2Password" value="" placeholder="Enter your new password again" onblur="checkPassword();"><br>
                     <div class="passwordErrMsg"></div><br>
                     <button class="w3-btn w3-round-large w3-gray" name="updateBtn" value="">Update</button><br>
                <?php
                    }
                 ?>

                <!-- delete account -->
                <h2 style="color: red;">Delete your account</h2>
                <hr>
                Once you delete your account, there is no going back.<br><br>
                <div class="warning">
                    You will lose all your account, post and code, please think carefully before you delete your account.
                    <br><br>
                    Your username and email will be available to anyone on ThinkSync-Coding
                </div>
                <br>
                <strong>Your username:</strong><br>
                <input type="text" name="deleteUsername" value="" placeholder="Your username"><br>
                <strong>Your email:</strong><br>
                <input type="text" name="deleteEmail" value="" placeholder="Your email"><br>
                <strong>To verify, type</strong> delete my account <strong>below:</strong><br>
                <input type="text" name="deleteCheck" value="" placeholder="delete my account"><br>
                <strong>Confirm your password:</strong><br>
                <input type="password" name="deletePassword" value="" placeholder="Your account password"><br>
                <button class="w3-btn w3-round-large" name="deleteBtn" style="background-color: red; color: white; border-color: black; border-radius: 5px;">Delete your account</button>
            </div>
        </div>
    </body>
</html>

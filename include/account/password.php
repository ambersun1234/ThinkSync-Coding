<?php
    session_start();

    require_once "../db/configure.php";
    require_once "../db/db_func.php";
    require_once "../oauth/goauthData.php";
    require_once "../commonFunction.php";

    checkLogin();

    // fetch session data
    $_email = getData($_SESSION["email"]);
    $_uid = getData($_SESSION["uid"]);
    $_token = getData($_SESSION["token"]);
    $_mode = getData($_SESSION["mode"]);
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
             button {
                 padding: 5px;
             }
         </style>

         <script type="text/javascript">
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
         <h2>Change Password</h2>
         <hr>
         <?php
            if ($_mode == "normal") {
          ?>
                Old password:<br>
                <input type="password" name="oldPassword" value="" placeholder="Your old password"><br>
                New password:<br>
                <input type="password" name="newPassword" value="" placeholder="Your New password" onblur="checkPassword();"><br>
                Confirm new password:<br>
                <input type="password" name="new2Password" value="" placeholder="Enter your new password again" onblur="checkPassword();">
                <div class="passwordErrMsg"></div>
                <br>
                <button class="w3-btn w3-round-large w3-green" name="updatePwdBtn" value="">Update Password</button><br>
        <?php
            }
            else {
         ?>
                <h5>
                    Your are currently sign in via <strong>Google account</strong>.<br>
                    You cannot change your ThinkSync-Coding account password.<br><br>
                    Change your <strong>Google account password</strong> via <a style="color: #0366d6;" href="https://myaccount.google.com/" target="_blank">Google Account</a>.
                </h5>
        <?php
            }
         ?>
     </body>
</html>

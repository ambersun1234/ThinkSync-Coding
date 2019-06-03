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
             .warning {
                 background-color: #ffdce0;
                 padding: 27px;
                 color: #86181d;
                 font-size: 17px;
             }
             button {
                 padding: 5px;
             }
         </style>
     </head>

     <body>
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
     </body>
</html>

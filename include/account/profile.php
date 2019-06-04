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
             button {
                 padding: 5px;
             }
         </style>

         <script type="text/javascript">
             function checkUsername() {
                 var username = document.querySelector("input[name=username]").value;
                 var thisUsername = "<?php echo $username; ?>";

                 $.post("../check_username.php", {"username": username}, function(data) {
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

                 $.post("../check_email.php", {"email": email}, function(data) {
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

             function redirectIframe(premission) {
                 var current = $(parent.document).find("iframe").attr("src");
                 var locationName = premission.charAt(0).toUpperCase() + premission.slice(1) + " Posts";
                 var locationPath = "./include/account/posts.php";

                 // remove parent
                 current = current.replace("./include/account/", "");
                 current = current.replace("Posts", " Posts");
                 current = current.replace(".php", "");
                 // capitalize
                 current = current.charAt(0).toUpperCase() + current.slice(1);

                 // add jump class to previous
                 $(parent.document).find(".attention:contains('" + current + "')").removeClass("attention");
                 $(parent.document).find(".ps:contains('" + current + "')").addClass("jump");

                 // add attention to next
                 $(parent.document).find(".jump:contains('" + locationName + "')").removeClass("jump");
                 $(parent.document).find(".ps:contains('" + locationName + "')").addClass("attention");

                 // set parent iframe src url
                 $(parent.document).find("iframe").attr("src", locationPath);
             }
         </script>
     </head>

     <body>
         <h2>Profile</h2>
         <hr>
         Username: <br>
         <input type="text" name="username" value="<?php echo $username; ?>" onblur="checkUsername();"><br>
         <div class="usernameErrMsg"></div>
         Email: <br>
         <input type="text" name="email" value="<?php echo $email; ?>" onblur="checkEmail();"><br>
         <div class="emailErrMsg"></div><br>
         <button class="w3-btn w3-round-large w3-green" name="updateProfileBtn" value="">Update Profile</button><br>

         <h3>Public post</h3>
         <hr>
         Total <a style="color: #0366d6;" href="#" onclick="redirectIframe('Public');"><?php echo $publicPostCount; ?></a> post<?php echo $publicPostCount <= 1 ? "" : "s"; ?> found.<br>

         <h3>Private post</h3>
         <hr>
         Total <a style="color: #0366d6;" href="#" onclick="redirectIframe('Private');"><?php echo $privatePostCount; ?></a> post<?php echo $privatePostCount <= 1 ? "" : "s"; ?> found.<br>
     </body>
</html>
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
    update();

    function update() {
        $ve = $GLOBALS["_email"];
        $vu = $GLOBALS["_uid"];
        $vt = $GLOBALS["_token"];
        $vm = $GLOBALS["_mode"];

        $sqlcmd = "SELECT * FROM tsc_account
                   WHERE Email = '$ve' AND UserIndex = '$vu'
                   AND Mode = '$vm' AND Valid = '0'";
        $rs = querydb($sqlcmd, $GLOBALS["db_conn"]);
        if (count($rs) == 1) {
            $GLOBALS["email"] = $rs[0]["Email"];
            $GLOBALS["uid"] = $rs[0]["UserIndex"];
            $GLOBALS["mode"] = $rs[0]["Mode"];
            $GLOBALS["image"] = $rs[0]["Picture"];
            $GLOBALS["username"] = $rs[0]["Username"];
            $GLOBALS["password"] = $rs[0]["Password"];
        }
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
             .w3-modal {
                 background-color: transparent;
             }
         </style>

         <script type="text/javascript">
             var thisUsername = "<?php echo $username; ?>";
             var thisEmail = "<?php echo $email; ?>";

            function escapeHtml(text) {
                return text
                    .replace(/&/g, "&amp;")
                    .replace(/</g, "&lt;")
                    .replace(/>/g, "&gt;")
                    .replace(/"/g, "&quot;")
                    .replace(/'/g, "&#039;");
            }
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

                 locationPath = locationPath + "?premission=" + (premission == "Public" ? "0" : "1");

                 // remove parent
                 current = current.replace("./include/account/", "");
                 current = current.replace("Posts", " Posts");
                 current = current.replace(".php", "");
                 current = current.replace("?premission=0", "");
                 current = current.replace("?premission=1", "");
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

             function updateProfile() {
                 var username = document.querySelector("input[name=username]").value;
                 var email = document.querySelector("input[name=email]").value;

                 if (username == thisUsername && email == thisEmail) {
                     alert("Nothing to update");
                 }
                 else {
                     $.post("./updateProfile.php", {"username": username, "email": email}, function(data) {
                         if (data.code == 0) {
                             // modify head line username
                             parent.document.getElementById("headLineUsername").textContent = escapeHtml(username);
                             thisUsername = username;
                             thisEmail = email;
                             <?php update(); ?>
                             alert("Update profile successfully");
                         }
                         else {
                             alert(data.msg);
                             // document.getElementById("profileModal").style.display = "block";
                             // $(parent.document).css({"backgroundColor": "red"});
                         }
                     }, "json");
                 }
             }

             // window.onclick = function(event) {
             //     var modal = document.getElementById("profileModal");
             //     if (event.target = modal) {
             //         modal.style.display = "none";
             //         // document.body.style.background = "transparent";
             //         $(parent.document).css({"backgroundColor": "transparent"});
             //     }
             // }
         </script>
     </head>

     <body>
        <div id="profileModal" class="w3-modal">
            <div class="w3-modal-content w3-animate-top w3-card-4">
                <header class="w3-container w3-teal">
                    <h2>Update profile</h2>
                </header>
                <div class="w3-container">
                    <p></p>
                </div>
            </div>
        </div>

         <h2>Profile</h2>
         <hr>
         Username: <br>
         <input type="text" name="username" value="<?php echo $username; ?>" onblur="checkUsername();"><br>
         <div class="usernameErrMsg"></div>
         Email: <br>
         <input type="text" name="email" value="<?php echo $email; ?>"
          onblur="checkEmail();" <?php echo $mode == "goauth" ? "readonly" : "";?>
          <?php if ($mode == "goauth") {echo "style='background-color: #b2b2b2;'";}?>
          ><br>
         <div class="emailErrMsg"></div><br>
         <button class="w3-btn w3-round-large w3-green" name="updateProfileBtn" value="" onclick="updateProfile();">Update Profile</button><br>

         <h3>Public post</h3>
         <hr>
         Total <a style="color: #0366d6;" href="#" onclick="redirectIframe('Public');"><?php echo $publicPostCount; ?></a> post<?php echo $publicPostCount <= 1 ? "" : "s"; ?> found.<br>

         <h3>Private post</h3>
         <hr>
         Total <a style="color: #0366d6;" href="#" onclick="redirectIframe('Private');"><?php echo $privatePostCount; ?></a> post<?php echo $privatePostCount <= 1 ? "" : "s"; ?> found.<br>
     </body>
</html>

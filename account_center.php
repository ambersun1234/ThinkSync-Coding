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
            button {
                padding: 5px;
            }
            label {
                margin-top: 5px;
            }
            .jump {
                color: #0366d6;
            }
            .attention {
                color: #24292e;
                font-weight: 600;
            }
            .custom {
                border: 1px solid #ccc;
                display: inline-block;
                padding: 6px 12px;
                cursor: pointer;
            }
        </style>

        <script type="text/javascript">
            var permission = 2;
            var permissionArray = {0: "Public ", 1: "Private ", 2: ""};
            var permissionVar = {0: "?permission=0", 1: "?permission=1", 2: ""};
            // permission var is used for checking
            // 0 => public, 1 => private, 2 => none of the above

            $(document).ready(function() {
                function getCookie(name) {
                    var value = "; " + document.cookie;
                    var parts = value.split("; " + name + "=");
                    if (parts.length == 2) return parts.pop().split(";").shift();
                }

                /* set browser cookie in account center
                 * prevent user from reloading the page and jump to another iframe
                 * if user's visit previous page is still account_center
                 *     instead of clearing cookie, just set iframe location to cookie location
                 * otherwise
                 *     clear cookie first, and setting it to default page( profile.php )
                 */
                 var iframeLocation = null;
                 var cookieLocation = getCookie("iframeLocation");
                 if (cookieLocation == null) {
                     iframeLocation = "profile.php";
                     document.cookie = "iframeLocation=" + iframeLocation;
                 }
                 else {
                     iframeLocation = cookieLocation;
                 }
                 // set iframe page
                 window.onload = function() {
                     var temp = "./include/account/" + iframeLocation;
                     var prefix = null;
                     var showText = null;

                     document.querySelector("iframe").setAttribute("src", temp);

                     // restore prefix
                     if (temp.includes("?permission=0")) {
                         prefix = 0;
                     }
                     else if (temp.includes("?permission=1")) {
                         prefix = 1;
                     }
                     else {
                         prefix = 2;
                     }

                     temp = temp.replace("./include/account/", "");
                     temp = temp.replace("Posts", " Posts");
                     temp = temp.replace(".php", "");
                     temp = temp.replace("?permission=0", "");
                     temp = temp.replace("?permission=1", "");
                     temp = temp.charAt(0).toUpperCase() + temp.slice(1);

                     showText = permissionArray[prefix] + temp;
                     $(".ps:contains('" + showText + "')").addClass("attention");
                 }

                $(".ps").on("click", function() {
                    var location = $(this).text();
                    var current = $("iframe").attr("src");
                    var attentionText = $("attention").text();
                    var variableCheck = 2;

                    // check jumping page
                    if (location.includes("Public")) {
                        variableCheck = 0;
                    }
                    else if (location.includes("Private")) {
                        variableCheck = 1;
                    }
                    else {
                        variableCheck = 2;
                    }

                    // store previous status
                    if (attentionText.includes("Public")) {
                        permission = 0;
                    }
                    else if (attentionText.includes("Private")){
                        permission = 1;
                    }
                    else {
                        permission = 2;
                    }

                    var newLocation = location.replace("Public ", "");
                    newLocation = newLocation.replace("Private ", "");
                    newLocation = newLocation.charAt(0).toLowerCase() + newLocation.slice(1) + ".php";

                    // remove parent
                    current = current.replace("./include/account/", "");
                    current = current.replace("Posts", " Posts");
                    current = current.replace(".php", "");
                    current = current.replace("?permission=0", "");
                    current = current.replace("?permission=1", "");
                    // assign permission
                    current = permissionArray[permission] + current;
                    current = current.charAt(0).toUpperCase() + current.slice(1);

                    // alert("pre current: " + $("iframe").attr("src") + "\ncurrent: " + current + "\nlocation: " + location);

                    // remove attention css to previous
                    $(".attention:contains('" + current + "')").removeClass("attention");
                    $(".ps:contains('" + current + "')").addClass("jump");

                    // add attention to next
                    $(".jump:contains('" + location + "')").removeClass("jump");
                    $(".ps:contains('" + location + "')").addClass("attention");

                    // redirect iframe
                    // set url to cookie first
                    document.cookie = "iframeLocation=" + newLocation + permissionVar[variableCheck];
                    $("iframe").attr("src", "./include/account/" + newLocation + permissionVar[variableCheck]);
                });
            });

            function uploadPicture(event) {
                var customForm = new FormData();

                if (event == "new") {
                    customForm.append("picture", $("#file-upload").prop("files")[0]);
                }
                customForm.append("event", event);

                $.ajax({
                    url: "./include/account/updatePicture.php",
                    type: "POST",
                    processData: false, // important
                    contentType: false, // important
                    dataType: "json",
                    data: customForm
                }).done(function(data) {
                    if (data.code == 0) {
                        document.getElementById("pic").querySelector("img").setAttribute("src", "data:image/jpeg;base64," + data.image);
                        document.getElementById('profilePic').setAttribute("src", "data:image/jpeg;base64," + data.image);
                        alert("Update profile picture done.");
                    }
                    else {
                        alert(data.msg);
                    }
                });
            }
        </script>
    </head>

    <body>
        <br><br><br>
        <div class="w3-row">
            <!-- empty column -->
            <div class="w3-col m2 w3-container">
            </div>

            <div class="w3-col m2" style="margin: 0px 20px;">
                <h2>Profile Picture</h2>
                <img id="profilePic" src="data:image/jpeg;base64,<?php echo base64_encode($image);?>" style="width: 200px; height: 200px; display: inline-block;"/>
                <br>
                <label for="file-upload" class="custom w3-btn w3-round-large w3-light-gray w3-small">
                    Upload picture
                </label>
                <input id="file-upload" type="file" style="display: none;" accept="image/*" onchange="uploadPicture('new');"/>
                <br>
                <label for"remove-picture" class="custom w3-btn w3-round-large w3-light-gray w3-small" onclick="uploadPicture('clear');">
                    Remove picture
                </label>
                <input id="remove-picture" type="button" style="display: none;">
            </div>

            <div class="w3-col m4">
                <iframe src="about:blank" style="height: 90%;" frameborder="0" scrolling="no" height="100%" width="100%"></iframe>
            </div>

            <div class="w3-col m2" style="margin: 0px 20px;">
                <div class="w3-bar-block">
                    <span class="w3-bar-item w3-light-gray">Personal Settings</span>
                    <button class="w3-bar-item w3-button ps jump ">Profile</button>
                    <button class="w3-bar-item w3-button ps jump">Account</button>
                    <button class="w3-bar-item w3-button ps jump">Password</button>
                    <button class="w3-bar-item w3-button ps jump">Public Posts</button>
                    <button class="w3-bar-item w3-button ps jump">Private Posts</button>
                </div>
            </div>
        </div>
    </body>
</html>

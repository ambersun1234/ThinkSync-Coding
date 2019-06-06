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
            var premission = 2;
            var premissionArray = {0: "Public ", 1: "Private ", 2: ""};
            // premission var is used for checking
            // 0 => public, 1 => private, 2 => none of the above

            $(document).ready(function() {
                $(".ps").on("click", function() {
                    var location = $(this).text();
                    var current = $("iframe").attr("src");
                    var attentionText = $("attention").text();

                    if (attentionText.includes("Public")) {
                        premission = 0;
                    }
                    else if (attentionText.includes("Private")){
                        premission = 1;
                    }
                    else {
                        premission = 2;
                    }

                    var newLocation = location.replace("Public ", "");
                    newLocation = newLocation.replace("Private ", "");
                    newLocation = newLocation.charAt(0).toLowerCase() + newLocation.slice(1);

                    // remove parent
                    current = current.replace("./include/account/", "");
                    current = current.replace("Posts", " Posts");
                    current = current.replace(".php", "");
                    // assign premission
                    current = premissionArray[premission] + current;
                    current = current.charAt(0).toUpperCase() + current.slice(1);

                    // alert("premission" + premission + "location: " + location + "\ncurrent: " + current + "\nnewlocation: " + newLocation);

                    // remove attention css to previous
                    $(".attention:contains('" + current + "')").removeClass("attention");
                    $(".ps:contains('" + current + "')").addClass("jump");

                    // add attention to next
                    $(".jump:contains('" + location + "')").removeClass("jump");
                    $(".ps:contains('" + location + "')").addClass("attention");

                    // redirect iframe
                    $("iframe").attr("src", "./include/account/" + newLocation + ".php");
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
                <iframe src="./include/account/profile.php" style="height: 90%;" frameborder="0" scrolling="no" height="100%" width="100%"></iframe>
            </div>

            <div class="w3-col m2" style="margin: 0px 20px;">
                <div class="w3-bar-block">
                    <span class="w3-bar-item w3-light-gray">Personal Settings</span>
                    <button class="w3-bar-item w3-button ps jump attention">Profile</button>
                    <button class="w3-bar-item w3-button ps jump">Account</button>
                    <button class="w3-bar-item w3-button ps jump">Password</button>
                    <button class="w3-bar-item w3-button ps jump">Public Posts</button>
                    <button class="w3-bar-item w3-button ps jump">Private Posts</button>
                </div>
            </div>
        </div>
    </body>
</html>

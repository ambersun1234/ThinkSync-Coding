<?php
    session_start();
    session_unset();

    require_once "./include/commonFunction.php";
    require_once "./include/oauth/goauthData.php";
    //echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
    //echo "<meta http-equiv=REFRESH CONTENT=1;url=home.php>";
 ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <!-- google oauth 2.0 API -->
        <meta name="google-signin-client_id" content="<?php echo $goauthClientId; ?>">
        <script src="https://apis.google.com/js/platform.js?hl=en"></script>
        <script src="./include/oauth/oauthScript.js"></script>

        <style>
            img {
                display:block;
                margin:auto;
            }
        </style>
    </head>

    <body>
        <!-- show logout success img -->
        <div id="showImg"></div>
    </body>

    <script type="text/javascript">
        googleSignOut();
        var imgDiv = document.getElementById("showImg");
        var imgTag = document.createElement("img");
        imgTag.setAttribute("src", "./pic/logoutSuccess.png");
        imgTag.setAttribute("width", "90%");
        imgDiv.appendChild(imgTag);
    </script>
</html>

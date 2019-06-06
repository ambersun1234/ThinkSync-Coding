<?php
    session_start();

    require_once "../db/configure.php";
    require_once "../db/db_func.php";
    require_once "../commonFunction.php";

    /* Input
     *     picture: user's upload image
     *     event: new( user input new picture photo ), clear( use default image );
     * Output
     *     JSON array
     *     code: 0( success ), 1( fail )
     *     msg: error message
     *     image: image data( for updating ui )
     */

    // fetch session data
    if (isset($_SESSION["uid"]) && !empty($_SESSION["uid"])) {
        $suid = getData($_SESSION["uid"]);
    }
    if (isset($_SESSION["email"]) && !empty($_SESSION["email"])) {
        $semail = getData($_SESSION["email"]);
    }
    if (isset($_SESSION["mode"]) && !empty($_SESSION["mode"])) {
        $smode = getData($_SESSION["mode"]);
    }

    // fetch data
    if (isset($_FILES["picture"]["size"]) && !empty($_FILES["picture"]["size"])) {
        $pictureSize = $_FILES["picture"]["size"];
        // upload image file size
    }
    if (isset($_FILES["picture"]["tmp_name"]) && !empty($_FILES["picture"]["tmp_name"])) {
        $picturePath = $_FILES["picture"]["tmp_name"];
        // upload image temp file path
    }
    if (isset($_FILES["picture"]["name"]) && !empty($_FILES["picture"]["name"])) {
        $pictureName = $_FILES["picture"]["name"];
    }
    if (isset($_POST["event"]) && !empty($_POST["event"])) {
        $event = getData($_POST["event"]);
    }

    $db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);
    $returnArray = Array("code" => NULL, "msg" => NULL);

    switch ($event) {
        case "new":
            // check if file is truly uploaded
            if ($pictureSize > 0 && $pictureName != NULL && $picturePath != NULL) {
                $fsize = filesize("$picturePath");
                $fd = fopen($picturePath, "rb");
                $image = fread($fd, $fsize);
                $image = addslashes($image);

                $sqlcmd = "UPDATE tsc_account SET Picture = '$image'
                           WHERE UserIndex = '$suid' AND Email = '$semail' AND Mode = '$smode' AND Valid = '0'";
                $rs = updatedb($sqlcmd, $db_conn);
                if ($rs == TRUE) {
                    $image = stripslashes($image);
                    /* need to remove slashes from early added
                     * otherwise it'll fail in front end
                     */

                    $returnArray["code"] = 0;
                    $returnArray["msg"] = "";
                    $returnArray["image"] = base64_encode($image);
                    /* Notice that $image is binary data, it need to use base64_encode
                     * otherwise front end json will fail
                     */
                }
                else {
                    $returnArray["code"] = 1;
                    $returnArray["msg"] = "Something went wrong, please try again.";
                }
            }
            else {
                $returnArray["code"] = 1;
                $returnArray["msg"] = "Something went wrong, please try again.";
            }
            break;

        case "clear":
            $picturePath = "../../tmp/default.png";
            $fsize = filesize("$picturePath");

            if ($fsize > 0) {
                $fd = fopen($picturePath, "rb");
                $image = fread($fd, $fsize);
                $image = addslashes($image);

                $sqlcmd = "UPDATE tsc_account SET Picture = '$image'
                           WHERE UserIndex = '$suid' AND Email = '$semail' AND Mode = '$smode' AND Valid = '0'";
                $rs = updatedb($sqlcmd, $db_conn);
                if ($rs == TRUE) {
                    $image = stripslashes($image);
                    /* need to remove slashes from early added
                     * otherwise it'll fail in front end
                     */

                    $returnArray["code"] = 0;
                    $returnArray["msg"] = "";
                    $returnArray["image"] = base64_encode($image);
                    /* Notice that $image is binary data, it need to use base64_encode
                     * otherwise front end json will fail
                     */
                }
                else {
                    $returnArray["code"] = 1;
                    $returnArray["msg"] = "Something went wrong, please try again.";
                }
            }
            else {
                $returnArray["code"] = 1;
                $returnArray["msg"] = "Something went wrong, please try again.";
            }
            break;

        default:
            $returnArray["code"] = 1;
            $returnArray["msg"] = "Something went wrong, please try again.";
            break;
    }

    echo json_encode($returnArray);
 ?>

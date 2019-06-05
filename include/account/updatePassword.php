<?php
    session_start();

    require_once "../db/configure.php";
    require_once "../db/db_func.php";
    require_once "../commonFunction.php";

    /* Input:
     *     oldPassword: user's old password
     *     newPassword: user's input new password
     *     new2Password: user's input new password( confirm use )
     * Output:
     *     JSON array:
     *     code: 0( success ), 1( failed )
     *     msg: error message
     */

    function passwordValidation($pw, $pw2) {
        if ($pw == "" || $pw2 == "") {
            return FALSE;
        }
        else if ($pw != $pw2) {
            return FALSE;
        }
        else {
            return TRUE;
        }
    }

    function oldPasswordValidation($pw, $epw) {
        if (password_verify($pw, $epw)) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    // fetch session
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
    if (isset($_POST["oldPassword"]) && !empty($_POST["oldPassword"])) {
        $oldPassword = getData($_POST["oldPassword"]);
    }
    if (isset($_POST["newPassword"]) && !empty($_POST["newPassword"])) {
        $newPassword = getData($_POST["newPassword"]);
    }
    if (isset($_POST["new2Password"]) && !empty($_POST["new2Password"])) {
        $new2Password = getData($_POST["new2Password"]);
    }

    // returen JSON array
    $returnArray = Array("code" => NULL, "msg" => NULL);

    $db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);
    $sqlcmd = "SELECT * FROM tsc_account
               WHERE UserIndex = '$suid' AND Mode = '$smode' AND Email = '$semail'";
    $rs = querydb($sqlcmd, $db_conn);
    $encryptedPassword = $rs[0]["Password"];

    if (oldPasswordValidation($oldPassword, $encryptedPassword)) {
        if (passwordValidation($newPassword, $new2Password)) {
            $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $sqlcmd = "UPDATE tsc_account SET Password = '$newPassword'
                       WHERE UserIndex = '$suid' AND Email = '$semail' AND Mode = '$smode'";
            $rs = updatedb($sqlcmd, $db_conn);
            if ($rs == TRUE) {
                $returnArray["code"] = 0;
                $returnArray["msg"] = "";
            }
            else {
                $returnArray["code"] = 1;
                $returnArray["msg"] = "Something went wrong, please tray again.";
            }
        }
        else {
            $returnArray["code"] = 1;
            $returnArray["msg"] = "New password validation failed.";
        }
    }
    else {
        $returnArray["code"] = 1;
        $returnArray["msg"] = "Old password validation failed.";
    }

    echo json_encode($returnArray);
 ?>

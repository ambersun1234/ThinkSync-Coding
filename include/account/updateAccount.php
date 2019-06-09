<?php
    session_start();

    require_once "../db/configure.php";
    require_once "../db/db_func.php";
    require_once "../commonFunction.php";

    /* Input:
     *     username: user's username
     *     email: user's email
     *     check: validation string
     *     password: user's account password
     * Output:
     *     JSON array:
     *     code: 0( success ), 1( failed )
     *     msg: error message
     */

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
    if (isset($_POST["username"]) && !empty($_POST["username"])) {
        $username = getData($_POST["username"]);
    }
    if (isset($_POST["email"]) && !empty($_POST["email"])) {
        $email = getData($_POST["email"]);
    }
    if (isset($_POST["check"]) && !empty($_POST["check"])) {
        $check = getData($_POST["check"]);
    }
    if (isset($_POST["password"]) && !empty($_POST["password"])) {
        $password = getData($_POST["password"]);
    }

    $returnArray = Array("code" => NULL, "msg" => NULL);
    $db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);

    /*
     * Delete account, as for each table we use
     * we basically just change each of the column named 'valid' to '1'
     * no need to actually remove the data
     * In our case, there are 6 table that we need to modify
     *      tsc_account
     *      tsc_code
     *      tsc_comment
     *      tsc_post
     *      tsc_rating
     *      tsc_reply
     */

    // first we need to check user correctness
    if ($check == "delete my account") {
        $sqlcmd = "SELECT * FROM tsc_account
                   WHERE UserIndex = '$suid' AND Username = '$username' AND Email = '$semail'
                   AND Email = '$email' AND Mode = '$smode' AND Valid = '0'";
        $rs = querydb($sqlcmd, $db_conn);

        $encryptedPassword = $rs[0]["Password"];
        $checkPwd = password_verify($password, $encryptedPassword);

        if (count($rs) == 1 && $checkPwd) {
            // proceed in deleting account
            $deleteArr = Array();
            array_push($deleteArr, "UPDATE tsc_account SET Valid = '1' WHERE UserIndex = '$suid' AND Email = '$semail'");
            array_push($deleteArr, "UPDATE tsc_code SET Valid = '1' WHERE UserIndex = '$suid'");
            array_push($deleteArr, "UPDATE tsc_comment SET Valid = '1' WHERE UserIndex = '$suid'");
            array_push($deleteArr, "UPDATE tsc_post SET Valid = '1' WHERE UserIndex = '$suid'");
            array_push($deleteArr, "UPDATE tsc_rating SET Valid = '1' WHERE UserIndex = '$suid'");
            array_push($deleteArr, "UPDATE tsc_reply SET Valid = '1' WHERE UserIndex = '$suid'");

            $okay = TRUE;
            foreach($deleteArr as $trash => $sqlcmd) {
                $rs = updatedb($sqlcmd, $db_conn);
                if (!$rs) {
                    $okay = FALSE;
                    break;
                }
            }

            // check if all sqlcmd execute successfully
            if ($okay == FALSE) {
                $returnArray["code"] = 1;
                $returnArray["msg"] = "Something went wrong, please try again.";
            }
            else {
                $returnArray["code"] = 0;
                $returnArray["msg"] = "";
                session_unset();
            }
        }
        else {
            $returnArray["code"] = 1;
            $returnArray["msg"] = "Verify failed, please check your input content.\n$sqlcmd";
        }
    }
    else {
        $returnArray["code"] = 1;
        $returnArray["msg"] = "Verify failed, type \"delete my account\" in verify block.";
    }

    echo json_encode($returnArray);
 ?>

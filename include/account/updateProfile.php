<?php
    session_start();

    require_once "../db/configure.php";
    require_once "../db/db_func.php";
    require_once "../commonFunction.php";

    /* Input:
     *     username: user input username
     *     email: user input email
     * Output:
     *     JSON array:
     *     code: 0( success ), 1( failed )
     *     msg: error message
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
    if (isset($_POST["username"]) && !empty($_POST["username"])) {
        $username = getData($_POST["username"]);
    }
    if (isset($_POST["email"]) && !empty($_POST["email"])) {
        $email = getData($_POST["email"]);
    }

    // returen JSON array
    $returnArray = Array("code" => NULL, "msg" => NULL);

    $db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);
    $sqlcmd = "UPDATE tsc_account SET Username = '$username', Email = '$email'
               WHERE UserIndex = '$suid' AND Mode = '$smode' AND Email = '$semail'";
    $rs = updatedb($sqlcmd, $db_conn);
    if ($rs == TRUE) {
        $returnArray["code"] = 0;
        $returnArray["msg"] = "";
        $_SESSION["email"] = $email;
    }
    else {
        $returnArray["code"] = 1;
        $returnArray["msg"] = "Something failed, please try again\n$sqlcmd";
    }

    echo json_encode($returnArray);
 ?>

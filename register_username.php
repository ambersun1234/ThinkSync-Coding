<?php
    session_start();

    require_once "./include/db/configure.php";
    require_once "./include/db/db_func.php";
    require_once "./include/commonFunction.php";

    /* Input:
     *    username: user input username
     * Output:
     *    code: 0( success ), 1( failed )
     *    msg: error message
     */

     // return json array
    $returnArray = Array("code" => NULL, "msg" => NULL);

    // fetch data
    if (isset($_POST["username"]) && !empty($_POST["username"])) {
        $username = getData($_POST["username"]);
    }

    // query database to find out whether the email had been registered or not
    $db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);
    $sqlcmd = "SELECT * FROM tsc_account WHERE Username = '$username' AND Valid = '0'";
    $rs = querydb($sqlcmd, $db_conn);
    if (count($rs) > 0) {
        $returnArray["code"] = 1;
        $returnArray["msg"] = "Username had been registerd.";
    }
    else {
        $returnArray["code"] = 0;
        $returnArray["msg"] = "";
    }

    echo json_encode($returnArray);
 ?>

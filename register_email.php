<?php
    session_start();

    require_once "./include/db/configure.php";
    require_once "./include/db/db_func.php";
    require_once "./include/commonFunction.php";

    /* Input:
     *    email: user input email
     * Output:
     *    code: 0( success ), 1( failed )
     *    msg: error message
     */

     // return json array
    $returnArray = Array("code" => NULL, "msg" => NULL);

    // fetch data
    if (isset($_POST["email"]) && !empty($_POST["email"])) {
        $email = getData($_POST["email"]);
    }

    // query database to find out whether the email had been registered or not
    $db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);
    $sqlcmd = "SELECT * FROM tsc_account WHERE Email = '$email' AND Valid = '0'";
    $rs = querydb($sqlcmd, $db_conn);
    if (count($rs) > 0) {
        $returnArray["code"] = 1;
        $returnArray["msg"] = "Email had been registerd.";
    }
    else {
        $returnArray["code"] = 0;
        $returnArray["msg"] = "";
    }

    echo json_encode($returnArray);
 ?>

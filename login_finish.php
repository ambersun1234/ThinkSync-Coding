<?php
    session_start();
    require_once "./include/commonFunction.php";
    require_once "./include/db/db_func.php";
    require_once "./include/db/configure.php";
    require_once "./include/oauth/goauth_api_client/vendor/autoload.php"; // use for google Oauth 2.0 api
    require_once "./include/oauth/goauthData.php";

    /* Input:
     *     token: id token
     *     pwd: user password
     *     email: user email
     *     mode: goauth, normal
     * Output:
     *     code: 0( success ), 1( fail )
     *     msg: error message
     */

    $modeArray = Array("goauth", "normal");
    $returnValue = Array("code" => 0, "msg" => NULL);
    $validation = FALSE;

    // fetch data
    if (isset($_POST["token"]) && !empty($_POST["token"])) {
        $token = getData($_POST["token"]);
    }
    if (isset($_POST["pwd"]) && !empty($_POST["pwd"])) {
        $pwd = getData($_POST["pwd"]);
    }
    if (isset($_POST["email"]) && !empty($_POST["email"])) {
        $email = getData($_POST["email"]);
    }
    if (isset($_POST["mode"]) && !empty($_POST["mode"])) {
        $mode = getData($_POST["mode"]);
    }

    // for each login way, do the proper measure
    switch ($mode) {
        case "normal":
            // use email and pwd to verify user
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $returnValue["code"] = 1;
                $returnValue["msg"] = "Invalid email format.";
            }
            else {
                $db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);
                $sqlcmd = "SELECT * FROM tsc_account WHERE Email = '$email' AND Valid = '0'";
                $rs = querydb($sqlcmd, $db_conn);

                $encryptedPassword = $rs[0]["Password"];
                if (password_verify($pwd, $encryptedPassword)) {
                    $uid = $rs[0]["UserIndex"];
                    $returnValue["code"] = 0;
                }
                else {
                    $returnValue["code"] = 1;
                    $returnValue["msg"] = "Incorrect password.";
                }
            }
            break;

        case "goauth":
            $db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);
            $sqlcmd = "SELECT * FROM tsc_account WHERE Email = '$email' AND Valid = '0'";
            $rs = querydb($sqlcmd, $db_conn);
            if (count($rs) == 1) {
                // use google api to verify user
                $goauth = new Google_Client(["client_id" => $goauthClientId]);
                $payload = $goauth->verifyIdToken($token);
                if (!$payload) {
                    $returnValue["code"] = 1;
                    $returnValue["msg"] = "Invalid ID token.";
                }
                else {
                    $returnValue["code"] = 0;
                    $uid = $token;
                }
            }
            else {
                $returnValue["code"] = 1;
                $returnValue["msg"] = "No user found in ThinkSync-Coding.";
            }
            break;

        default:
            $returnValue["code"] = 1;
            $returnValue["msg"] = "Something went wrong, please try again.";
            break;
    }

    // set session data
    if ($returnValue["code"] == 0) {
        $_SESSION["uid"] = $uid;
        $_SESSION["email"] = $email;
        $_SESSION["mode"] = $mode;
    }

    echo json_encode($returnValue);
 ?>

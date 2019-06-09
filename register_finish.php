<?php
    session_start();

    require_once "./include/db/configure.php";
    require_once "./include/db/db_func.php";
    require_once "./include/oauth/goauth_api_client/vendor/autoload.php"; // use for google Oauth 2.0 api
    require_once "./include/oauth/goauthData.php";
    require_once "./include/commonFunction.php";

    $db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);

    function passwordValidation($pw, $pw2) {
        $check = FALSE;

        if ($pw == "" || $pw2 == "") {
            $check = FALSE;
        }
        else {
            if ($pw == $pw2) {
                $check = TRUE;
            }
            else {
                $check = FALSE;
            }
        }
        return $check;
    }

    function emailValidation($email) {
        $check = FALSE;

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $check = TRUE;
        }
        else {
            $check = FALSE;
        }
        return $check;
    }

    function checkUser($email, $mode) {
        $sqlcmd = "SELECT * FROM tsc_account WHERE Email = '$email' AND Mode = '$mode' AND Valid = '0'";
        $rs = querydb($sqlcmd, $GLOBALS['db_conn']);
        if (count($rs) == 1) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    /* Input:
     *     token: goauth token check
     *     email: user sign up email
     *     mode: which sign up mode( goauth, normal );
     *     username: sign up username
     *     pw: sign up password1
     *     pw: sign up password2( validation usage );
     *
     * Output:
     *     JSON array
     *     code: 0( success ), 1( fail )
     *     msg: error message
     */

    $returnArray = Array("code" => NULL, "msg" => NULL);

    // fetch data
    if (isset($_POST["token"]) && !empty($_POST["email"])) {
        $token = getData($_POST["token"]);
    }
    if (isset($_POST["email"]) && !empty($_POST["email"])) {
        $email = getData($_POST["email"]);
    }
    if (isset($_POST["mode"]) && !empty($_POST["mode"])) {
        $mode = getData($_POST["mode"]);
    }
    if (isset($_POST["username"]) && !empty($_POST["username"])) {
        $username = getData($_POST["username"]);
    }
    if (isset($_POST["pw"]) && !empty($_POST["pw"])) {
        $pw = getData($_POST["pw"]);
    }
    if (isset($_POST["pw2"]) && !empty($_POST["pw2"])) {
        $pw2 = getData($_POST["pw2"]);
    }

    // for each login way, do the proper measure
    switch ($mode) {
        case "normal":
            $mode = "normal";

            if (empty($username)) {
                $returnArray["code"] = 1;
                $returnArray["msg"] = "Username cannot be empty.";
            }
            else if (!emailValidation($email)) {
                $returnArray["code"] = 1;
                $returnArray["msg"] = "Email validation failed.";
            }
            else {
                if (!passwordValidation($pw, $pw2)) {
                    $returnArray["code"] = 1;
                    $returnArray["msg"] = "Password validation failed.";
                }
                else {
                    if (checkUser($email, $mode)) {
                        $returnArray["code"] = 1;
                        $returnArray["msg"] = "Email $email had been registered, please try another one.";
                    }
                    else {
                        // insert new user into database
                        // encrypt password
                        $pw = password_hash($pw, PASSWORD_DEFAULT);
                        $sqlcmd = "INSERT INTO tsc_account(Username, Email, Password, Valid, Mode)
                                   VALUES('$username', '$email', '$pw', '0', 'normal')";
                        $rs = querydb($sqlcmd, $db_conn);

                        // get client id
                        $sqlcmd = "SELECT LAST_INSERT_ID() as uid";
                        $rs = querydb($sqlcmd, $db_conn);
                        $uid = $rs[0]["uid"];
                        $returnArray["code"] = 0;
                        $returnArray["msg"] = "";
                    }
                }
            }
            break;

        case "goauth":
            $mode = "goauth";
            $goauth = new Google_Client(["client_id" => $goauthClientId]);
            $payload = $goauth->verifyIdToken($token);
            if (!$payload) {
                $returnValue["code"] = 1;
                $returnValue["msg"] = "Invalid ID token.";
            }
            else {
                $email = getData($payload["email"]);
                $username = getData($payload["name"]);

                if (checkUser($email, $mode)) {
                    $returnArray["code"] = 1;
                    $returnArray["msg"] = "Email $email had been registered\n please try another one.";
                }
                else {
                    // insert new user into database
                    $sqlcmd = "INSERT INTO tsc_account(Username, Email, Password, Valid, Mode)
                               VALUES ('$username', '$email', '', '0', 'goauth')";
                    $rs = querydb($sqlcmd, $db_conn);

                    $sqlcmd = "SELECT LAST_INSERT_ID() as uid";
                    $rs = querydb($sqlcmd, $db_conn);
                    $uid = $rs[0]["uid"];
                    $returnArray["code"] = 0;
                    $returnArray["msg"] = "";
                }
            }
            break;

        default:
            $mode = "";
            $returnArray["code"] = 1;
            $returnArray["msg"] = "Something went wrong, please try again.";
    }

    // set session
    if ($returnArray["code"] == 0) {
        $_SESSION["uid"] = $uid;
        $_SESSION["email"] = $email;
        $_SESSION["mode"] = $mode;
        $_SESSION["token"] = $token;
    }

    echo json_encode($returnArray);
 ?>

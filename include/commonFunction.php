<?php
    session_start();
    require_once "./include/db/db_func.php";
    require_once "./include/db/configure.php";
    require_once "./include/oauth/goauth_api_client/vendor/autoload.php"; // use for google Oauth 2.0 api
    require_once "./include/oauth/goauthData.php";

    function getData($input) {
        $ret = htmlspecialchars($input);
        return $ret;
    }

    function checkLogin() {
        $uid = getData($_SESSION["uid"]);
        $email = getData($_SESSION["email"]);
        $mode = getData($_SESSION["mode"]);

        switch ($mode) {
            case "normal":
                $db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);

                // checkout whether user is registered or not
                $sqlcmd = "SELECT * FROM tsc_account WHERE Email = $email AND UserIndex = $uid AND valid = '0'";
                $rs = querydb($sqlcmd, $db_conn);
                if (count($rs) != 1) {
                    // not login
                    header("Location: ./login.php");
                }
                else {
                    header("Location: ./home.php");
                }
                break;

            case "goauth":
                if ($uid == NULL) {
                    header("Location: ./home.php");
                }
                $goauth = new Google_Client(["client_id" => $goauthClientId]);
                $payload = $goauth->verifyIdToken($uid);
                if (!$payload) {
                    // not login
                    header("Location: ./login.php");
                }
                else {
                    header("Location: ./home.php");
                }
                break;

            default:
                header("Location: ./home.php");
                break;
        }
    }
 ?>

<?php
    session_start();

    require_once __DIR__ . "/db/configure.php";
    require_once __DIR__ . "/db/db_func.php";
    require_once __DIR__ . "/oauth/goauth_api_client/vendor/autoload.php"; // use for google Oauth 2.0 api
    require_once __DIR__ . "/oauth/goauthData.php";

    $db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);

    if (!function_exists("getData")) {
        function getData($input) {
            $ret = htmlspecialchars($input);
            return $ret;
        }
    }

    if (!function_exists("checkLogin")) {
        function checkLogin() {
            $uid = getData($_SESSION["uid"]);
            $email = getData($_SESSION["email"]);
            $mode = getData($_SESSION["mode"]);
            $token = getData($_SESSION["token"]);

            switch ($mode) {
                case "normal":
                    // checkout whether user is registered or not
                    $sqlcmd = "SELECT * FROM tsc_account WHERE Email = '$email' AND UserIndex = '$uid' AND valid = '0'";
                    $rs = querydb($sqlcmd, $GLOBALS["db_conn"]);
                    if (count($rs) != 1) {
                        // not login
                        // header("Location: ./login.php");
 ?>
                        <script type="text/javascript">
                            window.location = "./login.php";
                        </script>
<?php
                    }
                    break;

                case "goauth":
                    if ($token == NULL) {
                        // header("Location: ./home.php");
 ?>
                       <script type="text/javascript">
                            window.location = "./login.php";
                       </script>
<?php
                    }
                    $goauth = new Google_Client(["client_id" => $goauthClientId]);
                    $payload = $goauth->verifyIdToken($token);
                    if (!$payload) {
                        // not login
                        // header("Location: ./login.php");
 ?>
                       <script type="text/javascript">
                           window.location = "./login.php";
                       </script>
<?php
                    }
                    break;

                default:
 ?>
                       <script type="text/javascript">
                            window.location = "./login.php";
                       </script>
<?php
                    break;
                }
            }
        }
 ?>

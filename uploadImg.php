<?php
    session_start();

    require_once "./include/db/configure.php";
    require_once "./include/db/db_func.php";
    require_once "./include/commonFunction.php";

    /* Input:
     *    method: url( goauth register will give img url), path( normal register, use default img)
     *    mode: normal, goauth
     *    imgUrl: img url( goauth only )
     *
     * Output:
     *    JSON array:
     *    code: 0( success ), 1( fail )
     *    msg: error message
     */

     checkLogin(); // commonFunction.php

     $db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);
     $returnArray = Array("code" => NULL, "msg" => NULL);
     $defaultImgPath = "./tmp/default.png";

     function validUser($email, $mode) {
         $sqlcmd = "SELECT * FROM tsc_account
                    WHERE Email = '$email' AND Mode = '$mode' AND Valid = '0'";
         $rs = querydb($sqlcmd, $GLOBALS["db_conn"]);
         if (count($rs) != 1) {
             return FALSE;
         }
         else {
             return TRUE;
         }
     }

     // fetch data
     if (isset($_POST["method"]) && !empty($_POST["method"])) {
         $method = getData($_POST["method"]);
     }
     if (isset($_POST["mode"]) && !empty($_POST["mode"])) {
         $mode = getData($_POST["mode"]);
     }
     if (isset($_POST["imgUrl"]) && !empty($_POST["imgUrl"])) {
         $imgUrl = getData($_POST["imgUrl"]);
     }

     // fetch session data
     $email = getData($_SESSION["email"]);
     $uid = getData($_SESSION["uid"]);
     $mode = getData($_SESSION["mode"]);

     if (validUser($email, $mode)) {
         switch ($mode) {
             case "normal":
                if ($method == "path") {
                    $fsize = filesize($defaultImgPath);

                    if ($fsize == 0) {
                        $returnArray["code"] = 1;
                        $returnArray["msg"] = "Something went wrong, please try again.";
                    }
                    else {
                        // open default img located at web server
                        $fd = fopen($defaultImgPath, "rb");
                        $image = fread($fd, $fsize);
                        $image = addslashes($image);

                        // write default img to user's database row
                        $sqlcmd = "UPDATE tsc_account SET Picture = '$image'
                                   WHERE UserIndex = '$uid' AND Email = '$email' AND Mode = '$mode'
                                   AND Valid = '0'";
                        $rs = updatedb($sqlcmd, $db_conn);

                        // update finish
                        $returnArray["code"] = 0;
                        $returnArray["msg"] = "";
                    }
                }
                else {
                    $returnArray["code"] = 1;
                    $returnArray["msg"] = "Something went wrong, please try again.";
                }
                break;

             case "goauth":
                 if ($method == "url") {
                     // wget imgUrl
                     $path = "./tmp/$uid.png";
                     exec("wget $imgUrl --no-check-certificate -O $path --inet4-only 2>&1", $output, $rt);
                     if ($rt != 0) {
                         $returnArray["code"] = 1;
                         $returnArray["msg"] = "Something went wrong, please try again.";
                     }
                     else {
                         // read img information
                         $fsize = filesize($path);

                         if ($fsize == 0) {
                             $returnArray["code"] = 1;
                             $returnArray["msg"] = "Something went wrong, please try again.";
                         }
                         else {
                             // open img from google user
                             $fd = fopen($path, "rb");
                             $image = fread($fd, $fsize);
                             $image = addslashes($image);

                             // write img into user's database
                             $sqlcmd = "UPDATE tsc_account SET Picture = '$image'
                                        WHERE UserIndex = '$uid' AND Email = '$email' AND Mode = '$mode'
                                        AND Valid = '0'";
                             $rs = updatedb($sqlcmd, $db_conn);

                             // delete img stored in local machine
                             exec("rm ./tmp/$uid.png 2>&1", $output, $rt);

                             // update finish
                             $returnArray["code"] = 0;
                             $returnArray["msg"] = "";
                         }
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
     }
     else {
         $returnArray["code"] = 1;
         $returnArray["msg"] = "Invalid user found.";
     }

     if ($returnArray["code"] == 1) {
         session_unset();
     }

     echo json_encode($returnArray);
 ?>

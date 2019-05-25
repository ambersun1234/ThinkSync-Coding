<?php
    session_start();
    require_once "./include/commonFunction.php";

    /* Input:
     *     name: user name
     *     email: user email
     *     mode: goauth, normal
     * Output:
     *     code: 0( success ), 1( fail )
     */

    $modeArray = Array("goauth", "normal");
    $returnValue = Array("code" => 0);

    // fetch data
    if (isset($_POST["name"]) && !empty($_POST["name"])) {
        $name = getData($_POST["name"]);
    }
    if (isset($_POST["email"]) && !empty($_POST["email"])) {
        $email = getData($_POST["email"]);
    }
    if (isset($_POST["mode"]) && !empty($_POST["mode"])) {
        $mode = getData($_POST["mode"]);
    }

    // check data
        // check email valid or not
        // check mode is in modeArray

    // set session data
    $_SESSION["name"] = $name;
    $_SESSION["email"] = $email;
    $_SESSION["mode"] = $mode;

    // set json data
    $returnValue["code"] = 0;
    echo json_encode($returnValue);
 ?>

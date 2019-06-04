<?php
    require_once "../db/configure.php";
    require_once "../db/db_func.php";
    require_once "../commonFunction.php";

    // fetch premission
    if (isset($_GET["premission"]) && !empty($_GET["premission"])) {
        $premission = getData($_GET["premission"]);
    }
 ?>

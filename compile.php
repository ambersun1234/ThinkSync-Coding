<?php
    session_start();

    require_once "./include/compileConfig.php"; // color, defaultLanguage declaration, function
    require_once "./include/commonFunction.php"; // function: getData

    /* Input:
     *     language: c, c++
     *     code: origin program code
     *     wipe: wipe out executable file, 0( true ), 1( false )
     *     flag:
     *         optimize: -O0, -O1, -O2, -O3
     *         standard: c89, c90, c99, c11, c++98, c++03, c++11
     *
     * Output:
     *     code: 0( success ), 1( fail )
     *     msg: string( compile error message )
     *     version: string( specific compiler version )
     *     path: executable file path
     */

    // get post data
    if (isset($_POST["wipe"]) && !empty($_POST["wipe"])) {
        $wipe = getData($_POST["wipe"]);
    }
    if (isset($_POST["language"]) && !empty($_POST["language"])) {
        $language = getData($_POST["language"]);

        // check if input language is in default language or not
        if (!in_array($language, $defaultLanguage)) {
            $language = NULL;
        }
        else {
            $ret = getVersion($compiler[$language]);
            if ($ret["ret"] == 1) {
                echo error("Something went wrong, please try again.");
            }
            else {
                $version = $ret["version"];
            }
        }
    }
    if (isset($_POST["code"]) && !empty($_POST["code"])) {
        /* $_POST["code"] cannot use getData
         * since in source code there are a lot of escape characters such as <>&*
         * function getData will change those to something like &lt &gt
         * which will cause compiler error
         */
        $code = $_POST["code"];
    }
    if (isset($_POST["flag"]["optimize"]) && !empty($_POST["flag"]["optimize"])) {
        if (in_array($_POST["flag"]["optimize"], $defaultOptimize)) {
            $optimize = getData($_POST["flag"]["optimize"]);
        }
        else {
            echo error("Something went wrong, please try again.");
        }
    }
    if (isset($_POST["flag"]["standard"]) && !empty($_POST["flag"]["standard"])) {
        if (in_array($_POST["flag"]["standard"], $defaultStandard)) {
            $standard = getData($_POST["flag"]["standard"]);
        }
        else {
            echo error("Something went wrong, please try again.");
        }
    }

    // check session
    if (!isset($_SESSION["uid"])) {
        // generate random string for distinct filename
        $id = "lalaland";
    }
    else {
        // use user's session id as filename
        $id = $_SESSION["uid"];
    }

    // write code to flie
    $subName = $language == "c++" ? "cpp" : "c";
    $currentPath = dirname(__FILE__);
    // store code in writeable path
    $path = $currentPath . "/tmp";
    $fp = fopen("$path/$id.$subName", "w") or die("unable to write file");
    fwrite($fp, $code);
    fclose($fp);

    $selectCompiler = $compiler[$language];
    $selectColor = $color[$selectCompiler];

    shell_exec("script -qfc \"$selectCompiler $selectColor $path/$id.$subName -std=$standard $optimize -o $path/$id &> $path/$id.log 2>&1\"");

    $content = file_get_contents("$path/$id.log");
    $content = str_replace($path, ".", $content); // remove absolute path for security concern
    $content = str_replace("\n", "<br>", $content); // replace new line with html new line
    $content = preg_replace('/[\x00-\x1F\x7F]/u', '', $content); // remove escape characters

    // shell code 2 color hex, $shellCode2Color is defined at ./include/compileConfig.php
    $choose = $shellCode2Color[$pick[$selectCompiler]];
    foreach ($choose as $key => $value) {
        // $content = str_replace($key, $value, $content); // shell code 2 color name

        if ($value != "clear") {
            $first = $value == "bold" ? "<span style='font-weight: " : "<span style='color: ";
            $last = ";'>";

            $content = str_replace(
                $key,
                $first . $color2Hex[$value] . $last,
                $content,
                $count
            ); // color name 2 hex
        }
        else {
            $content = str_replace(
                $key,
                "</span>",
                $content,
                $count
            ); // replace clear 2 </span>
        }
    } // end foreach
    if ($content == "") $content = "<span style='font-weight: bold;'>No error.</span>";

    // remove temp file
    exec("rm -f $path/$id.$subName", $output, $ret); // remove original source code file
    exec("rm - $path/$id.log", $output, $ret); // remove orgianl source code compilation error
    if ($wipe == 0) {
        exec("rm -f $path/$id");
    }

    echo success($content, $version, "$path/$id");
 ?>

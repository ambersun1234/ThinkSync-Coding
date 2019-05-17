<?php
    require_once "./include/compileConfig.php"; // color, defaultLanguage declaration, function
    require_once "./include/commonFunction.php"; // function: getData

    /* Input:
     * POST method
     * 1. language
     * 2. code
     */

    /* Output:
     * return JSON data
     * code: 0( success ), 1( fail )
     * msg: string( compile error message )
     * version: string( specific compiler version )
     */

    $compiler = Array("c" => "gcc", "c++" => "g++");

    // get post data
    if (isset($_POST["language"])) {
        $language = getData($_POST["language"]);

        // check if input language is in default language or not
        if (!in_array($language, $defaultLanguage)) {
            $language = NULL;
        }
        else {
            $ret = getVersion($language);
            if ($ret["ret"] == 1) {
                echo error();
                exit();
            }
            else {
                $version = $ret["version"];
            }
        }
    }
    if (isset($_POST["code"])) {
        $code = getData($_POST["code"]);
    }

    // check session
    if (!isset($_SESSION["id"])) {
        // echo error();
        // exit();
        $id = 1;
    }
    else {
        $id = $_SESSION["id"];
    }

    if ($language === NULL) {
        echo error();
        exit();
    }

    // write code to flie
    $subName = $language == "c++" ? "cpp" : "c";

    // get user home directory. e.g. /home/john/
    $path = "/home/ui3a11";
    $fp = fopen("$path/$id.$subName", "w") or die("unable to write file");
    fwrite($fp, $code);
    fclose($fp);

    // compile source code
    $selectCompiler = $compiler[$language];
    exec(
        "script -qc
        \"$selectCompiler -fdiagnostics-color=always $path/$id.$subName -o $path/$id &> $path/$id.log
        \" > /dev/null",
        $output,
        $ret
    );

    if ($ret != 0) {
        echo error();
        exit();
    }
    else {
        $fp = fopen("$path/$id.$subName", "r") or die("unable to read file");
        $content = fread($fp, filesize("log"));

        // shell code 2 color hex
        foreach ($shellCode2Color as $key => $value) {
            str_replace($key, $value, $content); // shell code 2 color name

            if ($value != "clear") {
                $first = $value == "bold" ? "font-weight: " : "color: ";
                $last = ";\"";
                str_replace($value, "<span style=\"" . $first . $color2Hex[$value] . $last, $content); // color name 2 hex
            }
            else {
                str_replace($value, "</span>", $content); // replace clear 2 </span>
            }
        } // end foreach

        // remove temp file
        exec("rm -f $path/$id.$subName", $output, $ret);
        echo success($content, $version);
        exit();
    }
 ?>

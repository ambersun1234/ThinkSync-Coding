<?php
    session_start();
    require_once "./include/compilConfig.php"; // color, defaultLanguage declaration
    require_once "./include/commonFunction.php"; // function: getData

    function compile() {
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
                    return error();
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
            return error();
        }
        else {
            $id = $_SESSION["id"];
        }

        if ($language === NULL) {
            return error();
        }

        // write code to flie
        $fp = fopen("$id.$language", "w") or die("unable to write file");
        fwrite($fp, $code);
        fclose($fp);

        // compile source code
        $selectCompiler = $compiler[$language];
        exec("script -qc \"$selectCompiler -fdiagnostics-color=always test.c &> log\" > /dev/null", $output, $ret);
        if ($ret != 0) {
            return error();
        }
        else {
            $fp = fopen("$id.$language", "r") or die("unable to read file");
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
            return success($content, $version);
        }
    }

    function getVersion($language) {
        $returnVal = Array("ret" => NULL, "version" => NULL);

        exec("$compiler --version | grep $compiler", $output, $ret); // execute shell command
        $returnVal["ret"] = $ret;
        $returnVal["version"] = $output;

        return $returnVal;
    }

    function success($content, $version) {
        $returnVal = Array("code" => NULL, "msg" => NULL, "version" => NULL);
        $returnVal["code"] = 0;
        $returnVal["msg"] = $content;
        $returnVal["version"] = $version;
        return json_encode($returnVal);
    }

    function error() {
        $returnVal = Array("code" => NULL, "msg" => NULL, "version" => NULL);
        $returnVal["code"] = 1;
        $returnVal["msg"] = "";
        $returnVal["version"] = "";
        return json_encode($returnVal);
    }
 ?>

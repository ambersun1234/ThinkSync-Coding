<?php
    session_start();

    require_once "./include/db/configure.php";
    require_once "./include/db/db_func.php";
    require_once "./include/commonFunction.php";

    /* Input:
     *     executable: executable path
     *     input: input content
     * Output:
     *     JSON array
     *     code: 0( success ), 1( fail )
     *     msg: error message
     *     output: run program output
     */

    if (isset($_POST["executable"]) && !empty($_POST["executable"])) {
        $executable = getData($_POST["executable"]);
    }
    if (isset($_POST["input"]) && !empty($_POST["input"])) {
        $input = getData($_POST["input"]);
    }

    $returnArray = Array("code" => NULL, "msg" => NULL, "output" => NULL);

    if ($executable != "") {
        $path = dirname(__FILE__) . "/tmp"; // it doesn't end with /
        $filename = basename($executable);

        file_put_contents("$path/$filename.input", $input);
        exec("timeout 10s $executable < $path/$filename.input > $path/$filename.output 2>&1", $output, $ret);
        if ($ret == 0) {
            // means execute without error
            $output = file_get_contents("$path/$filename.output"); // get output
            $output = str_replace("\n", "<br>", $output);
            $returnArray["code"] = 0;
            $returnArray["msg"] = "";
            $returnArray["output"] = $output;
        }
        else {
            $returnArray["code"] = 1;
            $returnArray["msg"] = "Something went wrong, please try again.";
        }
    }
    else {
        $returnArray["code"] = 1;
        $returnArray["msg"] = "Something went wrong, please try again.";
    }

    // clear all temp file
    exec("rm -f $path/$filename"); // remove executable
    exec("rm -f $path/$filename.input"); // remove input text
    exec("rm -f $path/$filename.output"); // remove output text

    echo json_encode($returnArray);
 ?>

<?php
    $defaultLanguage = Array(
        "c++", "c", "java"
    );

    $compiler = Array(
        "c" => "clang",
        "c++" => "clang++"
    );

    $defaultStandard = Array(
        "c89", "c90", "c99", "c11",
        "c++98", "c++03", "c++11"
    );

    $defaultOptimize = Array(
        "-O0", "-O1", "-O2", "-O3"
    );

    $color = Array(
        "gcc" => "-diagnostics-color=always",
        "g++" => "-diagnostics-color=always",
        "clang" => "-fcolor-diagnostics",
        "clang++" => "-fcolor-diagnostics"
    );

    $pick = Array(
        "gcc" => "gcc",
        "g++" => "gcc",
        "clang" => "clang",
        "clang++" => "clang"
    );

    $shellCode2Color = Array(
        "gcc" => Array(
            "[01m[K"    => "bold",
            "[m[K"      => "clear",
            "[00;30m[K" => "black",
            "[00;31m[K" => "red",
            "[00;32m[K" => "green",
            "[00;33m[K" => "orange",
            "[00;34m[K" => "blue",
            "[00;35m[K" => "purple",
            "[00;36m[K" => "cyan",
            "[00;37m[K" => "light gray",
            "[01;30m[K" => "dark gray",
            "[01;31m[K" => "light red",
            "[01;32m[K" => "light green",
            "[01;33m[K" => "yellow",
            "[01;34m[K" => "light blue",
            "[01;35m[K" => "light purple",
            "[01;36m[K" => "light cyan",
            "[01;37m[K" => "white"
        ),
        "clang" => Array(
            "[1m"         => "bold",
            "[0m"         => "clear",
            "[0;0;30m"    => "black",
            "[0;0;31m"    => "red",
            "[0;0;32m"    => "green",
            "[0;0;33m"    => "orange",
            "[0;0;34m"    => "blue",
            "[0;0;35m"    => "purple",
            "[0;0;36m"    => "cyan",
            "[0;0;37m"    => "light gray",
            "[0;1;30m"    => "dark gray",
            "[0;1;31m"    => "light red",
            "[0;1;32m"    => "light green",
            "[0;1;33m"    => "yellow",
            "[0;1;34m"    => "light blue",
            "[0;1;35m"    => "light purple",
            "[0;1;36m"    => "light cyan",
            "[0;1;37m"    => "white"
        )
    );

    $color2Hex = Array(
        "bold"         => "bold",
        "black"        => "#010101",
        "red"          => "#de382b",
        "green"        => "#39b54a",
        "orange"       => "#ffc706",
        "blue"         => "#006fa4",
        "purple"       => "#762671",
        "cyan"         => "#2cb5e9",
        "light gray"   => "#cccccc",
        "dark gray"    => "#808080",
        "light red"    => "#ff0000",
        "light green"  => "#00ff00",
        "light yellow" => "#ffff00",
        "light blue"   => "#0000ff",
        "light purple" => "#ff00ff",
        "light cyan"   => "#00ffff",
        "white"        => "#ffffff"
    );

    function getVersion($compiler) {
        $returnVal = Array("ret" => NULL, "version" => NULL);

        $selectPick = $GLOBALS["pick"][$compiler];
        exec("$compiler --version | grep $selectPick", $output, $ret); // execute shell command
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

    function error($msg) {
        $returnVal = Array("code" => NULL, "msg" => NULL, "version" => NULL);
        $returnVal["code"] = 1;
        $returnVal["msg"] = $msg;
        $returnVal["version"] = "";
        return json_encode($returnVal);
    }
 ?>

<?php
    $defaultLanguage = Array(
        "c++", "c", "java"
    );

    $shellCode2Color = Array(
        "^[[01m^[[K"    => "bold",
        "^[[m^[[K"      => "clear",
        "^[[00;30m^[[K" => "black",
        "^[[00;31m^[[K" => "red",
        "^[[00;32m^[[K" => "green",
        "^[[00;33m^[[K" => "orange",
        "^[[00;34m^[[K" => "blue",
        "^[[00;35m^[[K" => "purple",
        "^[[00;36m^[[K" => "cyan",
        "^[[00;37m^[[K" => "light gray",
        "^[[01;30m^[[K" => "dark gray",
        "^[[01;31m^[[K" => "light red",
        "^[[01;32m^[[K" => "light green",
        "^[[01;33m^[[K" => "yellow",
        "^[[01;34m^[[K" => "light blue",
        "^[[01;35m^[[K" => "light purple",
        "^[[01;36m^[[K" => "light cyan",
        "^[[01;37m^[[K" => "white"
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

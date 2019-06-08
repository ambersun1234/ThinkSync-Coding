<?php
    //include('header.html');
    include('./include/head_line.inc.php');
    include('footer.html');
?>
<html>
<meta http-equiv="Content-Type" content="test/html; charset=utf-8" />
<meta http-equiv="Expires" content="Tue, 01 Jan 1980 1:00:00 GMT">
<meta http-equiv="Parama" content="no-cache">

<title>index</title>

<head>
    <meta charset="utf-8">
    <!-- include jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.6/angular.min.js"></script>
    <!--script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <!-- include Cycle plugin -->
    <script type="text/javascript" src="http://malsup.github.com/jquery.cycle.all.js"></script>

    <link rel="stylesheet" href="./codemirror-5.46.0/doc/docs.css">

    <link rel="stylesheet" href="./codemirror-5.46.0/lib/codemirror.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/3024-day.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/3024-night.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/abcdef.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/ambiance.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/base16-dark.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/bespin.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/base16-light.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/blackboard.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/cobalt.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/colorforth.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/dracula.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/duotone-dark.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/duotone-light.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/eclipse.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/elegant.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/erlang-dark.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/gruvbox-dark.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/hopscotch.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/icecoder.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/isotope.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/lesser-dark.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/liquibyte.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/lucario.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/material.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/mbo.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/mdn-like.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/midnight.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/monokai.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/neat.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/neo.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/night.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/nord.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/oceanic-next.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/panda-syntax.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/paraiso-dark.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/paraiso-light.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/pastel-on-dark.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/railscasts.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/rubyblue.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/seti.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/shadowfox.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/the-matrix.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/tomorrow-night-bright.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/tomorrow-night-eighties.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/ttcn.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/twilight.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/vibrant-ink.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/xq-dark.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/xq-light.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/yeti.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/idea.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/darcula.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/yonce.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/theme/zenburn.css">

    <link rel="stylesheet" href="./codemirror-5.46.0/lib/codemirror.css">
    <link rel="stylesheet" href="./codemirror-5.46.0/addon/hint/show-hint.css">

    <script src="./codemirror-5.46.0/lib/codemirror.js"></script>
    <script src="./codemirror-5.46.0/mode/javascript/javascript.js"></script>
    <script src="./codemirror-5.46.0/addon/selection/active-line.js"></script>
    <script src="./codemirror-5.46.0/addon/edit/matchbrackets.js"></script>
    <script src="./codemirror-5.46.0/lib/codemirror.js"></script>
    <script src="./codemirror-5.46.0/mode/clike/clike.js"></script>

    <script src="./codemirror-5.46.0/addon/edit/matchbrackets.js"></script>
    <script src="./codemirror-5.46.0/addon/hint/show-hint.js"></script>

    <script src="http://codemirror.net/mode/xml/xml.js"></script>
    <script src="https://rawgithub.com/angular-ui/ui-codemirror/bower/ui-codemirror.min.js"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata">

    <style>
        a{
            color: white;
            text-decoration: none;
        }
        a:link, a:visited, a:hover { color:white; }

        .CodeMirror {
            border: 1px solid #CCCCCC;
            font-size: 16px;
            height: 600px;
            width: 65.5%;
        }
        /*save button*/
        .saveButton {
          display: inline-block;
          padding: 2px 30px;
          font-size: 16px;
          cursor: pointer;
          text-align: center;
          text-decoration: none;
          outline: none;
          color: #fff;
          background-color: #7099e0;
          border: none;
          border-radius: 15px;
          /*box-shadow: 0 9px #999;*/
        }

        .saveButton:hover {background-color: #4f6c9e}

        .saveButton:active {
          background-color: #4f6c9e;
          transform: translateY(4px);
        }

        .runButton {
          display: inline-block;
          padding: 2px 30px;
          font-size: 16px;
          cursor: pointer;
          text-align: center;
          text-decoration: none;
          outline: none;
          color: #fff;
          background-color: #4CAF50;
          border: none;
          border-radius: 15px;
          /*box-shadow: 0 9px #999;*/
        }

        .runButton:hover {background-color: #3e8e41}

        .runButton:active {
          background-color: #3e8e41;
          transform: translateY(4px);
        }

        .compileButton {
          display: inline-block;
          padding: 2px 30px;
          font-size: 16px;
          cursor: pointer;
          text-align: center;
          text-decoration: none;
          outline: none;
          color: #fff;
          background-color: #add8e6;
          border: none;
          border-radius: 15px;
          /*box-shadow: 0 9px #999;*/
        }

        .compileButton:hover {background-color: #8aacb8}

        .compileButton:active {
          background-color: #8aacb8;
          transform: translateY(4px);
        }

        .saveasButton {
          display: inline-block;
          padding: 2px 30px;
          font-size: 16px;
          cursor: pointer;
          text-align: center;
          text-decoration: none;
          outline: none;
          color: #fff;
          background-color: #ffb529;
          border: none;
          border-radius: 15px;
          /*box-shadow: 0 9px #999;*/
        }

        .saveasButton:hover {background-color: #ffa700}

        .saveasButton:active {
          background-color: #ffa700;
          transform: translateY(4px);
        }

        .postButton {
          display: inline-block;
          padding: 2px 30px;
          font-size: 16px;
          cursor: pointer;
          text-align: center;
          text-decoration: none;
          outline: none;
          color: #fff;
          background-color: #ff9cd1;
          border: none;
          border-radius: 15px;
          /*box-shadow: 0 9px #999;*/
        }

        .postButton:hover {background-color: #ff7fc3}

        .postButton:active {
          background-color: #ff7fc3;
          transform: translateY(4px);
        }
        /*compile output*/
        .output{
            background: #555555;
            border: 1px solid #CCCCCC;
            font-size: 16px;
            height: 300px;
            width: 63.5%;
        }
        /*compile message*/
        .compileMsg{
            float: right;
            height: 600px;
            width: 28%;
            margin-right: 10px;
            background: #ffffff;
            border: 1px solid #CCCCCC;
        }
		/**/
		.compileInput{
			float: right;
			height: 300px;
			background: #ffffff;
			border: 1px solid #CCCCCC;
		}
    </style>
    <script>
    function download(){
        var text = editor.getValue();//document.getElementById("code").value;
        text = text.replace(/\n/g, "\r\n"); // To retain the Line breaks.
        var blob = new Blob([text], { type: "text/plain"});
        var anchor = document.createElement("a");

        //anchor.download = "my-filename.txt";
        var choosePL = document.getElementById("selectPL");
        programlanguage = choosePL.options[choosePL.selectedIndex].textContent;
        if(programlanguage == "C") {
            anchor.download = "my-code-by-thinksync.c";
        }
        else if (programlanguage == "C++"){
            anchor.download = "my-code-by-thinksync.cpp"
        }

        anchor.href = window.URL.createObjectURL(blob);
        anchor.target ="_blank";
        anchor.style.display = "none"; // just to be safe!
        document.body.appendChild(anchor);
        anchor.click();
        document.body.removeChild(anchor);
    }
    </script>
    <script>
        /*function postToPub() {

        }*/
    </script>
    <script>
    /*function postToPub() {
        var getcode = editor.getValue();
        window.location.href= "javascript:$.post('post.php', {code: 'getcode'})";
        /*$.post('post.php', {postcode: getcode}, function(data) {
            window.location.href = 'post.php';//$('#result').html(data);
        }).fail(function() {
            alert("ajax failed");
        });*/
        //
        /*$.ajax({
            data: getcode,
            url: 'post.php',
            method: 'POST', // or GET
            success: function(data) {
                var getcode = editor.getValue();
                alert(getcode);
                window.location.href= "javascript:$.post('post.php', {code: 'getcode'})";
                //window.location.href = 'post.php';
            },
            fail: function(msg) {
                alert("NO!" + msg);
            }
        });
    }*/
    /*function postToPub() {
        var getcode = editor.getValue();
        window.location.href= "javascript:$.post('post.php', {code: ".getcode."})";
    }*/
    /*
    function postToPub() {
        var getcode = editor.getValue();
        var sJson = JSON.stringify
        ({
            code: getcode
        });
        var obj = '[{"code":getcode}]';
        var stringify = JSON.parse(obj);
        alert(stringify[0]['code']);
        $.ajax({
            data: stringify,
            url: './post.php',
            method: 'POST', // or GET
            datatype: 'json',
            contentType: 'application/json; charset=UTF-8',
            success: function(data) {
                //alert(sJson[0]['code']);
                //var getcode = editor.getValue();
                //var code_package = $.ajax({code:getcode});
                //alert(getcode);
                window.location.href= "./post.php";
                //window.location.href = 'post.php';
            }
        });
    }*/
    </script>
</head>

<body>
    <div>
        <div style="margin:60px 45px 0px 45px; ">
            <p style="font-size:40px;height:40px;"><strong>ThinkSync.</strong></p>
        </div>
        <div style="margin:0px 45px 10px 45px;">
            Select program language
            <select onchange="selectPL()" id="selectPL">
                <option selected="">C</option>
                <option>C++</option>
                <!--<option>Java</option>-->
            </select>&nbsp;&nbsp;
            Select a theme:
            <select onchange="selectTheme()" id="select">
                <option selected="">default</option>
                <option>3024-day</option>
                <option>3024-night</option>
                <option>abcdef</option>
                <option>ambiance</option>
                <option>base16-dark</option>
                <option>base16-light</option>
                <option>bespin</option>
                <option>blackboard</option>
                <option>cobalt</option>
                <option>colorforth</option>
                <option>darcula</option>
                <option>dracula</option>
                <option>duotone-dark</option>
                <option>duotone-light</option>
                <option>eclipse</option>
                <option>elegant</option>
                <option>erlang-dark</option>
                <option>gruvbox-dark</option>
                <option>hopscotch</option>
                <option>icecoder</option>
                <option>idea</option>
                <option>isotope</option>
                <option>lesser-dark</option>
                <option>liquibyte</option>
                <option>lucario</option>
                <option>material</option>
                <option>mbo</option>
                <option>mdn-like</option>
                <option>midnight</option>
                <option>monokai</option>
                <option>neat</option>
                <option>neo</option>
                <option>night</option>
                <option>nord</option>
                <option>oceanic-next</option>
                <option>panda-syntax</option>
                <option>paraiso-dark</option>
                <option>paraiso-light</option>
                <option>pastel-on-dark</option>
                <option>railscasts</option>
                <option>rubyblue</option>
                <option>seti</option>
                <option>shadowfox</option>
                <option>the-matrix</option>
                <option>tomorrow-night-bright</option>
                <option>tomorrow-night-eighties</option>
                <option>ttcn</option>
                <option>twilight</option>
                <option>vibrant-ink</option>
                <option>xq-dark</option>
                <option>xq-light</option>
                <option>yeti</option>
                <option>yonce</option>
                <option>zenburn</option>
            </select>
            <br>
            <div style="padding: 10px 0px;">
                Select optimize option
                <select id="selectOptimize"><!--//onchange="selectPL()"-->
                    <option selected="selected">-O0</option>
                    <option>-O1</option>
                    <option>-O2</option>
                    <option>-O3</option>
                </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Select language standard
                <select id="selectStandard">
                    <option selected="selected">c89</option>
                    <option>c90</option>
                    <option>c99</option>
                    <option>c11</option>
                    <option>c++98</option>
                    <option>c++03</option>
                    <option>c++11</option>
                </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </div>
        </div>

        <!--div style="margin:10px 45px 10px 45px;">
            <input type="checkbox" name="-Wall" value="-Wall">Compile Wall&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="checkbox" name="-Werror" value="-Werror">Compile Werror
            &nbsp;&nbsp;&nbsp;&nbsp;

            <input class="saveasButton" type="button" name="saveas" value="save as file" style="margin-left:20px" onclick="download()">
            <input class="saveButton" type="button" name="save" value="save as private" style="margin-left:20px">
            <input class="runButton" type="button" name="run" value="run" style="margin-left:20px">
        </div-->
    </div>
    <!--/*compile message*/-->
    <div class="compileMsg" style="margin:72px 4% 0px 0px; padding: 5px 10px;">
        <form style="height:100%;margin:3%;width:100%;">
            <span id="compiler_version" name="compiler_version" style="height: 100%; width: 100%;">
            </span>
            <br><br><br>

            <span id="compile_msg" name="compile_msg" style="height: 100%; width: 100%;">
            </span>
        </form>

		<textarea class="compileInput" name="input" style="width:100%" col="50"></textarea>

	</div>
    <!--/*code area*/-->
    <div class="codearea" style="margin:0px 0px 0px 3%;">
        <form action="post.php" method="post"><br>
            <!-- <input type="checkbox" name="-Wall" value="-Wall">Compile Wall&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="checkbox" name="-Werror" value="-Werror">Compile Werror -->
            &nbsp;&nbsp;&nbsp;&nbsp;
            <input class="postButton" type="submit" id="postButton" name="post" value="post" style="margin-left:20px">
            <input class="saveasButton" type="button" name="saveas" value="save as file" style="margin-left:20px" onclick="download()">
            <input class="compileButton" type="button" name="compile" value="compile" style="margin-left:20px">
            <input class="runButton" type="button" name="run" value="run" style="margin-left:20px">
            <br><br>
            <textarea id="code" name="postcode" style="display: none;">
<?php echo "//test\n#inlcude <stdio.h>\n#include <stdlib.h>\n\nint add(int a, int b) {\n    return a+b;\n}\nint main() {\n   int a = 1, b = 2, c;\n   c = add(a, b);\n   printf(\"%d\", c);\n   return 0;\n}"; ?>
            </textarea>

        </form>
    </div>

    <script>
        //mdn-like nord

        var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
            lineNumbers: true,
            styleActiveLine: true,
            matchBrackets: true,
            tabSize: 4,
            mode: "text/x-csrc"
        });

        var choosePL = document.getElementById("selectPL");
        var input = document.getElementById("select");

        var theme = input.options[input.selectedIndex].textContent;
        var programlanguage = choosePL.options[choosePL.selectedIndex].textContent;

        //-----------------------------------------------------------
        function selectPL() {
            programlanguage = choosePL.options[choosePL.selectedIndex].textContent;
            var choice_lang = "clike";
            if(programlanguage == "C") {
                choice_lang = "text/x-csrc";
                editor.setOption("mode", choice_lang);
                editor.setValue("//test\n#inlcude <stdio.h>\n#include <stdlib.h>\n\nint add(int a, int b) {\n    return a+b;\n}\nint main() {\n   int a = 1, b = 2, c;\n   c = add(a, b);\n   printf(\"%d\", c);\n   return 0;\n}");
            }
            else if(programlanguage == "C++") {
                choice_lang = "text/x-c++src";
                editor.setOption("mode", choice_lang);
                editor.setValue("//test\n#inlcude <iostream>\n#include <sstring>\n\nusing namespase std;\n\nint add(int a, int b) {\n    return a+b;\n}\nint main() {\n   int a = 1, b = 2, c;\n   c = add(a, b);\n   cout << c << endl;\n   return 0;\n}");
            }
            else if(programlanguage == "Java") {
                choice_lang = "text/x-java";
                editor.setOption("mode", choice_lang);
                editor.setValue("/*test*/\nimport java.util.*;\nimport java.lang.*;\n\npublic class Main {\n    public static void main(String[] args)  {\n        int x = 5;\n        float y = 1.5;\n        System.out.println(\"x = \" + x + \", y = \" + y);\n    }\n}");
            }
            location.hash = "#" + programlanguage + "#" + theme;
        }

        //----------------------------------------------------------
        function selectTheme() {
            theme = input.options[input.selectedIndex].textContent;
            editor.setOption("theme", theme);
            location.hash = "#" + programlanguage + "#" + theme;//"#" + programlanguage +
        }

        //---------------------------------------------------------
        var choice = (location.hash && location.hash.slice(1)) ||
            (document.location.search &&
                decodeURIComponent(document.location.search.slice(1)));

        if (choice) {
            var substr = choice.split("#");

            choosePL.value = substr[0];
            input.value = substr[1];

            if(substr[0] == "Java") {
                editor.setOption("mode", "text/x-java");
            }
            else if(substr[0] == "C") {
                editor.setOption("mode", "text/x-csrc");
            }
            else if(substr[0] == "C++") {
                editor.setOption("mode", "text/x-c++src");
                editor.setOption("mode", "text/x-c++src");
            }
            editor.setOption("theme", substr[1]);
        }

        CodeMirror.on(window, "hashchange", function() {
            var str = location.hash.slice(1);
            var substr = str.split("#");
            if(substr[0]) {
                if(substr[0] == "Java") {
                    editor.setOption("mode", "text/x-java");
                }
                else if(substr[0] == "C") {
                    editor.setOption("mode", "text/x-csrc");
                }
                else if(substr[0] == "C++") {
                    editor.setOption("mode", "text/x-c++src");
                }
                choosePL.value = substr[0];
                selectPL();
            }
            if (substr[1]) {
                editor.setOption("theme", substr[1]);

                input.value = substr[1];
                selectTheme();
            }
        });
    </script>
    <script>
        $(document).ready(function(){
            function myFunc(){
                var input = $("#code").val();
                $("#code").text(input);
            }
            myFunc();

            //either this
            /*$("#code").keyup(function(){
                $("#code").html($(this).val());
            });*/

            //or this
            $("#code").keyup(function(){
                myFunc();
            });

            //and this for good measure
            $("#code").change(function(){
                myFunc(); //or direct assignment $('#txtHere').html($(this).val());
            });
        });
    </script>
    <script>
        /*var OtherItemValue;
          $('textarea#code').on('input change keyup', function () {
            if (this.value.length) {
                OtherItemValue = this.value;
            } else {
                OtherItemValue = "";
            }
          });*/
        // var choice = (location.hash && location.hash.slice(1)) ||
        //     (document.location.search &&
        //         decodeURIComponent(document.location.search.slice(1)));
        // var substr = choice.split("#");
        //alert(substr[0].toLowerCase() + "\n" + editor.getValue());

        var URLs="./compile.php";

        var data_code = {
            language: substr[0].toLowerCase(),
            code:editor.getValue()
        }

        $(".runButton").on("click", function() {
            var choosePL = document.getElementById("selectPL");
            var lang = choosePL.options[choosePL.selectedIndex].textContent.toLowerCase();

            var chooseOptimize = document.getElementById("selectOptimize");
            var optimize = chooseOptimize.options[chooseOptimize.selectedIndex].textContent;

            var chooseStandard = document.getElementById("selectStandard");
            var standard = chooseStandard.options[chooseStandard.selectedIndex].textContent;

            var jsonData = {
                "language": lang,
                "code": editor.getValue(),
                "flag": {
                    "optimize": optimize,
                    "standard": standard
                }
            };

            $.post("./compile.php", jsonData, function(data){
                if (data.msg == "<span style='font-weight: bold;'>No error.</span>") {
                    // which indicates that the code have no error
                    // send to execute.php to run program
                    var executable = data.path;
                    var input = $("textarea.compileInput").val();

                    $.post("./execute.php", {"executable": executable, "input": input}, function(data) {

                    });
                }
                else {
                    var now = new Date();
                    document.getElementById("compile_msg").innerHTML = data.msg;
                    document.getElementById("compiler_version").innerHTML = data.version + "<br><br>" + now;
                }
            }, "json");
        });

        $(".compileButton").on("click", function(){
            var choosePL = document.getElementById("selectPL");
            var lang = choosePL.options[choosePL.selectedIndex].textContent.toLowerCase();

            var chooseOptimize = document.getElementById("selectOptimize");
            var optimize = chooseOptimize.options[chooseOptimize.selectedIndex].textContent;

            var chooseStandard = document.getElementById("selectStandard");
            var standard = chooseStandard.options[chooseStandard.selectedIndex].textContent;

            var jsonData = {
                "language": lang,
                "code": editor.getValue(),
                "flag": {
                    "optimize": optimize,
                    "standard": standard
                }
            };

            $.post("./compile.php", jsonData, function(data){
                if (data.code != 0) {
                    alert(data.msg);
                }
                else {
                    var now = new Date();
                    document.getElementById("compile_msg").innerHTML = data.msg;
                    document.getElementById("compiler_version").innerHTML = data.version + "<br><br>" + now;
                }
            }, "json");
        });

        /*var URL_post="./post.php";
        var data_code_pots = {
            language: substr[0].toLowerCase(),
            code:editor.getValue()
        }
        $(".postButton").click(function(){
            $.post("./post.php", { "language": substr[0].toLowerCase(), "code":editor.getValue() }, function(data){
                alert(data.code);
                window.location.href = './post.php';
            }, "json").fail(function(){
                $("#code").text("出現錯誤").addClass("incorrect");
            });
        });*/
         /*$(document).ready(function(){
            //var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $(".postButton").click(function(){
                    $.ajax({
                        url: "./post.php",
                        type: 'POST',
                        data: editor.getValue(),
                        dataType: 'JSON',
                        success: function (data) {
                            alert(data);
                            window.location.href = "./post.php";
                        }
                    });
                });
        });*/

        /*$(document).ready(function(){
            $(".postButton").click(function(){
                $.post("post.php", getcode, function(data){
                    // Display the returned data in browser
                    //$("#result").html(data);
                    var getcode = editor.getValue();
                    window.location.href= "javascript:$.post('./post.php',{code:'getcode'})";//"./post.php";
                });
            });
        });*/
    </script>
    <script type="text/javascript">

        /*function sendToCompile(){


            //alert(data_code.language); //check
            /*$.ajax({
                type:"POST",
                url: URLs,
                //將表單的值設定好//url: URLs, data:$('textarea#code').val()
                data:{
                    "language": substr[0].toLowerCase(),
                    "code": editor.getValue()
                },//JSON.stringify(data_code),
                contentType: 'application/json',
                success: function(receive){
                    alert("-" + receive.code + "-" + receive.msg + "-" + receive.version + "-");
                },
                error:function(jqXHR, exception){
                    alert(jqXHR.status + " " + exception);
                }
            });*/
        /*}*/
    </script>
    <!--/*compile output*/-->
    <div class="output" style="margin:10px 0px 0px 3%;">
        <form>
            <textarea id="compile_output" name="compile_output" style="display: none;">

            </textarea>
        </form>
    </div>
    <br><br>

</body>
</html>

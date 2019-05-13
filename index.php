<?php
    include('header.html');
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
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
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
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata">
        
    <style>
        .w3-top{
            font-family: "Inconsolata", sans-serif;
            color : white;
            background: "#rgb(101, 152, 146)";
            position:fixed;
            top:0px;
            z-index: 7;
            height:50px;
        }
        a{
            color: white;
            text-decoration: none;
        }
        a:link, a:visited { color:white; }
        #id_footer {
            height: 40px;
            position: fixed;
            bottom: 0px;
            width: 100%;
            background: grey;
            z-index: 7;
            color: white;
        }
        .CodeMirror {
            border: 1px solid #CCCCCC;
            font-size: 16px;
            height: 300px;
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
            height: 610px;
            width: 28%;
            margin-right: 10px;
            background: #ffffff;
            border: 1px solid #CCCCCC;
        }
    </style>
</head>

<body>
    <div>
        <div style="margin:80px 10px 10px 10px;">
            Select program language
            <select onchange="selectPL()" id="selectPL">
                <option selected="">C</option>
                <option>C++</option>
                <!--<option>Java</option>-->
            </select>
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
        Select program language
            <select id="selectComFlag"><!--//onchange="selectPL()"-->
                <option selected="">-o1</option>
                <option>-o2</option>
                <option>-o3</option>
            </select>
        </div>
        
        <div style="margin:0px 0px 20px;">
            <input type="checkbox" name="-Wall" value="-Wall">Compile Wall
            <input type="checkbox" name="-Werror" value="-Werror">Compile Werror
            
            <input class="saveButton" type="button" name="save" value="save" style="margin-left:30px">
            &nbsp;&nbsp;&nbsp;&nbsp;
            <input class="runButton" type="button" name="run" value="run">
        </div>
    </div>
    <!--/*compile message*/-->
    <div class="compileMsg" style="margin:0px 3% 0px 0px;">
        <form>
            <textarea id="compile_msg" name="compile_msg" style="display: none;">

            </textarea>
        </form>
    </div>
    <!--/*code area*/-->
    <div class="codearea" style="margin:0px 0px 0px 3%;">
        <form>
            <textarea id="c-code" name="c-code" style="display: none;">
//test
#inlcude <stdio.h>
#include <stdlib.h>

int add(int a, int b) {
    return a+b;
}
int main() {
   int a = 1, b = 2, c;
   c = add(a, b);
   printf("%d", c);
   return 0;
}
            </textarea>
        </form>
    </div>
    
    <script>
        //mdn-like nord

        var editor = CodeMirror.fromTextArea(document.getElementById("c-code"), {
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
    <!--/*compile output*/-->
    <div class="output" style="margin:10px 0px 0px 3%;">
        <form>
            <textarea id="compile_output" name="compile_output" style="display: none;">
            
            </textarea>
        </form>
    </div>
    <footer id="id_footer" style="text-align:center;padding: 11px;">
        <a href="#">隱私權政策</a>&nbsp;&nbsp;&nbsp;&nbsp;聯絡人：u10506111
    </footer>
</body>
</html>


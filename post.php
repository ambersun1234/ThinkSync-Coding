<?php
    session_start();
    include_once("./include/head_line.inc.php");
    include_once("./include/db/configure.php");
    include_once("./include/commonFunction.php");

    checkLogin();

    if (isset($_POST["postcode"]) && !empty($_POST["postcode"])) {
        $code = getData($_POST['postcode']);
    }
    if (isset($_SESSION["uid"]) && !empty($_SESSION["uid"])) {
        $uid = $_SESSION["uid"];
    }

?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <title>Post</title>
        <style>
            table {
              margin-left: 30%;
              vertical-align: middle;
              margin: 100px auto;
              overflow-y: scroll;
              position: absolute;
              width: 800px;
            }
            h1 {
              font-family: "Inconsolata", sans-serif;
              color : white;
              background-color:black;
              margin-top: 100px;
              margin-left: 50px auto; 
              margin-right: auto;
              margin: 100px auto;
              text-align: center;
              width: 950px;
            }
            .cont {
                height: 200px;
                width: 450px;
                position: absolute;     /*絕對位置*/
                top: 0%;
                left: 20%; 
                margin-left: auto; 
                margin-right: auto;

            }
        </style>
        <style>
            .rating {
              display: inline-block;
              position: relative;
              bottom: 500px;
              top: 10px;
              left : 0px;
              height: 25px;
              width: 400px;
              line-height: 25px;
              font-size: 25px;
            }

            .rating label {
              position: absolute;
              bottom: 500px;
              top: 0;
              left: 10px;
              height: 0;
              cursor: pointer;
            }

            .rating label:last-child {
              position: absolute;
            }

            .rating label:nth-child(1) {
              z-index: 5;
            }

            .rating label:nth-child(2) {
              z-index: 4;
            }

            .rating label:nth-child(3) {
              z-index: 3;
            }

            .rating label:nth-child(4) {
              z-index: 2;
            }

            .rating label:nth-child(5) {
              z-index: 1;
            }

            .rating label input {
              position: absolute;
              top: 0px;
              left: 10%;
              opacity: 0;
            }

            .rating label .icon {
              float: center;
              color: transparent;
            }

            .rating label:last-child .icon {
              color: #dddddd;
            }

            .rating:not(:hover) label input:checked ~ .icon,
            .rating:hover label:hover input ~ .icon {
              color: #ffdd6b;
            }

            .rating label input:focus:not(:checked) ~ .icon:last-child {
              color: #dddddd;
              text-shadow: 0 0 5px #ffdd6b;
            }
        </style>
        <script>$(':radio').change(function() {
              console.log('New star rating: ' + this.value);
            });
        </script>
    </head>
    <body>
        <div class = "cont"> <!-- style="text-align: center;"-->
        <?php //include("startest.php");?>
        <h1>Post the Article !</h1>
            <?php
                //include("startest.php");
            ?>
        <form action="post_function.php" method="post" Enctype="multipart/form-data" style="margin-top:-180px;margin-left: 30%;">
            <table style="vertical-align: middle;">
				<tr style="vertical-align: middle;margin-left: 35%;">
					<td style="vertical-align: middle;">Title：</td>
					<?php if(isset($title)){ ?>
						<td style="vertical-align: middle;"><input style="width:510px;height:40px;text-align: center;" type="text" name="title" 
							value="<?=htmlspecialchars($title)?>" /></td>
					<?php }else{ ?>
						<td style="vertical-align: middle;"><input style="width:510px;height:40px;text-align: left;" type="text" name="title" /></td>
					<?php } ?>
				</tr>
                <tr>
                    <td><br>Validate：</td>
                    <td>
                        <br>&nbsp;
                            <input type="radio" name="category" value="private"/>&nbsp;&nbsp;private
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="category" value="public"/>&nbsp;&nbsp;public
                        <br>
                    </td>
                </tr>
                <tr>
                    <td><br>Language：</td>
                    <td>
                        <br>&nbsp;
                            <input type="radio" name="lang" value="c"/>&nbsp;&nbsp;C
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="lang" value="cpp"/>&nbsp;&nbsp;C++
                        <br>
                    </td>
                </tr>
                <tr>
                    <td><br>Difficuty：</td>
                    <td>
                      <div class = "rating">
                          <label>
                            <input type="radio" name="stars" value="1" />
                            <span class="icon">★</span>
                          </label>
                          <label>
                            <input type="radio" name="stars" value="2" />
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                          </label>
                          <label>
                            <input type="radio" name="stars" value="3" />
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>   
                          </label>
                          <label>
                            <input type="radio" name="stars" value="4" />
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                          </label>
                          <label>
                            <input type="radio" name="stars" value="5" />
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                          </label>
                        </div>
                    </td>
                </tr>
				<tr>
					<td>Content：</td>
					<td><br><textarea name="content" rows="5" cols="65" style="text-align: left;"><?php 
						if(isset($content)){
							echo $content;
						}
					?></textarea><br>
					</td>
              </tr>
              
               <tr>
					<td>Code：</td>
					<td><br><textarea name="code" rows="15" cols="65" style="text-align: left;"><?php 
						if(isset($code)){
							echo $code;
						}
					?></textarea><br><br>
					</td>
				</tr>
				<tr>
					<td colspan="2" style = "text-align: center;"> 
                        <br>
                        <input type="button" value="not now" style="width:120px;height:40px;border:2px blue none;color:#fff;background: #898989;position:absolute;right:220px; " onclick = "CheckNot()">
						<input name = "ensure" type="submit" value="submit" style="width:120px;height:40px;border:2px blue none;color:#fff;background: #000;position:absolute;right:60px;" onclick="return CheckFunc();">
						
					</td>
				</tr>
			</table>
        </form>
        </div>
    </body>
</html>
<script>
    function CheckNot() {
        if(confirm("When you leave this page the content all you type will disappear, do you want to leave?")){
            window.location.href="./index_new.php#C#default"; 
        } 
    }
    function CheckFunc() {
        msg = "";
        if(document.forms[0].title.value == "") msg = "請輸入標題";
        else if(document.forms[0].category.value == "") msg = "請選擇公開或隱藏";
        else if(document.forms[0].stars.value == "") msg = "請評分難度";
        else if(document.forms[0].content.value == "") msg = "請輸入內文";
        else if(document.forms[0].code.value == "") msg = "請輸入程式";
        else return true;
        alert(msg);
        return false;
    }
</script>
<?php session_start(); ?>
<?php
    //include("like_dislike.php");
    include_once("./include/head_line.inc.php");
    include_once("./include/db/configure.php");
    include_once("./include/db/db_func.php");
    include_once("./include/commonFunction.php");
    echo "<br><br><br><br><br>";
    include_once("userRating.php");
    include_once("./include/mysql_connect.inc.php");
    
    $db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);
?>

<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js" type="text/javascript"></script>
        <!--script type="text/javascript" src="jquery"></script>
        <script type="text/javascript" src="jquery-3.3.1.min.js"></script-->
        <script type="text/javascript" src="jquery.cycle.all.js"></script>
        <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <link rel="stylesheet" type="text/css" href="prism.css">
        <!--link rel="stylesheet" type="text/css" href="main.css"-->
        <link rel="stylesheet" type="text/css" href="prism.css">
        
        <script type="text/javascript" src="prism.js"></script>

        <style>
            .out {
                position: static;
                float: center;
            }
            body,
            html {
                height: 100%;
                font-family: "Inconsolata", sans-serif;
                color: black;
                background: "#rgb(207, 223, 226)";
            }
            .td {
                width: 50px;
            }
            table {
                height: 10%;
                left: 50%;
                position: static;
                width: 880px;
                border-top: 3px #333333 solid;
                border-bottom: 3px #333333 solid;
                border-left: 3px #EEE solid;
                border-right: 3px #EEE solid;
                border-collapse: collapse;
                border-spacing: 0;
            }
            thead th {
                background: #555555;
                width: 880px;
                color: #FFF;
                font-family: 'Lato', font-family:DFKai-sb;
                font-size: 16px;
                text-align: left;
                font-weight: 100;
                letter-spacing: 2px;
                text-transform: uppercase;
            }
            tr {
                color: #333333;
                background: #fff; /*#e1eaf4*/
                /*border-collapse: collapse;*/
                width: 880px;
                margin-bottom: 5px;
            }
            th,
            td {
                font-family: 'Lato', serif;
                font-style: style="font-family:DFKai-sb";
                font-weight: 400;
                width: 880px;
                padding: 10px;
                text-align: left;
                padding: 8px;
                color:#333333;
                border-bottom: 1px solid #ddd;
            }
            /*第一欄第一列：左上*/
            tr:first-child td:first-child th:first-child thead:first-child{
              border-top-left-radius: 10px;
            }
            /*第一欄最後列：左下*/
            tr:last-child td:first-child th:first-child thead:first-child{
              border-bottom-left-radius: 10px;
            }
            /*最後欄第一列：右上*/
            tr:first-child td:last-child th:last-child thead:last-child{
              border-top-right-radius: 10px;
            }
            /*最後欄第一列：右下*/
            tr:last-child td:last-child th:last-child thead:last-child{
              border-bottom-right-radius: 10px;
            }
            a {
                outline: none;
                text-decoration: none;
            }
            select {
                width: 150px;
                padding: 10px 10px;
                border: none;
                float: left;
                border-radius: 10px;
                margin: 2px;
                color: #fff;
                background-color: #333333;
            }
            #Sidebar {
                width: 0px;
                float: left;
                height: 100%;
                text-align: center;
                line-height: 280px;
                font-size: 15px;
                color: #ffffff;
                font-weight: lighter;
            }
            #Sidebar_right{
                width:120px;
                height:400px;
                right:50%;
                text-align:center;
                line-height:400px;
                float:right;
            }
            #header{
                height:80px;
                text-align:right;
                float:right;
                top:10%;
                right:5%;
                position:absolute;
            }
            .rating {
              display: inline-block;
              position: relative;
              bottom: 500px;
              top: 10px;
              left : 650px;
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
            #all {
                background: #fff;
            }
        </style>
    </head>

    <body id="all">
        <?php
        //種類選擇
        //echo $_GET['kind']."<br>";
        //echo $_SESSION['Category']."<br>";
        if(!isset($_GET['kind']) && isset($_SESSION['Category'])) {
            if($_SESSION['Category'] == 'c') {
                $sql3 = "SELECT * FROM tsc_post WHERE tsc_post.Category = '0' AND tsc_post.Permisseion = '0' AND Valid = '0'";
            }
            else if($_SESSION['Category'] == 'cpp') {
                $sql3 = "SELECT * FROM tsc_post WHERE tsc_post.Category = '1' AND tsc_post.Permission = '0' AND Valid = '0'";
            }
            else { 
                $sql3 = "SELECT * FROM tsc_post WHERE tsc_post.Permission = '0' AND Valid = '0'";
            }
        }
        else {
            if($_GET['kind'] == 'c') {
                $sql3 = "SELECT * FROM tsc_post WHERE tsc_post.Category = '0' AND tsc_post.Permission = '0' AND Valid = '0'";
            }
            else if($_GET['kind'] == 'cpp') {
                $sql3 = "SELECT * FROM tsc_post WHERE tsc_post.Category = '1' AND tsc_post.Permission = '0' AND Valid = '0'";
            }
            else {
                $sql3 = "SELECT * FROM tsc_post WHERE tsc_post.Permission = '0' AND Valid = '0'";
            }
            $_SESSION['Category'] = $_GET['kind'];
        }
        //結束 種類選擇
        ?>

        <?php 
        //echo $_GET['OrderBy']."<br>";
        //echo $_SESSION['OrderBy']."<br>";
        //排序選擇
        if(!isset($_GET['OrderBy']) && isset($_SESSION['OrderBy'])) {
            if($_SESSION['OrderBy'] == 'TimeOld') {
                $sql3 .= " ORDER BY Date";
            }
            else if($_SESSION['OrderBy'] == 'RatingHigh' ) {
                $sql3 .= " ORDER BY Stars DESC, Date DESC";
            }
            else if($_SESSION['OrderBy'] == 'RatingLow') {     
                $sql3 .= " ORDER BY Stars, Date DESC";
            }
            else {
                $sql3 .= " ORDER BY Date DESC";
                $_SESSION['OrderBy'] = 'TimeNew';
            }
        }
        else {
            if (empty($_GET['OrderBy'])) {
                $sql3 .= " ORDER BY Date DESC";
                $_SESSION['OrderBy'] = 'TimeNew';
                $_GET['OrderBy'] = 'TimeNew';
            }
            else if($_GET['OrderBy'] == 'TimeOld') {
                $sql3 .= " ORDER BY Date";
                $_SESSION['OrderBy'] = $_GET['OrderBy'];
            }
            else if($_GET['OrderBy'] == 'RatingHigh' ) {
                $sql3 .= " ORDER BY Stars DESC, Date DESC";
                $_SESSION['OrderBy'] = $_GET['OrderBy'];
            }
            else if($_GET['OrderBy'] == 'RatingLow') {  
                $sql3 .= " ORDER BY Stars, Date DESC";
                $_SESSION['OrderBy'] = $_GET['OrderBy'];
            }
            else if($_GET['OrderBy'] == 'TimeNew'){
                $sql3 .= " ORDER BY Date DESC";
                $_SESSION['OrderBy'] = 'TimeNew';
            }
        }
        //echo $sql3."<br>";
        //echo $_GET['OrderBy']."<br>";
        //echo $_SESSION['OrderBy']."<br>";
        //結束 排序選擇
        ?>
            <div id="header">
                <?php if(!isset($_GET['PostIndex'])) {?>
                    <form action='searchKeyword.php' method='POST' style="margin-left: 20px;text-align:left;display:inline;">
                        <input type="text" name="keyword" placeholder=" Key word" style="margin-top: 5px;padding: 3px 3px;">
                        <input type="submit" value="search" style="margin-top: 5px;padding: 3px 3px;">
                    </form>
                    <form class='custom' action='' method='GET' style="text-align:center;display:inline;">
                        <Select name='kind' onchange="submit();" id="kind">
                            <option value='All'<?php if($_SESSION['Category']=='All') echo 'selected'; ?>>All</option>
                            <option value='c'<?php if($_SESSION['Category']=='c') echo 'selected'; ?>>C</option>
                            <option value='cpp'<?php if($_SESSION['Category']=='cpp') echo 'selected'; ?>>C++</option>
                        </Select>
                        <Select name='OrderBy' onchange="submit();" id="OrderBy" style="margin-left: 20px;">
                            <option value = 'TimeNew' <?php if($_SESSION['OrderBy'] == 'TimeNew') echo 'selected'; ?>>New -> Old</option>
                            <option value = 'TimeOld' <?php if($_SESSION['OrderBy'] == 'TimeOld') echo 'selected'; ?>>Old -> New</option>
                            <option value = 'RatingHigh' <?php if($_SESSION['OrderBy'] == 'RatingHigh') echo 'selected'; ?>>Hard -> Easy</option>
                            <option value = 'RatingLow' <?php if($_SESSION['OrderBy'] == 'RatingLow') echo 'selected'; ?>>Easy -> Hard</option>
                        </Select>
                    </form>
                <?php }?>
            </div>

        <div class="out"><br><br>
        <?php 
        $ret = querydb($sql3, $db_conn);
        $count = count($ret);
            
        $per = 3;
        $pages = ceil($count/$per);
        if(!isset($_GET['page'])) {
            $page = 1;
        }
        else {
            $page = intval($_GET['page']);
        }
        $start = ($page-1)*$per;
        
        $sql4 = $sql3.' LIMIT '.$start.', '.$per;
        
        //echo $sql4;
            
        if(isset($_GET['PostIndex'])) {
            $sql4 = "SELECT * FROM tsc_post WHERE PostIndex = ".$_GET['PostIndex']." AND Valid = '0' AND Permission = '0'";
            $count = 1;
            $pages = 1;
        }
        //echo "<script>console.log(".$sql4.")</script>";  
        $list = array();
        $list = $db_conn->query($sql4);
        try {
            foreach($db_conn->query($sql4) as $k => $v){ ?>
            <div class="container">
                <div class="CSSTableGenerator">
                    <table align="center" style="width:880px;">
                        <thead>
                            <th colspan="2" style="text-align: left;">
                                <h5 style="text-align: left;color:#fcdd5c;">
                                    <font style="color:#fff;left:0px;right:880px;position:relative;">
                                    &nbsp;&nbsp;<a href=view_article.php?PostIndex=<?php echo $v['PostIndex'];?> target="_blank" style="text-decoration:none;"><?php echo $v['Title']?></a></font>
                                    <font style="font-size:120%;">&nbsp;&nbsp;&nbsp;&nbsp;★</font>
                                    <span id = 'rating_<?php echo $v['PostIndex'] ?>'>
                                    <?php echo getRatingOfStar($v['PostIndex']); ?>&nbsp;&nbsp;
                                    </span>

                                    <span id = 'people_<?php echo $v['PostIndex'] ?>'>
                                    <?php echo "(".getPeopleNumber($v['PostIndex']).")"; ?>&nbsp;&nbsp;
                                    </span>
                                </h5>
                                <?php if(!empty($_SESSION['uid'])) {?>
                                  <h6>
                                    <div class="rating rating1" data-id="<?php echo $v['PostIndex']; ?>">
                                        <input type="hidden" name="postIndex" value="<?php echo $v['PostIndex']; ?>">

                                        <label>
                                            <input type="radio" name="stars" value="1"  data-id="<?php echo $v['PostIndex']; ?>"/>
                                            <span class="icon">★</span>
                                        </label>
                                        <label>
                                            <input type="radio" name="stars" value="2"  data-id="<?php echo $v['PostIndex']; ?>"/>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                        </label>
                                        <label>
                                            <input type="radio" name="stars" value="3"  data-id="<?php echo $v['PostIndex']; ?>"/>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>   
                                        </label>
                                        <label>
                                            <input type="radio" name="stars" value="4"  data-id="<?php echo $v['PostIndex']; ?>"/>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                        </label>
                                        <label>
                                            <input type="radio" name="stars" value="5"  data-id="<?php echo $v['PostIndex']; ?>"/>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                             &nbsp;
                                        </label>

                                    </div>
                                  </h6>
                                <?php } else {echo "<br>";}?>
                            </th>
                        </thead>
                        <tr>
                            <td colspan="2" style="text-align: left;border-left: 1px solid #ddd;border-right: 1px solid #ddd;"><!--Username-->
                                <?php
                                    //$db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);
                                    $userid = $v['UserIndex'];
                                    $sql_getUsername = "SELECT * FROM tsc_account WHERE UserIndex = '$userid'";
                                    $ret_getUsername = querydb($sql_getUsername, $db_conn);
                                    echo "<h5 style='text-align:left;'>Post By : ".nl2br($ret_getUsername[0]['Username'])."</h5>";
                                ?>
                                <?php
                                    $date_post = $v['Date'];
                                    echo "<div style='text-align:right;color:#aaa;width:100%;'>$date_post</div>";
                                ?>
                            </td>
                            
                        </tr>
                        <tr>
                            <td style="width:10%;border-left: 1px solid #ddd;">
                                <?php
                                    $date_post = $v['Date'];
                                    if($v['Category'] == 0) echo "<div style='background-color:#555;color:#fff;border-radius: 10px;text-align:center;width:50px;'>C</div>";
                                    else if($v['Category'] == 1) echo "<div style='background-color:#555;color:#fff;border-radius: 10px;text-align:center;width:50px;'>C++</div>";
                                ?>
                            </td>
                            <td style="width:90%;border-right: 1px solid #ddd;">
                                <?php echo "<div style='text-align:left;'>".nl2br($v['PostContent'])."</div>";?>
                            </td>
                        </tr>
                        <tr>
                            <td style="border-left: 1px solid #ddd;"></td>
                            <td style="border-right: 1px solid #ddd;">
                                <?php
                                    
                                    $db_conn2 = connect2db($dbhost, $dbuser, $dbpwd, $dbname);
                                    $codeid = $v['CodeIndex'];
                                    $sql_getCode = "SELECT * FROM tsc_code WHERE CodeIndex = '$codeid'";
                                    $ret_getCode = querydb($sql_getCode, $db_conn2);
                                    //echo "<pre><div style='text-align:left;'>".$ret_getCode[0]['CodeContent']."</div><pre>";
                                    $ret_getCode = str_replace("......", "'",$ret_getCode[0]['CodeContent']);
                                    $ret_getCode = str_replace("@@@@@@", "\r\n", $ret_getCode);
									$ret_getCode = str_replace("++++++", "\\n",$ret_getCode);
                                    
                                ?>
                                <figure class="ce ce-lift ce-twist"><!--figcaption class="ce_caption">CODE CAPTION</figcaption--><pre class="line-number" ><code spellcheck="false" class="language-clike" style="display:inline-block;width:880px;"><?php echo $ret_getCode;?></code></pre></figure>
                            </td>
                        </tr>
                        <?php if(empty($_SESSION['uid'])) { ?>
                        <tr>
                            <td colspan="2" style="border-left: 1px solid #ddd;border-right: 1px solid #ddd;">
                                <?php echo "<a href = 'login.php'><h6 style = 'color:#f86a6a;display:inline;text-align:center;width:100%;'>Login for leave your comment！</h6></a>"; ?>
                            </td>
                        </tr>
                        <?php }?>
                        <tr>
                            <th colspan="2" style="text-align: left;border-left: 1px solid #ddd;border-right: 1px solid #ddd;">
                            <?php
                                $require = "SELECT * FROM tsc_comment WHERE Valid = '0' ORDER BY Time DESC";
                                $ret = querydb($require, $db_conn);
                                $acc = 0;

                                foreach($ret as $c){
                                    if($v['PostIndex'] == $c['PostIndex']) {
                                        $userIDSql = "SELECT * FROM tsc_account WHERE UserIndex = ".$c['UserIndex']." AND Valid = '0'";
                                        $arr = querydb($userIDSql, $db_conn);
                                        $uesrID = $arr[0]['Username'];
                                        echo "<h6 style='text-align:left;background-color:#fff;color:#333333;border:2px #bfbfbf solid;border-radius: 10px;padding :10px;height:80px;'>";
                                        echo $arr[0]['Username']." : ".nl2br($c['CommentContent']);
                                        echo "<p style='text-align:right;color:#BBB;'>";
                                        echo $c['Time']."</p>"."</h6>";
                                        $acc++;?>
                                        <div style="width: 450px;" id = "replyBlock">
                                            <?php
                                            $rs = "SELECT * FROM tsc_reply WHERE Valid = '0' AND tsc_reply.CommentIndex = '".$c['CommentIndex']."'  ORDER BY tsc_reply.Time";
                                                //echo $rs;
                                            $r = querydb($rs, $db_conn);
                                            if(count($r) > 0) {
                                                $cc = 0;
                                                foreach ($r as $eachReply) {
                                                    $cc++;
                                                    $rUI = $eachReply['UserIndex'];
                                                    $rDate = $eachReply['Time'];
                                                    $rData = $eachReply['ReplyContent'];
                                                    $userIDSql = "SELECT * FROM tsc_account WHERE Valid = '0' AND UserIndex = ".$rUI;
                                                    $arr = querydb($userIDSql, $db_conn);
                                                    $uesrID = $arr[0]['Username'];
                                                    echo "<h6 style='text-align:left;background-color:#EEE;color:#333333;border-radius: 10px;padding :10px ; clear: right;height:80px;'>";
                                                    echo $uesrID." : ".$rData."<br>";
                                                    echo "<p style='text-align:right;color:#888; '>";
                                                    echo $rDate."</p>"."</h6>";
                                                }
                                            ?>
                                        </div>
                                        <?php if(isset($_SESSION['uid'])) {?>
                                            <form>
                                                <input type="text" name="commentReply" id="<?php echo "commentReply_".$c['CommentIndex']; ?>"
                                                          style="width:450px;height:40px;background-color:#666;color:#FFF;padding:20px;border:0px blue none; text-align: left; display: none;border-radius:5px;" placeholder="  Enter your reply！">
                                                <input type="button" name="replyButton" id="<?php echo "replyButton_".$c['CommentIndex']; ?>"
                                                       value="Reply"  data-id="<?php echo $c['CommentIndex']; ?>" class="reply"
                                                       style="width:60px;height:30px;border:0px blue none;color:#fff;background: #a4b0c6;position:relative;float: right;">
                                                <input type="button" name="trueReplyButton" id="<?php echo "trueReplyButton_".$c['CommentIndex']; ?>" data-id="<?php echo $c['CommentIndex']; ?>" class="trueReply"
                                                       value="Reply" 
                                                       style="width:60px;height:30px;border:0px blue none;color:#fff;background: #a4b0c6;position:relative;float: right;">
                                                <br><br>
                                            </form>
                                        <?php }?>
                                    <?php } ?>
                                <?php }
                                }
                                if($acc == 0) echo "<p style='text-align: center;color:#AAAAAA;'>"."======== No comment Now！========"."</p>";
                            ?>
                            </th>
                        </tr>
                        <?php if(!empty($_SESSION["uid"])) { ?>
                        <tr>
                            <th colspan="2" style="text-align: right;border-left: 1px solid #ddd;border-right: 1px solid #ddd;">
                                <form>
                                    <input type="text" style="background-color:#666;width:450px;height:40px;color:#FFF;padding:20px;border:0px blue none; text-align: left;border-radius:5px;" name="comment" id="<?php echo "comment".$v["PostIndex"]; ?>" placeholder="  Enter your comment！" />&nbsp;&nbsp;&nbsp;
                                    <input type="hidden" name="post_id" id="<?php echo "post_id".$v["PostIndex"]; ?>" value='<?php echo $v["PostIndex"]?>' />
                                    <input type="hidden" name="myid" id="<?php echo "myid".$v["PostIndex"]; ?>" value='<?php echo $_SESSION["uid"] ?>' />
                                    <input type="submit" name="submit" id="<?php echo "commentButton".$v["PostIndex"]; ?>" class="commentButton" data-id="<?php echo $v['PostIndex']; ?>" value="Comment" style="width:100px;height:40px;border:0px blue none;color:#fff;background: #a4b0c6;position:relative;right:0px;" />
                                </form>
                            </th>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
            <?php
               echo "<br>";
            }
            echo "<br>";
        }
        catch(PDOException $e){
        }
        ?>
        </div>
        <footer style="background-color:#555555; padding:10;text-align:center;">
            <div style="text-align:center;">
            <?php
            echo "<a href=?page=1&kind=".$_SESSION['Category']."&OrderBy=".$_SESSION['OrderBy']." style='color:#a6aed0'><font size='+1'>1...&nbsp;</font></a>";
            for($i = 1; $i <= $pages; $i++) {
                if($i == $page) {
                    echo "<a href=?page=".$i."&kind=".$_SESSION['Category']."&OrderBy=".$_SESSION['OrderBy']."><font size='+4' color=#ffa5c8>&nbsp;".$i."&nbsp;</font></a>";
                }
                else if($page-2 < $i && $i < $page + 2) {
                    if($i < $page) echo "<a href=?page=".$i."&kind=".$_SESSION['Category']."&OrderBy=".$_SESSION['OrderBy']."><font color=#aec1e3 size='+2'><strong>&nbsp;<&nbsp;</strong></font></a>";
                    if($i > $page) echo "<a href=?page=".$i."&kind=".$_SESSION['Category']."&OrderBy=".$_SESSION['OrderBy']."><font color=#a7bbe0 size='+2'><strong>&nbsp;>&nbsp;</strong></font></a>";
                }
            }
            echo "<a href=?page=".$pages."&kind=".$_SESSION['Category']."&OrderBy=".$_SESSION['OrderBy']." style='color:#a6aed0' >&nbsp;<font size='+1'>...$pages</font></a>";
            echo "<p style='color:#c7c7c7;'>Total: <font color=#f07e7e>".$count."</font> article(s)</p>";
        ?>
            </div>
        </footer>
    </body>
</html>

<script>
    $(':radio').change(function() {
        console.log('New star rating: ' + this.value);
    });
</script>
<script>
    $(':radio').on('click', function() {
        stars = this.value;
        var postIndex = $(this).attr('data-id');
        console.log('New star rating: ' + stars);
        $.ajax({
            url: 'userRating.php',
            type: 'POST',
            data: {
                'stars': stars,
                'PostIndex': postIndex,
                'ID': "<?php echo $_SESSION['uid']; ?>"
            },
            success: function(data) {
                var obj = jQuery.parseJSON (data);
                alert("You give " + stars + " stars.");
                $('#rating_'+postIndex).text(obj.rating);
                $('#people_'+postIndex).text("("+obj.people+")");
            }
        })
    });
    
    $('.reply').on('click', function() {
        var commentIndex = $(this).attr('data-id');
        var replyData = $('#commentReply_'+commentIndex).val();
        $('#commentReply_' + commentIndex).show();
        $('#replyButton_' + commentIndex).hide();
        $('#trueReplyButton_' + commentIndex).show();
    });
    $('.trueReply').on('click', function() {
        var commentIndex = $(this).attr('data-id');
        var replyData = $('#commentReply_'+commentIndex).val();
        $.ajax({
            url: 'comment_reply.php',
            type: 'POST',
            data: {
                'commentIndex': commentIndex,
                'ID': "<?php echo $_SESSION['uid']; ?>",
                'text': replyData
            },
            success: function(data) {
                //var callback = JSON.stringify(data.sql);
                alert("回覆成功\n" + data.sql);
                history.go(0);
                $('#commentReply_' + commentIndex).hide();
                $('#replyButton_' + commentIndex).show();
                $('#trueReplyButton_' + commentIndex).hide();
            }
        })
    });
    
    $('.commentButton').click(function() {
        var postIndex = $(this).attr('data-id');
        //comment, post_id, myid
        var comment = $('#comment' + postIndex).val();
        var post_id = $('#post_id' + postIndex).val();
        var myid = $('#myid' + postIndex).val();
    
        $.ajax({
            url: 'comment_function.php',
            type: 'POST',
            data: {
                'comment': comment,
                'post_id': post_id,
                'myid': myid
            },
            success: function(data) {
                alert("留言成功");
                window.location.reload();
            }
        });
    });
</script>

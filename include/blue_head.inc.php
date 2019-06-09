<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
    include('mysql_connect.inc.php');
    //if(!empty($_SESSION['admin'])) include("head_admin.inc.php");
?>
<html>
    <head>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata">
        <style>
            body, html {
                height: 100%;
                font-family: "Inconsolata", sans-serif;
                color : black;
                background: "#rgb(207, 223, 226)";
            }
            form {
                font-family: "Inconsolata", sans-serif;
                color : black;
                background: "#rgb(101, 152, 146)";
                position:absolute;
                top:80px;
                left:100px;
            }
        </style>
    </head>
    <body>
        <div class="w3-top" style="background-color: #30495f;color:#fff;">
            <div class="w3-row w3-padding">

                <div class="w3-col s1">
                    <a href="Top.php#home" class="w3-button w3-block scroll">HOME</a>
                </div>
                <div class="w3-col s1">
                    <a href="Top.php#about" class="w3-button w3-block scroll">ABOUT</a>
                </div>
                <div class="w3-col s1">
                    <a href="Top.php#menu" class="w3-button w3-block scroll">COMMENT</a>
                </div>
                <div class="w3-col s1">
                    <a href="Top.php#where" class="w3-button w3-block scroll">WHERE</a>
                </div>
                <div class="w3-col s1">
                    <a href="Top.php#contact" class="w3-button w3-block scroll">CONTACT</a>
                </div>
                <div class="w3-col s1">
                    <a href="view_article.php?kind=All&OrderBy=TimeNew" class="w3-button w3-block scroll">ARTICLE</a>
                </div>
                <div class="w3-col s1">
                    <a href="prizeTest.php" class="w3-button w3-block scroll">LOTTERY</a>
                </div>
                <?php if(empty($_SESSION['ID'])) {?>
                <div id="pic" class="w3-right w3-hide-small">
                    <a href="./index.php" class="w3-bar-item w3-button">LOGIN</a>
                    <a href="./register.php" class="w3-bar-item w3-button">SIGNUP</a>
                </div>
                <?php }?>
                <?php if(!empty($_SESSION['ID'])) {?>
                <div id="pic" class="w3-right w3-hide-small">
                    <?php
                        $ID = $_SESSION['ID'];
                        $sql = "SELECT * FROM user WHERE '$ID' = user.ID";
                        $r = mysqli_query($conn, $sql);
                        $result =  mysqli_fetch_array($r);
                        echo "<font class='w3-bar-item' style='position:center;padding:0px 5px;'align='center' valign='center' face='Inconsolata' size='3'>Hi! ".$result['Fname']."!&nbsp;&nbsp;&nbsp;&nbsp;</font>";
                    ?>
                    <a href="./logout.php" class="w3-bar-item w3-button">LOGOUT</a>
                    <a href="./post.php" class="w3-bar-item w3-button">POST</a>
                    <a href="./update.php" class="w3-bar-item w3-button">USER CENTER</a>
                    <?php if(!empty($_SESSION['admin'])) {?>
                        <a href="./delete.php" class="w3-bar-item w3-button">ADMIN CENTER</a>
                    <?php } ?>
                </div>
                <?php }?>
            </div>
        </div>
    </body>
</html>
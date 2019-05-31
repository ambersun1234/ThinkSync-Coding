<?php
    session_start(); 
    //$_SESSION['Category'] = 'All';
?>
<?php
    //include("head_line.inc.php");
    include('action_page.php');
    include('./include/mysql_connect.inc.php');
    include_once('./include/db/configure.php');
    include_once("./include/db/db_func.php");
    include_once("./include/commonFunction.php");
    $db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>HOME</title>
    
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <!--script type="text/javascript" src="http://cherne.net/brian/resources/jquery.hoverIntent.js"></script>
        <script type="text/javascript" src="https://raw.githubusercontent.com/douglascrockford/JSON-js/master/json2.js"></script-->
        <!--script type="text/javascript" src="./jquery.cycle.all.js"></script-->
        <!--google map style-->
        <style>
          /* Always set the map height explicitly to define the size of the div
           * element that contains the map. */
          #map {
            height: 100%;
          }
          /* Optional: Makes the sample page fill the window. */
          html, body {
            height: 100%;
            margin: 0;
            padding: 0;
          }
          a{
                text-decoration: none;
          }
        </style>
        <!--totally style-->
        <style>
            body, html {
                height: 100%;
                font-family: "Inconsolata", sans-serif;
                color : black;
                background: "#rgb(207, 223, 226)";
            }
            .bgimg {
                background-position: center;
                background-size: cover;
                min-height: 75%;
            }
            .menu {
                display: none;
            }
            .w3-top{
                font-family: "Inconsolata", sans-serif;
                color : white;
                background: "#rgb(101, 152, 146)";
            }
        </style>
        <!--About visual-pic Style-->
        <style type="text/css">
            #slideshow {
                width:   1600px;
                height:  900px; 
                padding: 0;  
                margin:  0;
                overflow:hidden;  
            }
            #slideshow img {  
                background-color: #eee;  
                width:  1600px; 
                height: 900px; 
                top:  0; 
                left: 0;
            }
            .flex-caption {
                color: white;
                font-size: 100px;
                text-transform: uppercase;
                z-index:1;
            }
            .bg {
                position: fixed;
                top: 0;
                left: 0;
                bottom: 0;
                right: 0;
                z-index: -999;
            }

        </style>
        
        <!--"Script" have scroll function for better experience-->
        <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js" type="text/javascript"></script>
        <!--script type="text/javascript" src="jquery"></script>
        <script type="text/javascript" src="jquery-3.3.1.min.js"></script-->
        <script type="text/javascript" src="jquery.cycle.all.js"></script>
        <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script type="text/javascript">
                $(function() {
                    $('a.scroll').bind('click', function(event) {
                        var $anchor = $(this);
                        $('html, body').stop().animate({
                            scrollTop: $($anchor.attr('href')).offset().top
                        }, 1000, 'easeInOutExpo');
                    event.preventDefault();
                });

            });
        </script>
      
        <!--"Script" About visual-pic-->
        <script type="text/javascript">
            $(document).ready(function() {
                $('#slideshow').cycle({
                    fx: 'fade',
                    infinite: true,
                    speed: 2000,
                    timeout: 1000,
                    autoplay: true
                });
            });
        </script>
    </head>
    <!--end of head-->
    
    <body>
        <!-- Links (sit on top) -->
        <div class="w3-top">
            <div class="w3-row w3-padding w3-black">
            <div class="w3-col s1">
                <a href="#home" class="w3-button w3-block w3-black scroll">HOME</a>
            </div>
            <div class="w3-col s1">
                <a href="#about" class="w3-button w3-block w3-black scroll">ABOUT</a>
            </div>
            <div class="w3-col s1">
                <a href="#where" class="w3-button w3-block w3-black scroll">WHERE</a>
            </div>
            <div class="w3-col s1">
                <a href="#contact" class="w3-button w3-block w3-black scroll">CONTACT</a>
            </div>
            <div class="w3-col s1">
                <a href="index_new.php#C#default" class="w3-button w3-block w3-black scroll">START</a>
            </div>
            <!--div class="w3-col s1">
                <a href="prizeTest.php" class="w3-button w3-block scroll">LOTTERY</a>
            </div-->
            <!--detect the state of login or out, and change the function that they can use-->
            <?php if(empty($_SESSION['uid'])) {?>
                <div id = "pic" class="w3-right w3-hide-small">
                    <a href="./login.php" class="w3-bar-item w3-button">SIGNIN</a>
                    <a href="./register.php" class="w3-bar-item w3-button">SIGNUP</a>
                </div>
            <?php }?>
            <?php if(!empty($_SESSION['uid'])) { ?>
                <div id = "pic" class="w3-right w3-hide-small">
                   <?php
                        //$ID = $_SESSION['uid'];
                        $email = $_SESSION['email'];
                        $sql = "SELECT * FROM tsc_account WHERE Email = '$email' AND Valid = '0'";
                        $result = querydb($sql, $db_conn);
                        $pic = $result[0]['Picture'];  
                    ?>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($pic);?>" width="30" height="30"/>
                    <?php
                        echo "<font class='w3-bar-item' style='position:center;padding:8px 16px;vertical-align: middle;' align='center' valign='center' face='Inconsolata' size='3'>Hi! ".$result[0]['Username']."!&nbsp;&nbsp;</font>";
                        
                    ?>
                  <a href="../ThinkSync/logout.php" class="w3-bar-item w3-button">LOGOUT</a>
                  <!--a href="../ThinkSync/post.php" class="w3-bar-item w3-button">POST</a-->
                  <a href="../ThinkSync/update.php" class="w3-bar-item w3-button">USER CENTER</a>
                </div>
            <?php }?>
            <!--?php if(!empty($_SESSION['admin'])) echo "<a href='./delete.php' class='w3-bar-item w3-button'>ADMIN CENTER</a>";?-->
                
            </div>
        </div>

        <!-- Header with image bgimg -->
        <header class="bgimg w3-display-container w3-grayscale-min w3-center" id="home">
                <div style="position: relative;text-align: center;font-size: 80pt;color: aliceblue;font-weight: 200;top:200px;">
                    ThinkSync.<br><p style="font-size:30pt">———————————————————————————————————————————————</p>
                    <p style="font-size:20pt;margin-top:20px;">We are devoted to building a complete online IDE platform</p>
                </div>

                <div class="bg" id= "slideshow">
                    <img src="homepage_pic/pic_03.jpg" alt="1" style="width:auto;max-width:2000px"/>
                    <img src="homepage_pic/pic_07.jpg" alt="2" style="width:auto;max-width:2000px"/>
                </div>
        </header>
        
        <!-- Add a background color and large text to the whole page *w3-sand w3-grayscale-->
        <br><br><br><br><br><br><br><br><br><br><br><br>
        <div class="w3-large"> 
            <!-- About Container -->
            <div class="w3-container" id="about">
                <div class="w3-content" style="max-width:700px">
                    <h4 class="w3-center w3-padding-64"><span class="w3-wide" style = "border-bottom-style: solid;padding : 10px">ABOUT THE THINKSYNC.</span></h4>
                    <p style="font-size:20pt;">This site was established on 2019/05/07 </p><!--成立於 2019/05/07 的小組專題。-->
                    <p>Why we name this project "ThinkSync." ?</p><br><!--為什麼要取名為 ThinkSync. 呢-->
                    <p>　　　　Its main purpose is :<strong>Synchronize your Think with the world!</strong></p><br>
                    <p>Let's <strong>coding everywhere!</strong></p><br><!--其主旨在於：讓你的想法與世界同步！來跟大家分享你的想法吧-->
                    <div class="w3-panel w3-leftbar w3-light-grey"><br>
                        <p><i>"　Not being heard is no reason for silence.　"</i></p>
                        <p>　　　　　　　　　　　　　　　　              by: Victor Marie Hugo</p>
                        <br>
                    </div>
                    <img src="homepage_pic/pic_01.jpg" style="width:100%;max-width:1000px" class="w3-margin-top">
                </div>
            </div>
            <br><br><br><br>
            <!--google map-->
            <div class="w3-container" id="where" style="padding-bottom:32px;">
                <div class="w3-content" style="max-width:700px">
                    <h4 class="w3-center w3-padding-48"><span class="w3-wide" style = "border-bottom-style: solid;padding : 10px">WHERE TO FIND US</span></h4>
                    <div id="googleMap" style="width:100%;height:400px;"></div>
                </div>
                <br><br>
                <div class="w3-panel w3-leftbar w3-border-black w3-white w3-content" style="max-width:700px"><br>
                    <p>  Service Time ： MON ~ FRI 08:00 ~ 17:00</p> <!--營業時間-->
                    <p>  Contact Nsumber ： 0987-487-945</p> <!--連絡電話-->
                    <br>
                </div>
            </div>
            
            <!--google map function-->
            <script async defer
                     src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmUgkZNoNZFbzGUBRVKoPL2vYJPSwhr5c&callback=initMap">
            </script>
            <script>
                  function initMap() {
                    var myLatLng = {lat: 25.066888, lng: 121.522243};
                    var map = new google.maps.Map(document.getElementById('googleMap'), {
                      zoom: 16,
                      center: myLatLng,
                      gestureHandling: 'cooperative'
                    });

                    var marker = new google.maps.Marker({
                      position: myLatLng,
                      map: map,
                      title: 'Hello World!'
                    });
                  }
            </script>
            <br><br><br>
            <!-- Contact/Area Container -->
            <div class="w3-container" id = "contact" style="padding-bottom:32px;" >
                <div class="w3-content" style="max-width:700px">
                    <h4 class="w3-center w3-padding-48"><span class="w3-wide" style = "border-bottom-style: solid;padding : 10px">CONTACT</span></h4>
                    <p><span class="w3-tag">※  Feedback is Welcome</span></p><br>
                    <p>This feedback will send to us, but it won't reply<strong> "IMMEDIATELY", </strong> please wait patiently</p><br><!--※ 有任何問題歡迎給我們回饋 這封信將會寄到我們的信箱，但未必會 " 立刻 "得到回覆，請耐心等待！寄出信件-->
                    <form name = "form1" action="action_page.php" method = "post" target="_blank"> <!--target="_blank"-->
                        <p><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Name" required name="T1"></p>
                        <p><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Subject" required name="T2"></p>
                        <p><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Your email address" required name="T3"></p>
                        <p><textarea class="w3-input w3-padding-16 w3-border" rows="10" cols="60" placeholder="Message \ Special requirements" required name="T4"></textarea></p>
                        <p><button class="w3-button w3-black" type="submit" value = "submit">SEND</button></p>
                    </form>
                </div>
            </div>

            <!-- End page content -->

            <!-- Footer -->
            <footer class="w3-center w3-padding-48" style="background-color:#9098a0">
                <p style="color:#fff;"><a href="https://www.edu.tw/News_Content.aspx?n=9F932B3D33DCCF6B&sms=15283ECA9D7F60AA&s=C046940F587A693C">Privacy Policy</a> | <a href="https://law.moj.gov.tw/LawClass/LawAll.aspx?PCode=I0050021">Personal Data Protection Related Legal Matters</a></p>
                <p style="color:#fff;">Suggestions or customer service please contact : u10506111</p>
            </footer>
            <!--Privacy Policy|Personal Data Protection Related Legal Matters

Suggestions or customer service please contact-->
            <!--About jquery-->
            <!--script>
                // Tabbed Menu
                function openMenu(evt, menuName) {
                    var i, x, tablinks;
                    x = document.getElementsByClassName("menu");
                    for (i = 0; i < x.length; i++) {
                        x[i].style.display = "none";
                    }
                    tablinks = document.getElementsByClassName("tablink");
                    for (i = 0; i < x.length; i++) {
                        tablinks[i].className = tablinks[i].className.replace(" w3-dark-grey", "");
                    }
                    document.getElementById(menuName).style.display = "block";
                    evt.currentTarget.firstElementChild.className += " w3-dark-grey";
                }
                document.getElementById("myLink").click();
            </script-->
            
        </div>
        
    </body>
    
</html>

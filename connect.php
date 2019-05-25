<?php session_start(); ?>
<?php
include("./include/head_line.inc.php");
include("./include/mysql_connect.inc.php");
mysqli_query($conn, "SET NAMES utf8");
$id = mysqli_real_escape_string($conn, $_POST['id']);
$pw = mysqli_real_escape_string($conn, $_POST['pw']);
$sql = "SELECT * FROM account where UserIndex = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($result);


$ch = '$2y$10$GnTzWKFrQoWVrbdsKzCuteUMoPWE.urPrDfZluN0mbSmbi2xrWIym';
if($_POST['button_admin'] != null && password_verify($_POST['pw_admin'], $ch)) {
    $_SESSION['ID'] = $id;
    $_SESSION['PS'] = $row[4];
    if($id != null && $pw != null && $row[1] == $id && password_verify($pw, $row[4])) {
        $_SESSION['admin'] = $_POST['pw_admin'];
        echo "<img src = './pic/lloginsuccess.png' width='90%' style='display:block; margin:auto;'>";
        echo '<meta http-equiv=REFRESH CONTENT=1;url=delete.php>';
    }
    else {
        echo "<img src = './pic/lloginFaild.png' width='90%' style='display:block; margin:auto;'>";
        echo '<meta http-equiv=REFRESH CONTENT=1;url=login.php>';
    }
}
else if($_POST['pw_admin'] != null && !password_verify($_POST['pw_admin'], $ch)) {
    echo "<img src = './pic/lloginFaild.png' width='90%' style='display:block; margin:auto;'>";
    echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
}
else if($_POST['button'] != null){
    if($id != null && $pw != null && $row[1] == $id && password_verify($pw, $row[4])) {
        $_SESSION['ID'] = $id;
        $_SESSION['PS'] = $row[4];
        echo "<img src = './pic/lloginsuccess.png' width='90%' style='display:block; margin:auto;'>";
        echo '<meta http-equiv=REFRESH CONTENT=1;url=home.php>';
    }
    else {
            echo "<img src = './pic/lloginFaild.png' width='90%' style='display:block; margin:auto;'>";
            echo '<meta http-equiv=REFRESH CONTENT=1;url=login.php>';
    }
}
?>

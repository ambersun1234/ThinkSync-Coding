<?php
function connect2db($dbhost, $dbuser, $dbpwd, $dbname) {
    $dsn = "mysql:host=$dbhost;dbname=$dbname";
    try {
        $db_conn = new PDO($dsn, $dbuser, $dbpwd);
    }
    catch (PDOException $e) {
        echo $e->getMessage();
        die ("Error: cannot connect to database.");
    }
    $db_conn->query("SET NAMES UTF8");
    return $db_conn;
}

function updatedb($updatestr, $conn_id) {
    try {
        $result = $conn_id->query($updatestr);
    } catch (PDOException $e) {
        echo $e->getMessage();
        die ("Update database failed, please contact the conservancy.");
    }
    return $result;
}
function querydb($querystr, $conn_id) {
    try {
        $result = $conn_id->query($querystr);
    } catch (PDOException $e) {
        die ("Query database failed, please contact the convervancy.");
    }
    $rs = array();
    if ($result) $rs = $result->fetchall();
    return $rs;
}

function sql_limit($count, $offset) {
    return " LIMIT $offset,$count ";
}

function newid($db) {
    return $db->lastInsertId();;
}

function xssfix($InString) {
    return htmlspecialchars($InString);
}
?>

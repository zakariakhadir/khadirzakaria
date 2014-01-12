<?php

mysql_connect("localhost", "root", "") or die ("Connexion impossible : ".mysql_error());
mysql_select_db("blog");

$connect = FALSE;
if (isset($_COOKIE['sid'])) {
    $cookies = $_COOKIE['sid'];
    $sqlcookies = ("SELECT COUNT(*) AS sid FROM users WHERE sid = '$cookies'");
    $co = mysql_query($sqlcookies);
    $data = mysql_fetch_array($co);
    if ($data['sid']){
        $connect = TRUE;
    }
    }
    


?>

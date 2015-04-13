<?php
$host = "localhost";
$username = "matrix";
$password = "Matrix@MHS1";
$db_name = "matrix_details";

mysql_connect("$host", "$username", "$password")or die("cannot connect to server");
mysql_select_db("$db_name")or die("cannot select DB");
?>
<?php
function conectar(){
    $username = "bsale_test";   // use your username
    $password = "bsale_test";        // use your password
    $host = "mdb-test.c6vunyturrl6.us-west-1.rds.amazonaws.com";           // use your host name or address
    $database="bsale_test";          // use your database name
    //------conexion a la base de datos--------
    $server = new mysqli($host, $username, $password, $database);
    $server->set_charset("utf8");
    return $server;
}

?>
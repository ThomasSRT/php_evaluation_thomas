<?php
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','php_evaluation_thomas');

$dns='mysql:host=' .DB_HOST . ';dbname=' . DB_NAME;

try{
    $connexion=new PDO($dns,DB_USER,DB_PASS,
);
}catch(PDOException $e){
    die($e->getMessage());
}

session_start();
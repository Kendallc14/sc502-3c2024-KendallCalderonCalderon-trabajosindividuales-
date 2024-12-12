<?php
require "message_log.php";
 
$host = 'localhost';
$dbname = 'todo_app';
$user = 'root';
$password = '12345';
 

try{
 
    $pdo = new PDO("mysql:host=$host;dbname=$dbname",$user,$password);// Se indica cual es la base de daos, host y usuario de donde me quiero conectar
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//
    logDebug("DB: Conexion Exitosa");
 
 
}catch(PDOException $e){
    logError($e -> getMessage());
    die("Error de conexion: " . $e -> getMessage());
}
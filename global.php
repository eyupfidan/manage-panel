<?php
@session_start();
require_once("views/index.php");
$views = new Views();
try {
    $setting = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_CASE => PDO::CASE_NATURAL,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    );
    $conn = new PDO("mysql:host=localhost;dbname=dbname", "username", "password",$setting);

} catch (PDOException $ex) {
    die($ex->getMessage());
}
?>
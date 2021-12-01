<?php
$host = "localhost";
$dbName = "legends_barbell_db";
$dbUser = "marbar";
$dbPass = "boyce";

$pdo = new PDO("mysql:host={$host};dbname={$dbName};charset=utf8", $dbUser, $dbPass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
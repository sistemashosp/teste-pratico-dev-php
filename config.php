<?php

try {
    $db_host1 = 'localhost';
    $db_username = '';
    $db_password = '';
    $dsn = "mysql:dbname=meubanco;host={$db_host1}";
    $pdo = new PDO($dsn, $db_username, $db_password);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
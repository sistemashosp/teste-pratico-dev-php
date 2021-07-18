<?php

class SQLConnection
{
    protected static $instance;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (empty($instance)) {
            $dbConnectionInfo = [
                'host' => '127.0.0.1',
                'port' => '3306',
                'user' => 'root',
                'pw' => '/',
                'table' => 'shosp',
                'charset' => 'UTF-8'
            ];

            try {
                self::$instance = new PDO("mysql:host=" . $dbConnectionInfo['host'] . ';port=' . $dbConnectionInfo['port'] . ';dbname=' . $dbConnectionInfo['table'], $dbConnectionInfo['user'], $dbConnectionInfo['pw'], ['charset' => 'utf8']);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        return self::$instance;
    }
}

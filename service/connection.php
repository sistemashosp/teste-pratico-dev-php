<?php

    class Connection {

        private static $connection;
        //127.0.0.1
        
        public static function getConnection() {
            self::$connection = new PDO('mysql:host=127.0.0.1;dbname=teste', 'root', 'batman123');

            return self::$connection;            
        }

        public static function setConnection($connection) {
            self::$connection = $connection;
        }

    }

?>
<?php

require('config.php');

class Database {
    private function __construct() {}
    
    private static $dsn = DSN;
    private static $username = USERNAME;
    private static $password = PASSWORD;
    private static $db;

    public static function getDB () {
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(self::$dsn, self::$username, self::$password);
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                return json_encode([
                    'status' => [
                        'message' => $error_message    
                    ] 
                ]);
                exit();
            }
        }
        return self::$db;
    }
}

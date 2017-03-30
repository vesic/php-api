<?php

$host = getenv('OPENSHIFT_MYSQL_DB_HOST') ? getenv('OPENSHIFT_MYSQL_DB_HOST') : 'localhost';
$db = getenv('OPENSHIFT_GEAR_NAME') ? getenv('OPENSHIFT_GEAR_NAME') : 'db1';
$port = getenv('OPENSHIFT_MYSQL_DB_PORT') ? getenv('OPENSHIFT_MYSQL_DB_PORT') : '3306';
$username = getenv('OPENSHIFT_MYSQL_DB_USERNAME') ? getenv('OPENSHIFT_MYSQL_DB_USERNAME') : 'root';
$password = getenv('OPENSHIFT_MYSQL_DB_PASSWORD') ? getenv('OPENSHIFT_MYSQL_DB_PASSWORD') : '';

define('DSN', sprintf("mysql:host=%s;port=%s;dbname=%s", $host, $port, $db));
define('USERNAME', $username);
define('PASSWORD', $password);

class Database {
    private static $dsn = DSN;
    private static $username = USERNAME;
    private static $password = PASSWORD;
    private static $db;

    private function __construct() {}

    public static function getDB () {
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(self::$dsn, self::$username, self::$password);
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                include('../errors/database_error.php');
                exit();
            }
        }
        return self::$db;
    }
}
?>
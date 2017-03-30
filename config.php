<?php

$host = getenv('OPENSHIFT_MYSQL_DB_HOST') ? getenv('OPENSHIFT_MYSQL_DB_HOST') : 'localhost';
$db = getenv('OPENSHIFT_GEAR_NAME') ? getenv('OPENSHIFT_GEAR_NAME') : 'db1';
$port = getenv('OPENSHIFT_MYSQL_DB_PORT') ? getenv('OPENSHIFT_MYSQL_DB_PORT') : '3306';
$username = getenv('OPENSHIFT_MYSQL_DB_USERNAME') ? getenv('OPENSHIFT_MYSQL_DB_USERNAME') : 'root';
$password = getenv('OPENSHIFT_MYSQL_DB_PASSWORD') ? getenv('OPENSHIFT_MYSQL_DB_PASSWORD') : '';

define('DSN', sprintf("mysql:host=%s;port=%s;dbname=%s", $host, $port, $db));
define('USERNAME', $username);
define('PASSWORD', $password);

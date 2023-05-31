<?php

$host = 'mysql-esenforums.alwaysdata.net';
$dbname = 'esenforums_demo';
$user = '315765';
$password = 'EsenForums123@';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
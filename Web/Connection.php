<?php

$host = '';
$dbname = '';
$user = '';
$password = '';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

<?php

$db = mysqli_connect(
    $_ENV['DB_HOST'],
    $_ENV['DB_USER'],
    $_ENV['DB_PASS'],
    $_ENV['DB_SCHEMA']
);

$db->set_charset('utf8');

if (!$db) {
    echo "Error: Couldn't connect to MySQL.";
    echo "Error code: " . mysqli_connect_errno();
    echo "Description: " . mysqli_connect_error();
    exit;
}

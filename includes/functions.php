<?php

function debug($var) : string {
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    exit;
}

// Sanitize HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}
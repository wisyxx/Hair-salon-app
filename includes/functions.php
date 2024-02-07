<?php

function isLast(string $actual, string $next): bool
{
    return $actual !== $next;
}

function debug($var): string
{
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    exit;
}

// Sanitize HTML
function s($html): string
{
    $s = htmlspecialchars($html);
    return $s;
}

function isAuth(): void
{
    if (!isset($_SESSION['login'])) {
        header('Location: /');
    }
}

function isAdmin(): void
{
    if (!isset($_SESSION['admin']))
    {
        header('Location: /');
    }
}

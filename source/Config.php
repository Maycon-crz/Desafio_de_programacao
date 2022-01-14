<?php
/** BASE URL */
define("ROOT", "https://localhost/PHP_tips/PHP_TIPS/ep13/");

function url(string $path): string
{
    if ($path) {
        return ROOT . "{$path}";
    }
    return ROOT;
}

function message(string $message, string $type): string
{
    return "<div class=\"message {$type}\">{$message}</div>";
}
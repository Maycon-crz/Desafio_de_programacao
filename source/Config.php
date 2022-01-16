<?php
/** BASE URL */
define("ROOT", "https://localhost/Portfolio/Desafio_de_programacao/");

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
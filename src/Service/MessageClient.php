<?php


namespace App\Service;


interface MessageClient
{
    public function send(string $from, string $message): bool;
}
<?php


namespace App\Service;


class Mailer
{
    public function send(string $email, string $text): bool
    {
        print_r("Send email to {$email} with text {$text}" . "\n");
        return true;
    }
}
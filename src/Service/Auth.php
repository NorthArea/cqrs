<?php


namespace App\Service;


use App\Service\Contract\AuthInterface;

class Auth implements AuthInterface
{
    private string $file = __DIR__ . '/../../var/temp.txt';
    private int $sleepTime = 5;

    public function createUser(string $email, string $name): bool
    {
        sleep($this->sleepTime);
        // Открываем файл для получения существующего содержимого
        $current = file_get_contents($this->file);
        // Добавляем нового человека в файл
        $current .= " {$email}:{$name}";
        // Пишем содержимое обратно в файл
        file_put_contents($this->file, $current);
        print_r("User {$email} is created" . "\n");
        return true;
    }

    public function getAllUsers(): string
    {
        sleep($this->sleepTime);
        return file_get_contents($this->file);
    }
}
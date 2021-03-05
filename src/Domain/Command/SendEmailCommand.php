<?php


namespace App\Domain\Command;


use App\Domain\Contract\Command\CommandInterface;
use App\Service\Mailer;

class SendEmailCommand implements CommandInterface
{
    private Mailer $mailer;
    private string $email;
    private string $text;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function execute(): void
    {
        $this->mailer->send($this->email, $this->text);
    }
}
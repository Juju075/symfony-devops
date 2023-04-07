<?php

namespace App\Service;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class SendMailService
{
    private $mailer;

    public function __construct(MailerInterface $mailer) // Usage?
    {
    }

    public function send(string $from, string $to, string $subject, string $template, array $context): void
    {
        //TODO enorme repetion class symfony

        $email = (new TemplatedEmail())
            ->from($from)
            ->subject($subject)
            ->htmlTemplate("email/$template.html.twig")
            ->context($context);
        var_dump($email);
        die();

        $this->mailer->send($email);
    }
}
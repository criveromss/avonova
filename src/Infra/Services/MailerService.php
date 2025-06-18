<?php

declare(strict_types = 1);

namespace App\Infra\Services;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Twig\Environment;

class MailerService
{

  public function __construct(
    protected Environment $twig,
    protected MailerInterface $mailer,
  ) {

  }

    public function sendMail(
        string $from,
        string $to,
        string $subject,
        string $template,
        array $context,

    ) {

        $email = (new TemplatedEmail())
            ->from($from)
            ->to($to)
            ->subject($subject)
            ->htmlTemplate($template);

            $email->context($context);

       $this->mailer->send($email);
    }
}

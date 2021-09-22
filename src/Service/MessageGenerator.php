<?php

namespace App\Service;


use Psr\Log\LoggerInterface;
use Symfony\Component\Mailer\MailerInterface;

class MessageGenerator
{
    private $logger;

    public function __construct($email, $logger, $site)
    {

        var_dump($email, $logger, $site);
        die();

        $this->logger = $logger;
    }

    public function getHappyMessage() : string
    {

        $messages = [ 'Ok' ];
        $index = array_rand($messages);
        $this->logger->info($messages[ $index ]);

        return $messages[ $index ];
    }
}
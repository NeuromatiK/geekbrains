<?php

namespace App\Controller;

use App\Service\MessageGenerator;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends AbstractController
{
    public function index(Request $request, LoggerInterface $logger, MessageGenerator $messageGenerator) : Response
    {

        var_dump($messageGenerator->getHappyMessage());
        die();

        return $this->render('index/index.html.twig', [ 'controller_name' => 'Index' ]);
    }

    public function login(Request $request)
    {

    }
}

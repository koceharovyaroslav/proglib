<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $title = 'Hello world!';

        return $this->render('index.html.twig', [
            'title' => $title,
        ]);
    }
}
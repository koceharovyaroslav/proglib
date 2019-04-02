<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/", name="index")
     */
    public function index(Request $request)
    {
        $title = 'Hello world!';

        return $this->render('index.html.twig', [
            'title' => $title,
        ]);
    }

    /**
     * @param Request $request
     *
     * @Route("/all-users", name="all_users")
     */
    public function allUsers(Request $request)
    {
        $user = $request->getUser();
        $users = $this->getDoctrine()->getRepository(User::class);


    }
}
<?php

namespace App\Controller;

use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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
        return $this->render('app/index.html.twig', []);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/users-list", name="all_users")
     */
    public function usersList(Request $request)
    {
        /** @var User $user */
        $user = $this->getUser();
        /** @var User[] $users */
        $users = $this->getDoctrine()->getRepository(User::class)->getOtherUsers($user->getId());

        return $this->render('app/users_list.html.twig', [
            'users' => $users
        ]);
    }

    /**
     * @param Request $request
     * @param User $user
     *
     * @Route("/add-user/{id}", name="add_user")
     * @ParamConverter("user", class="App\Entity\User")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addUserToList(Request $request, User $user)
    {
        $em = $this->getDoctrine()->getManager();
        /** @var User $currentUser */
        $currentUser = $this->getUser();
        $currentUser->addUser($user);
        $em->persist($currentUser);
        $em->flush();
        return $this->redirectToRoute('all_users');
    }

    /**
     * @param Request $request
     * @param User $user
     *
     * @Route("/delete-user/{id}", name="delete_user")
     * @ParamConverter("user", class="App\Entity\User")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteUserFromList(Request $request, User $user)
    {
        $em = $this->getDoctrine()->getManager();
        /** @var User $currentUser */
        $currentUser = $this->getUser();
        $currentUser->removeUser($user);
        $em->persist($currentUser);
        $em->flush();
        return $this->redirectToRoute('all_users');
    }
}
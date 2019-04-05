<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use App\Repository\PostRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /**
     * @param PostRepository $postRepositiry
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/", name="index")
     */
    public function index(PostRepository $postRepositiry)
    {
        /** @var Post $posts */
        $posts = $postRepositiry->findBy(
            ['user' => $this->getUser()->getSignedUsersIds()],
            ['dateCreated' => 'DESC' ]
        );

        return $this->render('app/index.html.twig', [
            'posts' => $posts
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/users-list", name="users_list")
     */
    public function usersList(Request $request)
    {
        /** @var User $user */
        $user = $this->getUser();
        /** @var User[] $users */
        $users = $this->getDoctrine()->getRepository(User::class)->getOtherUsers($user);

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
        return $this->redirectToRoute('users_list');
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
        return $this->redirectToRoute('users_list');
    }

    /**
     * @Route("/profile", name="user_profile")
     */
    public function profile()
    {
        return $this->render('app/profile.html.twig');
    }
}
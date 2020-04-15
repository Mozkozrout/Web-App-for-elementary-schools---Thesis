<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user", name="user.")
 */
class UserController extends AbstractController
{

    /**
     * @Route("/{id}", name="show")
     * @param User $user
     * @return Response
     */
    public function show(User $user)
    {
        $this -> denyAccessUnlessGranted('ROLE_ADMIN', null, "Přístup odepřen");

        return $this -> render('user/index.html.twig', ['user' => $user]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     * @param User $user
     * @return RedirectResponse
     */
    public function remove(User $user)
    {
        $this -> denyAccessUnlessGranted('ROLE_ADMIN', null, "Přístup odepřen");

        $em = $this -> getDoctrine() -> getManager();
        $em -> remove($user);
        $em -> flush();
        $this -> addFlash('success', 'Uživatel byl smazán');
        return $this -> redirect($this->generateUrl('home'));
    }

    /**
     * @Route("/edit/{id}", name="edit")
     * @param User $user
     * @param Request $request
     * @return Response
     */
    public function edit(User $user, Request $request)
    {
        $this -> denyAccessUnlessGranted('ROLE_ADMIN', null, "Přístup odepřen");

        $form = $this -> createForm(UserType::class, $user);
        $form -> handleRequest($request);
        if ($form -> isSubmitted())
        {
            $em = $this -> getDoctrine() -> getManager();
            $em -> persist($user);
            $em -> flush();

            $this -> addFlash('success', 'Uživatel byl upraven');
            return $this->redirect($this->generateUrl('home'));
        }
        $this -> addFlash('danger', 'Někde nastala chyba');
        return $this->render('user/index.html.twig', ['form' => $form -> createView(), 'user' => $user]);
    }
}

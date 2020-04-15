<?php

namespace App\Controller;

use App\Entity\Ucitele;
use App\Entity\User;
use App\Entity\Zak;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return RedirectResponse|Response
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this -> denyAccessUnlessGranted('ROLE_ADMIN', null, "Přístup odepřen");

        $roles = $this -> getParameter('security.role_hierarchy.roles');
        $form = $this -> createFormBuilder()
            -> add('username', TextType::class, ['label' => 'Uživatelské jméno'])
            -> add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'required' => true,
                'first_options' => ['label' => 'Heslo'],
                'second_options' => ['label' => 'Potvrďte heslo']
            ])
            -> add('roles', ChoiceType::class, ['choices' => ['Admin' => 'ROLE_ADMIN', 'Učitel' => 'ROLE_TEACHER', 'Žák' => 'ROLE_STUDENT'], 'required' => true, 'multiple' => true, 'expanded' => true, 'label' => 'Uživatelské role:'])
            -> add('ucitel', EntityType::class, ['label' => 'Učitel', 'class' => Ucitele::class, 'empty_data' => null, 'required'=> false])
            -> add('zak', EntityType::class, ['label' => 'Žák', 'class' => Zak::class, 'empty_data' => null, 'required'=> false])
            -> add('Registrovat', SubmitType::class, ['attr' => ['class' => 'btn btn-lg btn-outline-success btn-block']])
            -> getForm();

        $form -> handleRequest($request);

        if ($form -> isSubmitted()) {
            $data = $form->getData();

            $user = new User();
            $user -> setUsername($data['username']);
            $user -> setPassword($passwordEncoder -> encodePassword($user, $data['password']));
            $user -> setRoles($data['roles']);
            $user -> setUcitel($data['ucitel']);
            $user -> setZak($data['zak']);

            $em = $this -> getDoctrine() -> getManager();

            $em -> persist($user);
            $em -> flush();

            return $this -> redirect($this -> generateUrl('home'));
        }

        return $this -> render('registration/index.html.twig', ['form' => $form -> createView()]);
    }
}

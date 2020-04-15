<?php

namespace App\Controller;

use App\Entity\Ucebna;
use App\Entity\Ucitele;
use App\Form\UcitelType;
use App\Repository\UciteleRepository;
use App\Services\FileUploader;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ucitele", name="ucitele.")
 */
class UciteleController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param UciteleRepository $uciteleRepository
     * @return Response
     */
    public function index(UciteleRepository $uciteleRepository)
    {
        $ucitele = $uciteleRepository->findAll();
        return $this -> render('ucitele/index.html.twig', ['ucitele' => $ucitele]);
    }

    /**
     * @Route("/create", name="create")
     * @param Request $request
     * @param FileUploader $fileUploader
     * @return Response
     */
    public function create(Request $request, FileUploader $fileUploader)
    {
        $this -> denyAccessUnlessGranted('ROLE_ADMIN', null, "Přístup odepřen");

        //vyrobi novyho ucitele
        $ucitel = new Ucitele();
        $form = $this -> createForm(UcitelType::class, $ucitel);
        $form -> handleRequest($request);
        if ($form -> isSubmitted()) {
            //enitity manager
            $em = $this -> getDoctrine() -> getManager();
            /** @var UploadedFile $file */
            $file = $request -> files -> get('ucitel')['image'];
            if ($file) {
                $filename = $fileUploader -> uploadFile($file);

                $ucitel -> setImage($filename);
                $em -> persist($ucitel);
                $em -> flush();
            } else {
                $em -> persist($ucitel);
                $em -> flush();
            }
            $this -> addFlash('success', 'Učitel byl přidán');
            return $this->redirect($this->generateUrl('ucitele.index'));
        }
        //return a response
        $this -> addFlash('danger', 'Někde nastala chyba');
        return $this->render('ucitele/create.html.twig', ['form' => $form-> createView()]);
    }

    /**
     * @Route("/show/{id}", name="show")
     * @param Ucitele $ucitele
     * @return Response
     */
    public function show(Ucitele $ucitele)
    {
        //create the show.html.twig view
        return $this->render('ucitele/show.html.twig', ['ucitel' => $ucitele]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     * @param Ucitele $ucitel
     * @return RedirectResponse
     */
    public function remove(Ucitele $ucitel)
    {
        $this -> denyAccessUnlessGranted('ROLE_ADMIN', null, "Přístup odepřen");

        $em = $this->getDoctrine()->getManager();
        $em->remove($ucitel);
        $em->flush();
        $this->addFlash('success', 'Učitel byl smazán');
        return $this->redirect($this -> generateUrl('ucitele.index'));
    }

    /**
     * @Route("/aedit/{id}", name="aedit")
     * @param Ucitele $ucitel
     * @param Request $request
     * @param FileUploader $fileUploader
     * @return RedirectResponse|Response
     */
    public function aedit(Ucitele $ucitel, Request $request, FileUploader $fileUploader)
    {
        $this -> denyAccessUnlessGranted('ROLE_ADMIN', null, "Přístup odepřen");

        $form = $this->createForm(UcitelType::class, $ucitel);
        $form -> handleRequest($request);
        if ($form->isSubmitted()) {
            //enitity manager
            $em = $this -> getDoctrine() -> getManager();
            /** @var UploadedFile $file */
            $file = $request -> files -> get('ucitel')['image'];
            if ($file) {
                $filename = $fileUploader -> uploadFile($file);

                $ucitel -> setImage($filename);
                $em -> persist($ucitel);
                $em -> flush();
            } else {
                $em -> persist($ucitel);
                $em -> flush();
            }
            $this -> addFlash('success', 'Učitel byl upraven');
            return $this->render('ucitele/show.html.twig', ['ucitel' => $ucitel]);
        }
        //return a response
        $this -> addFlash('danger', 'Někde nastala chyba');
        return $this->render('ucitele/create.html.twig', ['form' => $form->createView(), 'ucitel' => $ucitel]);
    }

    /**
     * @Route("/uedit/{id}", name="uedit")
     * @param Ucitele $ucitel
     * @param Request $request
     * @param FileUploader $fileUploader
     * @return RedirectResponse|Response
     */
    public function uedit(Ucitele $ucitel, Request $request, FileUploader $fileUploader)
    {
        $user = $this -> getUser();
        $u = $ucitel -> getUser();
        if(($u == null || $u -> getUsername() != $user -> getUsername()) && $user -> getRoles()[0] != 'ROLE_ADMIN') throw $this -> createAccessDeniedException("Přístup zamítnut");

        if($ucitel -> getTelefon() == null || $ucitel -> getEmail() == null || $ucitel -> getWeb() == null || $ucitel -> getPoznamka() == null){
            $form = $this->createFormBuilder()
                -> add('ucebna', EntityType::class, ['class' => Ucebna::class, 'label' => 'Kancelář'])
                -> add('telefon', TelType::class, ['required' => false, 'label' => 'Telefon', 'attr' => ['data-mask' => '+000000000000', 'placeholder' => '+123456789']])
                -> add('email', TextType::class, ['required' => false, 'label' => 'Email', 'attr' => ['placeholder' => ' Zadejte email']])
                -> add('web', TextType::class, ['required' => false, 'label' => 'Webové stránky', 'attr' => ['placeholder' => 'Zadejte webovou adresu']])
                -> add('poznamka', TextareaType::class, ['required' => false, 'label' => 'Poznámka', 'attr' => ['placeholder' => 'Zadejte poznámku' ]])
                -> add('Ulozit', SubmitType::class, ['label' => 'Uložit', 'attr' => ['class' => 'btn btn-lg btn-outline-success btn-block']])
                -> getForm()
            ;
        }
        else {
            $form = $this->createFormBuilder()
                ->add('ucebna', EntityType::class, ['class' => Ucebna::class, 'label' => 'Kancelář'])
                ->add('telefon', TelType::class, ['required' => false, 'label' => 'Telefon', 'attr' => ['data-mask' => '+000000000000', 'placeholder' => $ucitel->getTelefon()]])
                ->add('email', TextType::class, ['required' => false, 'label' => 'Email', 'attr' => ['placeholder' => $ucitel->getEmail()]])
                ->add('web', TextType::class, ['required' => false, 'label' => 'Webové stránky', 'attr' => ['placeholder' => $ucitel->getWeb()]])
                ->add('poznamka', TextareaType::class, ['required' => false, 'label' => 'Poznámka', 'attr' => ['placeholder' => $ucitel -> getPoznamka()]])
                ->add('Ulozit', SubmitType::class, ['label' => 'Uložit', 'attr' => ['class' => 'btn btn-lg btn-outline-success btn-block']])
                ->getForm();
        }
        $form -> handleRequest($request);
        if ($form -> isSubmitted()) {

            $data = $form -> getData();
            $ucitel -> setUcebna($data['ucebna']);
            $ucitel -> setTelefon($data['telefon']);
            $ucitel -> setEmail($data['email']);
            $ucitel -> setWeb($data['web']);
            $ucitel -> setPoznamka($data['poznamka']);
            //enitity manager
            $em = $this -> getDoctrine() -> getManager();
            /** @var UploadedFile $file */
            $file = $request->files -> get('ucitel')['image'];
            if ($file) {
                $filename = $fileUploader -> uploadFile($file);

                $ucitel -> setImage($filename);
                $em -> persist($ucitel);
                $em -> flush();
            } else {
                $em -> persist($ucitel);
                $em -> flush();
            }
            $this -> addFlash('success', 'Učitel byl upraven');
            return $this->render('ucitele/show.html.twig', ['ucitel' => $ucitel]);
        }
        //return a response
        $this -> addFlash('danger', 'Někde nastala chyba');
        return $this->render('ucitele/edit.html.twig', ['form' => $form -> createView(), 'ucitel' => $ucitel]);
    }
}

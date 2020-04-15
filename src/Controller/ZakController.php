<?php

namespace App\Controller;

use App\Entity\Historie;
use App\Entity\Zak;
use App\Form\ZakType;
use App\Repository\TridaRepository;
use App\Repository\ZakRepository;
use App\Services\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/zak", name="zak.")
 */
class ZakController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param ZakRepository $zakRepository
     * @return Response
     */
    public function index(ZakRepository $zakRepository)
    {
        $user = $this -> getUser();
        if($user -> getRoles()[0] != 'ROLE_TEACHER' && $user -> getRoles()[0] != 'ROLE_ADMIN') throw $this -> createAccessDeniedException("Přístup odepřen");

        $zak = $zakRepository -> findAll();
        return $this -> render('zak/index.html.twig', ['zak' => $zak,]);
    }

    /**
     * @Route("/show/{id}", name="show")
     * @param Zak $zak
     * @return Response
     */
    public function show(Zak $zak)
    {
        $user = $this -> getUser() -> getUsername();
        $z = $zak -> getUser();
        if (($z == null || $user != $z -> getUsername()) && ($this -> getUser() -> getRoles()[0] != 'ROLE_ADMIN' &&
                $this -> getUser() -> getRoles()[0] != 'ROLE_TEACHER')) throw $this -> createAccessDeniedException("Přístup odepřen");

        return $this -> render('zak/show.html.twig', ['zak' => $zak]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     * @param Zak $zak
     * @return RedirectResponse
     */
    public function remove(Zak $zak)
    {
        $this -> denyAccessUnlessGranted('ROLE_ADMIN', null, "Přístup odepřen");

        $em = $this -> getDoctrine() -> getManager();
        $em -> remove($zak);
        $em -> flush();
        $this -> addFlash('success', 'Žák byl smazán');
        return $this -> redirect($this -> generateUrl('zak.index'));
    }

    /**
     * @Route("/create", name="create")
     * @param Request $request
     * @param FileUploader $fileUploader
     * @return RedirectResponse|Response
     */
    public function create(Request $request, FileUploader $fileUploader){
        $this -> denyAccessUnlessGranted('ROLE_ADMIN', null, "Přístup odepřen");

        $historie = new Historie();
        $zak = new Zak();
        $form = $this -> createForm(ZakType::class, $zak);
        $form -> handleRequest($request);
        if($form -> isSubmitted())
        {
            $em = $this -> getDoctrine() -> getManager();
            $file = $request -> files -> get('zak')['image'];

            $historie -> addZak($zak) -> setRok(date('Y')) -> addTrida($zak -> getTrida());

            if($file)
            {
                $filename = $fileUploader -> uploadFile($file);

                $zak -> setImage($filename);
                $em -> persist($zak);
                $em -> flush();
                $em -> persist($historie);
                $em -> flush();
            }
            else
            {
                $em -> persist($zak);
                $em -> flush();
                $em -> persist($historie);
                $em -> flush();
            }
            $this -> addFlash('success', 'Žák byl přidán');
            return $this -> redirect($this -> generateUrl('zak.index'));
        }
        $this -> addFlash('danger', 'Někde nastala chyba');
        return $this -> render('zak/create.html.twig', ['form' => $form -> createView()]);
    }

    /**
     * @Route("/tridy", name="tridy")
     * @param TridaRepository $tridaRepository
     * @return Response
     */
    public function indexTridy(TridaRepository $tridaRepository)
    {
        $user = $this -> getUser();
        if($user -> getRoles()[0] != 'ROLE_TEACHER' && $user -> getRoles()[0] != 'ROLE_ADMIN') throw $this -> createAccessDeniedException("Přístup odepřen");

        $trida = $tridaRepository -> findAll();
        return $this -> render('zak/index.tridy.html.twig', ['trida' => $trida,]);
    }

    /**
     * @Route("/edit/{id}", name="edit")
     * @param Zak $zak
     * @param Request $request
     * @param FileUploader $fileUploader
     * @return Response
     */
    public function edit(Zak $zak, Request $request, FileUploader $fileUploader)
    {
        $user = $this -> getUser();
        if($user -> getRoles()[0] != 'ROLE_TEACHER' && $user -> getRoles()[0] != 'ROLE_ADMIN') throw $this -> createAccessDeniedException("Přístup odepřen");

        $form = $this -> createForm(ZakType::class, $zak);
        $form -> handleRequest($request);
        if($form -> isSubmitted())
        {
            $em = $this -> getDoctrine() -> getManager();
            $file = $request -> files -> get('zak')['image'];

            if($file)
            {
                $filename = $fileUploader -> uploadFile($file);

                $zak -> setImage($filename);
                $em -> persist($zak);
                $em -> flush();
            }
            else
            {
                $em -> persist($zak);
                $em -> flush();
            }
            $this -> addFlash('success', 'Žák byl přidán');
            return $this -> render('zak/show.html.twig', ['zak' => $zak]);
        }
        $this -> addFlash('danger', 'Někde nastala chyba');
        return $this -> render('zak/create.html.twig', ['form' => $form -> createView(), 'zak' => $zak]);
    }
}

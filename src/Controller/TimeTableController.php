<?php

namespace App\Controller;

use App\Entity\Cas;
use App\Entity\Den;
use App\Entity\Doba;
use App\Entity\Trida;
use App\Form\TimeTableType;
use App\Repository\CasRepository;
use App\Repository\DenRepository;
use App\Repository\DobaRepository;
use App\Repository\TridaRepository;
use App\Repository\ZakRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/timetable", name="time_table.")
 */
class TimeTableController extends AbstractController
{

    /**
     * @Route("/{id}", name="index")
     * @param Trida $tridavar
     * @param DenRepository $denRepository
     * @param CasRepository $casRepository
     * @param DobaRepository $dobaRepository
     * @param TridaRepository $tridaRepository
     * @param Request $request
     * @param ZakRepository $zakRepository
     * @return Response
     */
    public function index( Trida $tridavar, DenRepository $denRepository, CasRepository $casRepository, DobaRepository $dobaRepository, TridaRepository $tridaRepository, Request $request, ZakRepository $zakRepository)
    {
        $user = $this -> getUser();
        $zak = $zakRepository -> findAll();
        $t = null;
        foreach ($zak as $z)
        {
            if($z -> getUser() !== null && $z -> getUser() -> getUsername() == $user -> getUsername()) $t = $z -> getTrida();
        }
        if($t != $tridavar && ($user -> getRoles()[0] != 'ROLE_ADMIN' && $user -> getRoles()[0] != 'ROLE_TEACHER'))
        throw $this -> createAccessDeniedException("Přístup odepřen");



        $den = $denRepository -> findAll();
        $cas = $casRepository -> findAll();
        $doba = $dobaRepository -> findAll();
        $trida = $tridaRepository -> findAll();

        $form = $this -> createFormBuilder()
            -> add('trida',EntityType::class, ['class' => Trida::class, 'label' => 'Rozvrh pro třídu:'])
            -> add('save', SubmitType::class, ['label' => 'Rozvrh Pro třídu:', 'attr' => ['class' => 'btn btn-outline-primary']])
            -> getForm();

        $form->handleRequest($request);

        if($form -> isSubmitted())
        {
            return $this->redirect($this->generateUrl('time_table.index', ['id' => $form -> getData()['trida'] -> getID()]));
        }

        return $this->render('time_table/index.html.twig', ['den' => $den, 'cas' => $cas, 'doba' => $doba, 'trida' => $trida, 'tridavar' => $tridavar, 'form' => $form->createView()]);
    }


    /**
     * @Route("/create/{denid}/{trid}/{doid}", name="create")
     * @ParamConverter("den", options={"id" = "denid"})
     * @ParamConverter("trida", options={"id" = "trid"})
     * @ParamConverter("doba", options={"id" = "doid"})
     * @param Request $request
     * @param Doba $doba
     * @param Trida $trida
     * @param Den $den
     * @return Response
     */
    public function create(Request $request, Doba $doba, Trida $trida, Den $den)
    {
        $user = $this -> getUser();
        if($user -> getRoles()[0] != 'ROLE_TEACHER' && $user -> getRoles()[0] != 'ROLE_ADMIN') throw $this -> createAccessDeniedException("Přístup odepřen");

        $timeTable = new Cas();
        $timeTable -> setDen($den);
        $timeTable -> setTrida($trida);
        $timeTable -> setDoba($doba);
        $form = $this->createForm(TimeTableType::class, $timeTable);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($timeTable);
            $em->flush();
            $this -> addFlash('success', 'Rozvrh byl uložen');
            return $this->redirect($this->generateUrl('time_table.index', ['id' => $trida -> getId()]));
        }

        $this -> addFlash('danger', 'Někde nastala chyba');
        return $this->render('time_table/create.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/show/{id}", name="show")
     * @param Cas $cas
     * @param ZakRepository $zakRepository
     * @return Response
     */
    public function show(Cas $cas, ZakRepository $zakRepository)
    {
        $user = $this -> getUser();
        $t = null;
        foreach ($zakRepository -> findAll() as $z)
        {
            if($z -> getUser() != null && $z -> getUser() -> getUsername() == $user -> getUsername())$t = $z -> getTrida();
        }
        if(($cas -> getTrida() != $t)&&($user -> getRoles()[0] != 'ROLE_TEACHER' && $user -> getRoles()[0] != 'ROLE_ADMIN')) throw $this -> createAccessDeniedException("Přístup odepřen");

        return $this -> render('time_table/show.html.twig', ['cas' => $cas]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     * @param Cas $cas
     * @return RedirectResponse
     */
    public function remove(Cas $cas)
    {
        $user = $this -> getUser();
        if($user -> getRoles()[0] != 'ROLE_TEACHER' && $user -> getRoles()[0] != 'ROLE_ADMIN') throw $this -> createAccessDeniedException("Přístup odepřen");

        $em = $this -> getDoctrine() -> getManager();
        $em -> remove($cas);
        $em -> flush();
        $this -> addFlash('success', 'Učitel byl smazán');
        return $this -> redirect($this -> generateUrl('time_table.index', ['id' => $cas -> getTrida() -> getId()]));
    }

    /**
     * @Route("/edit/{id}", name="edit")
     * @param Request $request
     * @param Cas $timeTable
     * @return Response
     */
    public function edit(Request $request, Cas $timeTable)
    {
        $user = $this -> getUser();
        if($user -> getRoles()[0] != 'ROLE_TEACHER' && $user -> getRoles()[0] != 'ROLE_ADMIN') throw $this -> createAccessDeniedException("Přístup odepřen");

        $form = $this -> createForm(TimeTableType::class, $timeTable);
        $form -> handleRequest($request);

        if ($form -> isSubmitted())
        {
            $em = $this -> getDoctrine() -> getManager();
            $em -> persist($timeTable);
            $em -> flush();
            $this -> addFlash('success', 'Rozvrh byl upraven');
            return $this->redirect($this->generateUrl('time_table.index', ['id' => $timeTable -> getTrida() -> getId()]));
        }

        $this -> addFlash('danger', 'Někde nastala chyba');
        return $this -> render('time_table/create.html.twig', ['form' => $form -> createView()]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Predmet;
use App\Entity\Trida;
use App\Entity\Ucitele;
use App\Entity\Zak;
use App\Entity\Znamka;
use App\Form\GradeType;
use App\Repository\ZakRepository;
use App\Repository\ZnamkaRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/grades", name="grades.")
 */
class GradesController extends AbstractController
{

    /**
     * @Route("/show/{id}", name="show")
     * @param Znamka $znamka
     * @return Response
     */
    public function show(Znamka $znamka)
    {
        $user = $this -> getUser();
        if(($znamka -> getZak() -> getUser() == null || $znamka -> getZak() -> getUser() -> getUsername() != $user -> getUsername())&&($user -> getRoles()[0] != 'ROLE_TEACHER' && $user -> getRoles()[0] != 'ROLE_ADMIN')) throw $this -> createAccessDeniedException("Přístup odepřen");

        return $this -> render('grades/show.html.twig', ['znamka' => $znamka]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     * @param Znamka $znamka
     * @return RedirectResponse
     */
    public function remove(Znamka $znamka)
    {
        $user = $this -> getUser();
        if($user -> getRoles()[0] != 'ROLE_TEACHER' && $user -> getRoles()[0] != 'ROLE_ADMIN') throw $this -> createAccessDeniedException("Přístup odepřen");

        $em = $this -> getDoctrine() -> getManager();
        $em -> remove($znamka);
        $em -> flush();
        $this -> addFlash('success', 'Známka byla smazána');
        return $this->redirect($this -> generateUrl('grades.index', ['pid' => $znamka -> getPredmet() -> getId(), 'tid' => $znamka -> getZak() -> getTrida() -> getId(), 'uid' => $znamka -> getUcitel() -> getId(), 'zid' => $znamka -> getZak() -> getId()]));
    }

    /**
     * @Route("/edit/{id}", name="edit")
     * @param Request $request
     * @param Znamka $znamka
     * @return Response
     */
    public function edit(Request $request, Znamka $znamka)
    {
        $user = $this -> getUser();
        if($user -> getRoles()[0] != 'ROLE_TEACHER' && $user -> getRoles()[0] != 'ROLE_ADMIN') throw $this -> createAccessDeniedException("Přístup odepřen");

        $form = $this -> createForm(GradeType::class, $znamka);
        $form -> handleRequest($request);

        if ($form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();
            $em -> persist($znamka);
            $em -> flush();
            $this -> addFlash('success', 'Známka byla upravena');
            return $this -> redirect($this -> generateUrl('grades.index', ['pid' => $znamka -> getPredmet() -> getId(), 'tid' => $znamka -> getZak() -> getTrida() -> getId(), 'uid' => $znamka -> getUcitel() -> getId(), 'zid' => $znamka -> getZak() -> getId()]));
        }

        $this -> addFlash('danger', 'Někde nastala chyba');
        return $this -> render('grades/create.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/student/{id}", name="studentShow")
     * @param Request $request
     * @param Zak $zak
     * @return Response
     */
    public function studentShow(Request $request, Zak $zak)
    {
        $user = $this -> getUser();
        if(($zak -> getUser() == null || $user -> getUsername() != $zak -> getUser() -> getUsername()) && $user -> getRoles()[0] != 'ROLE_TEACHER' && $user -> getRoles()[0] != 'ROLE_ADMIN') throw $this -> createAccessDeniedException("Přístup odepřen");

        $form = $this -> createFormBuilder()
            -> add('rok', ChoiceType::class, ['required' => true, 'choices' => $this->roky()])
            -> add('vyber', SubmitType::class, ['label' => 'Zobrazit rok', 'attr' => ['class' => 'btn btn-outline-primary btn-group']])
            -> getForm();

        $form -> handleRequest($request);

        if($form -> isSubmitted())
        {
            $predmet = $this -> getPredmety($zak, $form -> getData()['rok']);
            return $this -> render('grades/student.html.twig', ['zak' => $zak, 'predmet' => $predmet, 'rok' => $form -> getData()['rok'], 'form' => $form -> createView()]);
        }
        $predmet = $this -> getPredmety($zak, date("Y"));
        return $this -> render('grades/student.html.twig', ['zak' => $zak, 'predmet' => $predmet,'form' => $form->createView(), 'rok' => date("Y")]);
    }

    public function getPredmety(Zak $zak, int $rok)
    {
        $predmet = 0;
        foreach ($zak -> getHistorie() as $h)
        {
            if($h -> getRok() == $rok)
            {
                foreach ($h -> getTrida() as $t)
                {
                    $predmet = $t -> getVybranePredmety() -> getPredmet();
                }
            }
        }
        return $predmet;
    }

    /**
     * @Route("/{tid}/{pid}", name="index")
     * @ParamConverter("predmet", options={"id" = "pid"})
     * @ParamConverter("trida", options={"id" = "tid"})
     * @param Trida $trida
     * @param Predmet $predmet
     * @param ZakRepository $zakRepository
     * @param ZnamkaRepository $znamkaRepository
     * @param Request $request
     * @return Response
     */
    public function index(Trida $trida, Predmet $predmet, ZakRepository $zakRepository,
                          ZnamkaRepository $znamkaRepository, Request $request)
    {
        $user = $this -> getUser();
        if($user -> getRoles()[0] != 'ROLE_TEACHER' && $user -> getRoles()[0] != 'ROLE_ADMIN')
            throw $this -> createAccessDeniedException("Přístup odepřen");
        $zak = $zakRepository -> findAll();
        $znamka = $znamkaRepository -> findAll();
        $form = $this -> createFormBuilder()
            -> add('trida',EntityType::class,
                ['class' => Trida::class, 'label' => 'Známky pro třídu:', 'required' => false])
            -> add('predmet',EntityType::class,
                ['class' => Predmet::class, 'label' => 'Známky z předmětu:', 'required' => false])
            -> add('rok', ChoiceType::class,
                ['required' => true, 'choices' => $this->roky()])
            -> add('vyber', SubmitType::class,
                ['label' => 'Zobrazit', 'attr' => ['class' => 'btn btn-outline-primary btn-group']])
            -> getForm();

        $form->handleRequest($request);

        if($form -> isSubmitted())
        {
            return $this -> render('grades/index.html.twig', ['zak' => $zak, 'znamka' => $znamka,
                'trida' => $form -> getData()['trida'], 'predmet' => $form -> getData()['predmet'],
                'rok' => $form->getData()['rok'], 'form' => $form->createView()]);
        }
        return $this -> render('grades/index.html.twig', ['zak' => $zak,'znamka' => $znamka,
            'trida' => $trida,'predmet' => $predmet,'rok' => date("Y"),
            'form' => $form->createView()]);
    }

    public function roky() {
        $rozdil = 10;
        $pred = date('Y', mktime(0, 0, 0, date("m"), date("d"), date("Y") - $rozdil));
        $po = date('Y', mktime(0, 0, 0, date("m"), date("d"), date("Y")));
        return array_combine(range($po, $pred), range($po, $pred));
    }

    /**
     * @Route("/create/{tid}/{pid}/{uid}/{zid}", name="create")
     * @ParamConverter("ucitele", options={"id" = "uid"})
     * @ParamConverter("zak", options={"id" = "zid"})
     * @ParamConverter("predmet", options={"id" = "pid"})
     * @ParamConverter("trida", options={"id" = "tid"})
     * @param Ucitele $ucitele
     * @param Zak $zak
     * @param Trida $trida
     * @param Predmet $predmet
     * @param Request $request
     * @return Response
     */
    public function create(Ucitele $ucitele, Zak $zak, Trida $trida, Predmet $predmet, Request $request)
    {
        $user = $this -> getUser();
        if($user -> getRoles()[0] != 'ROLE_TEACHER' && $user -> getRoles()[0] != 'ROLE_ADMIN') throw $this -> createAccessDeniedException("Přístup odepřen");

        $znamka = new Znamka();
        $znamka -> setUcitel($ucitele) -> setZak($zak) -> setPredmet($predmet);
        $form = $this -> createForm(GradeType::class, $znamka);
        $form->handleRequest($request);

        if($form -> isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($znamka);
            $em->flush();
            $this -> addFlash('success', 'Známka byla uložena');
            return $this->redirect($this->generateUrl('grades.index', ['tid' => $predmet -> getId(), 'pid' => $trida -> getId()]));
        }
        $this -> addFlash('danger', 'Někde nastala chyba');
        return $this -> render('grades/create.html.twig', ['ucitele' => $ucitele, 'zak' => $zak,'predmet' => $predmet, 'form' => $form->createView()]);
    }

}

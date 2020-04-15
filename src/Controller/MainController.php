<?php

namespace App\Controller;

use App\Entity\Cas;
use App\Repository\CasRepository;
use App\Repository\UciteleRepository;
use App\Repository\UserRepository;
use App\Repository\ZakRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param UserRepository $userRepository
     * @param ZakRepository $zakRepository
     * @param UciteleRepository $uciteleRepository
     * @param CasRepository $casRepository
     * @return Response
     */
    public function index(UserRepository $userRepository, ZakRepository $zakRepository,
                          UciteleRepository $uciteleRepository, CasRepository $casRepository)
    {
        $users = $userRepository->findAll();
        $result = null;
        $checkU = false;
        if($this -> getUser() != null) {
            $user = $this->getUser()->getUsername();
            $rozvrh = null;
            foreach ($zakRepository -> findAll() as $z) {
                if ($z->getUser() != null && $z->getUser()->getUsername() == $user) {
                    $rozvrh = $z->getTrida()->getCas();
                }
            }
            foreach ($uciteleRepository -> findAll() as $u) {
                if ($u->getUser() != null && $u->getUser()->getUsername() == $user) {
                    foreach ($casRepository -> findAll() as $t)
                    {
                        if($t -> getUcitel() == $u)
                        {
                            $checkU = true;
                            $rozvrh = $t;
                        }
                    }
                }
            }

            if($rozvrh != null)
            {
                if($checkU) $result = $this -> findTime($rozvrh);
                foreach ($rozvrh as $r)
                {
                    $r -> getId();
                    $result = $this -> findTime($r);
                }

            }

        }
        return $this->render('home/index.html.twig', ['users' => $users, 'rozvrh' => $result]);
    }

    public function findTime(Cas $r)
    {
        $result = null;
        $den = null;
        if (date("D") == "Mon") $den = "Pondělí";
        if (date("D") == "Tue") $den = "Úterý";
        if (date("D") == "Wed") $den = "Středa";
        if (date("D") == "Thu") $den = "Čtvrtek";
        if (date("D") == "Fri") $den = "Pátek";

        if ($r -> getDen() == $den) {
            if (800 <= date("Hi") + 100 && date("Hi") + 100 <= 2330) {
                if($r -> getDoba() -> getId() == 2) $result = $r;
            }
            if (855 <= date("Hi") + 100 && date("Hi") + 100 <= 959) {
                if($r -> getDoba() -> getId() == 3) $result = $r;
            }
            if (1000 <= date("Hi") + 100 && date("Hi") + 100 <= 1054) {
                if($r -> getDoba() -> getId() == 4) $result = $r;
            }
            if (1055 <= date("Hi") + 100 && date("Hi") + 100 <= 1149) {
                if($r -> getDoba() -> getId() == 5) $result = $r;
            }
            if (1150 <= date("Hi") + 100 && date("Hi") + 100 <= 1244) {
                if($r -> getDoba() -> getId() == 6) $result = $r;
            }
            if (1245 <= date("Hi") + 100 && date("Hi") + 100 <= 1334) {
                if($r -> getDoba() -> getId() == 7) $result = $r;
            }
            if (1335 <= date("Hi") + 100 && date("Hi") + 100 <= 1424) {
                if($r -> getDoba() -> getId() == 8) $result = $r;
            }
            if (1425 <= date("Hi") + 100 && date("Hi") + 100 <= 1514) {
                if($r -> getDoba() -> getId() == 9) $result = $r;
            }
            if (1515 <= date("Hi") + 100) {
                $result = null;
            }
        }

        return $result;
    }

}



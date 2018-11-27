<?php

namespace App\Controller\Index;

use App\Entity\User;
use App\Entity\UserPersonalData;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(EntityManagerInterface $em)
    {
        return $this->render('index/index/index.html.twig', []);
    }
}

<?php

namespace QuentinBundle\Controller;

use QuentinBundle\Entity\Athlete;
use QuentinBundle\Entity\Discipline;
use QuentinBundle\Entity\Pays;
use QuentinBundle\Form\AthleteType;
use QuentinBundle\Form\DisciplineType;
use QuentinBundle\Form\PaysType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('QuentinBundle:Default:index.html.twig');
    }
}

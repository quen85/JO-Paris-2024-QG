<?php

namespace QuentinBundle\Controller;

use QuentinBundle\Entity\Athlete;
use QuentinBundle\Form\AthleteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class AthleteController extends Controller
{

    /**
     * @Route("/athlete", name="athlete_show")
     */
    public function athleteAction(Request $request)
    {
        $athlete = new Athlete();
        $form = $this->createForm(AthleteType::class, $athlete);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $file = $athlete->getPicture();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('picture_directory'),
                $fileName
            );
            $athlete->setPicture($fileName);

            $this->getDoctrine()->getManager()->persist($athlete);
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('notice', $this->get('translator')->trans('notice_athlete_add'));
        }

        $listAthletes = $this->getDoctrine()
            ->getRepository(Athlete::class)
            ->findAll();

        return $this->render('QuentinBundle:Athlete:athlete.html.twig', ['form' => $form->createView(), 'athletes' => $listAthletes]);
    }

    /**
     * @Route("athlete/{id}", name="single_athlete_show")
     */
    public function singleAthleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $athlete = $em->getRepository(Athlete::class)
            ->find($id);
        $form = $this->createForm(AthleteType::class, $athlete);
        $form->handleRequest($request);

        if($form->isValid()) {

            $this->getDoctrine()->getManager()->persist($athlete);
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('notice', $this->get('translator')->trans('notice_athlete_update'));

            return $this->redirectToRoute('athlete_show');
        }

        return $this->render('QuentinBundle:Athlete:showAthlete.html.twig', ['form' => $form->createView(), 'athlete' => $athlete]);
    }

    /**
     * @Route("athlete/{id}/delete", name="delete_athlete")
     */
    public function deleteAthleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $athlete = $em->getRepository(Athlete::class)
            ->find($id);
        $file = $athlete->getPicture();
        unlink($this->getParameter('picture_directory').'/'.$file);

        $em->remove($athlete);
        $em->flush();

        $this->addFlash('notice', $this->get('translator')->trans('notice_athlete_delete'));

        return $this->redirectToRoute('athlete_show');
    }
}

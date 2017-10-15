<?php

namespace QuentinBundle\Controller;

use QuentinBundle\Entity\Discipline;
use QuentinBundle\Form\DisciplineType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class DisciplineController extends Controller
{

    /**
     * @Route("/discipline", name="discipline_show")
     */
    public function disciplineAction(Request $request)
    {
        $discipline = new Discipline();
        $form = $this->createForm(DisciplineType::class, $discipline);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $this->getDoctrine()->getManager()->persist($discipline);
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('notice', $this->get('translator')->trans('notice_discipline_add'));
        }

        $listDiscipline = $this->getDoctrine()
            ->getRepository(Discipline::class)
            ->findAll();

        return $this->render('QuentinBundle:Discipline:discipline.html.twig', ['form' => $form->createView(), 'disciplines' => $listDiscipline]);
    }

    /**
     * @Route("discipline/{id}", name="single_discipline_show")
     */
    public function singleDisciplineAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $discipline = $em->getRepository(Discipline::class)
            ->find($id);
        $form = $this->createForm(DisciplineType::class, $discipline);
        $form->handleRequest($request);

        if($form->isValid()) {

            $this->getDoctrine()->getManager()->persist($discipline);
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('notice', $this->get('translator')->trans('notice_discipline_update'));

            return $this->redirectToRoute('discipline_show');
        }

        return $this->render('QuentinBundle:Discipline:showDiscipline.html.twig', ['form' => $form->createView(), 'discipline' => $discipline]);
    }

    /**
     * @Route("discipline/{id}/delete", name="delete_discipline")
     */
    public function deleteDisciplineAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $discipline = $em->getRepository(Discipline::class)
            ->find($id);

        $em->remove($discipline);
        $em->flush();

        $this->addFlash('notice', $this->get('translator')->trans('notice_discipline_delete'));

        return $this->redirectToRoute('discipline_show');
    }
}

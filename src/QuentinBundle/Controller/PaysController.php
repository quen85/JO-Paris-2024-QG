<?php

namespace QuentinBundle\Controller;

use QuentinBundle\Entity\Pays;
use QuentinBundle\Form\PaysType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class PaysController extends Controller
{
    /**
     * @Route("/pays", name="pays_show")
     */
    public function paysAction(Request $request)
    {
        $pays = new Pays();
        $form = $this->createForm(PaysType::class, $pays);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $file = $pays->getFlag();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('flag_directory'),
                $fileName
            );
            $pays->setFlag($fileName);

            $this->getDoctrine()->getManager()->persist($pays);
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('notice', $this->get('translator')->trans('notice_pays_add'));
        }

        $listPays = $this->getDoctrine()
            ->getRepository(Pays::class)
            ->findAll();

        return $this->render('QuentinBundle:Pays:pays.html.twig', ['form' => $form->createView(), 'pays' => $listPays]);
    }

    /**
     * @Route("pays/{id}", name="single_pays_show")
     */
    public function singlePaysAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $pays = $em->getRepository(Pays::class)
            ->find($id);
        $form = $this->createForm(PaysType::class, $pays);
        $form->handleRequest($request);

        if($form->isValid()) {
            $file = $pays->getFlag();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('flag_directory'),
                $fileName
            );
            $pays->setFlag($fileName);

            $this->getDoctrine()->getManager()->persist($pays);
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('notice', $this->get('translator')->trans('notice_pays_update'));

            return $this->redirectToRoute('pays_show');
        }

        return $this->render('QuentinBundle:Pays:showPays.html.twig', ['form' => $form->createView(), 'pays' => $pays]);
    }

    /**
     * @Route("pays/{id}/delete", name="delete_pays")
     */
    public function deletePaysAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $pays = $em->getRepository(Pays::class)
            ->find($id);
        $file = $pays->getFlag();
        unlink($this->getParameter('flag_directory').'/'.$file);

        $em->remove($pays);
        $em->flush();

        $this->addFlash('notice', $this->get('translator')->trans('notice_pays_delete'));

        return $this->redirectToRoute('pays_show');
    }
}

<?php

namespace QuentinBundle\Controller;

use QuentinBundle\Entity\Ville;
use QuentinBundle\Form\VilleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class VilleController extends Controller
{
    /**
     * @Route("/ville", name="ville_show")
     */
    public function villeAction(Request $request)
    {

        if ($request->isXmlHttpRequest()) {
            $form = $request->get('ville');
            if(empty($form['name'])){
                $msg = array('type' => 'error', 'msg' => 'Veuillez renseigner un nom');
            }
            else{
                $ville = new Ville();
                $ville->setName($form['name']);
                $this->getDoctrine()->getManager()->persist($ville);
                $this->getDoctrine()->getManager()->flush();

                $this->addFlash('notice', $this->get('translator')->trans('notice_ville_add'));

                $form = $this->createForm(VilleType::class, $ville);

                $listVilles = $this->getDoctrine()
                    ->getRepository(Ville::class)
                    ->findAll();

                $template = $this->get('twig')->render('QuentinBundle:Ville:ville.html.twig', ['form' => $form->createView(), 'villes' => $listVilles]);

                $msg = array('type' => 'success', 'msg' => $this->get('translator')->trans('notice_ville_add'), 'template' => $template);
            }

            return new JsonResponse($msg);
        }

        $ville = new Ville();
        $form = $this->createForm(VilleType::class, $ville);

        $form->handleRequest($request);

        $listVilles = $this->getDoctrine()
            ->getRepository(Ville::class)
            ->findAll();

        return $this->render('QuentinBundle:Ville:ville.html.twig', ['form' => $form->createView(), 'villes' => $listVilles]);
    }

    /**
     * @Route("ville/{id}", name="single_ville_show")
     */
    public function singleVilleAction(Request $request, $id)
    {
        if ($request->isXmlHttpRequest()){

            if($_POST['type'] == "update"){
                $em = $this->getDoctrine()->getManager();
                $ville = $em->getRepository(Ville::class)
                    ->find($id);
                $form = $this->createForm(VilleType::class, $ville);

                $form->handleRequest($request);

                $ville->setName($_POST['name']);

                $this->getDoctrine()->getManager()->persist($ville);
                $this->getDoctrine()->getManager()->flush();

                $listVilles = $this->getDoctrine()
                    ->getRepository(Ville::class)
                    ->findAll();

                $template = $this->get('twig')->render('QuentinBundle:Ville:ville.html.twig', ['form' => $form->createView(), 'villes' => $listVilles]);

                $msg = array('type' => 'success', 'msg' => $this->get('translator')->trans('notice_ville_update'), 'template' => $template);
            }

            else{
                $em = $this->getDoctrine()->getManager();
                $ville = $em->getRepository(Ville::class)
                    ->find($id);
                $form = $this->createForm(VilleType::class, $ville);

                $form->handleRequest($request);

                $template = $this->get('twig')->render('QuentinBundle:Ville:showVille.html.twig', ['form' => $form->createView(), 'ville' => $ville]);

                $msg = array('template' => $template);
            }
        }

        return new JsonResponse($msg);

    }

    /**
     * @Route("ville/{id}/delete", name="delete_ville")
     */
    public function deleteVilleAction(Request $request, $id)
    {
        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $ville = $em->getRepository(Ville::class)
                ->find($id);

            $em->remove($ville);
            $em->flush();

            $ville = new Ville();
            $form = $this->createForm(VilleType::class, $ville);

            $form->handleRequest($request);

            $listVilles = $this->getDoctrine()
                ->getRepository(Ville::class)
                ->findAll();

            $template = $this->get('twig')->render('QuentinBundle:Ville:ville.html.twig', ['form' => $form->createView(), 'villes' => $listVilles]);

            $msg = array('type' => 'success', 'msg' => $this->get('translator')->trans('notice_ville_delete'), 'template' => $template);

        }

        return new JsonResponse($msg);
    }
}
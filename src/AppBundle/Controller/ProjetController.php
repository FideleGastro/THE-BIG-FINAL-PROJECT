<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Projet;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ProjetController extends Controller
{
    /**
     * @Route("/projet/select/{id}")
     */
    public function selectAction($id)
    {
        $em = $this
            ->getDoctrine()
            ->getManager();

        $currentprojet = $this
            ->getDoctrine()
            ->getRepository(Projet::class)
            ->findOneByCurrent(true);
        if($currentprojet){
            $currentprojet->setCurrent(false);
            $em->persist($currentprojet);
        }

        $projet = $this
            ->getDoctrine()
            ->getRepository(Projet::class)
            ->findOneById($id);
        $projet->setCurrent(true);
        $em->persist($projet);

        $em->flush();
        return $this->redirectToRoute('projet');
    }

    /**
     * @Route("/projet/delete/{id}")
     */
    public function deleteAction($id)
    {

        $em = $this
            ->getDoctrine()
            ->getManager();

        $projet = $this
            ->getDoctrine()
            ->getRepository(Projet::class)
            ->findOneById($id);

        $em->remove($projet);
        $em->flush();
        return $this->redirectToRoute('projet');
    }

}

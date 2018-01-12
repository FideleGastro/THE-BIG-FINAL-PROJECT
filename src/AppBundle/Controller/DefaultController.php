<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Entity\Projet;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();

        if($user == 'anon.')
            return $this->redirectToRoute('fos_user_security_login');

        $_SESSION['user'] = $user->getUsername();

        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/result", name="result")
     */
    public function resultAction(Request $request)
    {
        if ($request->isMethod('POST'))
            $query = $request->get('query');

        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $currentprojet = $this
            ->getDoctrine()
            ->getRepository(Projet::class)
            ->findOneBy(array('user' => $user->getUsername(), 'current' => true));

        $response = $this->forward('MyBioApiBundle:EuropePMC:query', array(
            'query' => $query,
        ));
        $response = json_decode($response->getContent(), true);
        //dump($response);
        if($query)
            return $this->render('default/result.html.twig', [
                'request' => $response,
                'query' => $query,
                'current' => $currentprojet,
            ]);
        else
            return $this->render('default/index.html.twig', [
                'query' => $query
            ]);
    }

    /**
     * @Route("/projet", name="projet")
     */
    public function projetListeAction(Request $request)
    {
        $query = 'test';
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        if ($request->isMethod('POST')){

            $query = $request->get('newProject');

            $em = $this->getDoctrine()->getManager();
            $newProjet = new Projet();

            $newProjet
                ->setUser($user->getUsername())
                ->setName($query)
                ->setCurrent(false);

            $em->persist($newProjet);
            $em->flush();

        }


        $currentprojet = $this
            ->getDoctrine()
            ->getRepository(Projet::class)
            ->findOneBy(array('user' => $user->getUsername(), 'current' => true));

        $allprojet = $this
            ->getDoctrine()
            ->getRepository(Projet::class)
            ->findBy(array('user' => $user->getUsername()));

        $em = $this->getDoctrine()->getManager();
        $article = $this
            ->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();

        return $this->render('default/projet.html.twig', [
           'article' => $article,
            'user' => $user,
           'query' => $query,
            'currentprojet' => $currentprojet,
            'allprojet' => $allprojet,
        ]);
    }


}

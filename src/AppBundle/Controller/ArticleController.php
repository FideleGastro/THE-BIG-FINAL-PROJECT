<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\Article;
use Doctrine\ORM\Mapping as ORM;

class ArticleController extends Controller
{

    /**
     * @Route("/article")
     */
    public function indexAction()
    {
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();
        return $this->render('default/list.html.twig', array(
            'article' => $article
        ));
    }

    /**
     * @Route("/article/get/{id}")
     */
    public function getAction($id)
    {
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findByPmid($id);

        if (!$article)
            return new JsonResponse(array("success"=>'false'));
        else
            return new JsonResponse(array("success"=>'true'));
    }

    /**
     * @Route("/article/post/{id}")
     */
    public function postAction($id)
    {
        $query = $id;
        $response = $this->forward('MyBioApiBundle:EuropePMC:query', array(
            'query' => $query,
        ));
        $response = json_decode($response->getContent(), true);
        dump($response['resultList']['result'][0]);

        $em = $this->getDoctrine()->getManager();
        $article = new Article();
        $article
            ->setAuthor($response['resultList']['result'][0]['authorString'])
            ->setContent($response['resultList']['result'][0]['abstractText'])
            ->setDate($response['resultList']['result'][0]['firstPublicationDate'])
            ->setJournal($response['resultList']['result'][0]['journalInfo']['journal']['title'])
            ->setLink($response['resultList']['result'][0]['fullTextUrlList']['fullTextUrl'][0]['url'])
            ->setTitle($response['resultList']['result'][0]['title'])
            ->setPmid($response['resultList']['result'][0]['id']);
        $em->persist($article);
        $em->flush();
        return $this->render('default/list.html.twig', array(
            'response' => $id,
            'query' => $response
        ));
    }

    /**
     * @Route("/article/delete/{id}")
     */
    public function deleteAction($id)
    {
        $em = $this
            ->getDoctrine()
            ->getManager();
        $article = $this
            ->getDoctrine()
            ->getRepository(Article::class)
            ->findByPmid($id);
        dump($article);
        if (!$article)
            return new JsonResponse(array("success"=>'false'));
        else{
            $em->remove($article[0]);
            $em->flush();
            return new JsonResponse(array("success"=>'true'));
        }
    }
}

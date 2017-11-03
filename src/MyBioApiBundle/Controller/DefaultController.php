<?php

namespace MyBioApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    /**
     * @Route("/api/")
     */
    public function indexAction()
    {
        return $this->render('MyBioApiBundle:Default:index.html.twig');
    }

    /**
     * @Route("/api/query/{query}")
     */
    public function getAction($query)
    {
        $json_url = "https://www.ebi.ac.uk/europepmc/webservices/test/rest/search?query=".$query."&format=json&resulttype=core";
        $json = file_get_contents($json_url);
        $data = json_decode($json, TRUE);
        $data = new JsonResponse($data);
        return $data;
    }

    /**
     * @Route("/api/query/{query}/{option}")
     */
    public function sgetAction($query, $option)
    {
        $json_url = "https://www.ebi.ac.uk/europepmc/webservices/test/rest/search?query=".$option.":".$query."&format=json&resulttype=core";
        $json = file_get_contents($json_url);
        $data = json_decode($json, TRUE);
        $data = new JsonResponse($data);
        return $data;
    }
}

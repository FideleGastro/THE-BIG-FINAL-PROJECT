<?php

namespace MyBioApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class EuropePMCController extends Controller
{
    /**
     * @Route("/query/{query}")
     */
    public function queryAction($query)
    {
        $json_url = "https://www.ebi.ac.uk/europepmc/webservices/test/rest/search?query=".$query."&format=json&resulttype=core";
        $json = file_get_contents($json_url);
        $data = json_decode($json, TRUE);
        $data = new JsonResponse($data);
        return $data;
    }

}

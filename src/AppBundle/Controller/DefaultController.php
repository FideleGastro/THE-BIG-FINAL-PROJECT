<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction(Request $request)
    {

        if ($request->isMethod('POST'))
            $valid = $request->get('query');
        else
            $valid = 'no';
        $response = $this->forward('MyBioApiBundle:Default:get', array(
            'query'  => 'toto',
        ));
        $response = json_decode($response->getContent(), true);
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'request' => $response,
            'test' => $valid
        ]);
    }
}

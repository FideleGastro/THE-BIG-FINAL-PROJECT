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
    public function indexAction()
    {

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

            $response = $this->forward('MyBioApiBundle:EuropePMC:query', array(
                'query' => $query,
            ));
            $response = json_decode($response->getContent(), true);
            dump($response);

            if($query)
            return $this->render('default/result.html.twig', [
                'request' => $response,
                'query' => $query
            ]);
            else
                return $this->render('default/index.html.twig', [
                    'request' => $response
                ]);

        }

}

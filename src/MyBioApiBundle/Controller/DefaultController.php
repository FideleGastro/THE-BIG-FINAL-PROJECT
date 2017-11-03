<?php

namespace MyBioApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/api/")
     */
    public function indexAction()
    {
        return $this->render('MyBioApiBundle:Default:index.html.twig');
    }
}

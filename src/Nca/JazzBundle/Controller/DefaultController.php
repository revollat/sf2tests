<?php

namespace Nca\JazzBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('NcaJazzBundle:Default:index.html.twig', array('name' => $name));
    }
}

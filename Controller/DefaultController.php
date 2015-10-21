<?php

namespace Restful\SampleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('RestfulSampleBundle:Default:index.html.twig', array('name' => $name));
    }
}

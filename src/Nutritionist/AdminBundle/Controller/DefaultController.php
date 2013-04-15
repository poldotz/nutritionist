<?php

namespace Nutritionist\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name)
    {

        $meal = new Meal();
        $meal->setName('Breakfast');
        $em = $this->getDoctrine()->getManager();
        $em->persist($meal);
        $em->flush();
        return array('name' => $name);
    }
}

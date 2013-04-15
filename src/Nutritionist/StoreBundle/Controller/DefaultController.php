<?php

namespace Nutritionist\StoreBundle\Controller;

use Goutte\Client;
use Nutritionist\StoreBundle\Entity\Category;
use Nutritionist\StoreBundle\Entity\Food;
use Nutritionist\StoreBundle\Entity\FoodNutrient;
use Nutritionist\StoreBundle\Entity\Meal;
use Nutritionist\StoreBundle\Entity\Nutrient;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\DomCrawler\Link;
use Symfony\Component\Form\Extension\Core\EventListener\FixCheckboxInputListener;


class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction()
    {


        //$em = $this->getDoctrine()->getManager();

        /*
         * Load Category Fixtures;
         */
        //$em->getRepository('NutritionistStoreBundle:Category')->loadCategories();
        /*
         * Load Nutrient Fixtures;
         */
        //$em->getRepository('NutritionistStoreBundle:Nutrient')->loadNutrients();

        /*
         * Load Food Fixtures;
         */
        //$em->getRepository('NutritionistStoreBundle:Food')->loadFoods();


        /*
         * Load FoodNutrient Fixtures;
         */
        //$em->getRepository('NutritionistStoreBundle:FoodNutrient')->loadFoodNutrient();


        return array('name' => 'Stefania');
    }

    private function ediblePartMisureUnit($textContent)
    {
        $start_pos = 0;
        $end_pos = 0;
        $start_pos = strpos($textContent,'(');
        $end_pos = strpos($textContent,')');
        $base_name = trim(substr($textContent,0,$start_pos));
        if($start_pos >0 && $end_pos > 0){
            $misure_unit = trim(substr($textContent,$start_pos+1,($end_pos - $start_pos)-1));
            switch($misure_unit){
                case "g":
                    $misure_unit = "(g/100g p.e.)";
                    break;
                case "mg":
                    $misure_unit = "(mg/100g p.e.)";
                    break;
                case "kcal":
                    $misure_unit = "(kcal/100g p.e.)";
                    break;
                case "kJ":
                    $misure_unit = "(kJ/100g p.e.)";
                    break;
                default:
                    $misure_unit = "";
            }
        }
        return $base_name." ".$misure_unit;
    }
}
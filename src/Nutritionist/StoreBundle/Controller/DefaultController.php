<?php

namespace Nutritionist\StoreBundle\Controller;

use Goutte\Client;
use Nutritionist\StoreBundle\Entity\Category;
use Nutritionist\StoreBundle\Entity\Food;
use Nutritionist\StoreBundle\Entity\FoodNutrient;
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
        $em = $this->getDoctrine()->getManager();

        /*
         * Load Category Fixtures;
         */
        //$em->getRepository('NutritionistStoreBundle:Category')->loadCategories();
        /*
         * Load Nutrient Fixtures;
         */
        //$em->getRepository('NutritionistStoreBundle:Nutrient')->loadNutrients();

        $client = new Client();
        $crawler = $client->request('GET','http://www.inran.it/646/tabelle_di_composizione_degli_alimenti.html?alimento=&nutriente=tutti&categoria=tutte&quant=100&submitted1=TRUE&sendbutton=Cerca');
        $nodes = $crawler->filter('.elencoalim');
        if ($nodes->count())
        {
            foreach($nodes as $node){

                $href="http://www.inran.it";
                $href .= $node->firstChild->getAttribute('href');
                $link = new Link($node->firstChild,$href);
                $crawler_link = $client->click($link);
                $tab1 = $crawler_link->filter('.Tabella1');

                // Food
                $trs = $tab1->first()->children();
                $tr = $trs->first();
                $th = $tr->children();
                $food_name = $th->text(); //food

                // category
                $td_category = $th->siblings()->children()->siblings();
                $category = $td_category->text();
                $cat_repo = $this->getDoctrine()->getRepository('NutritionistStoreBundle:Category');
                $cat = $cat_repo->findOneByName($category);

                // save food
                $food = new Food();
                $food->setName($food_name);
                $food->setCategory($cat);
                $em->persist($food);

                //$em->flush();
                $i = 0;
                foreach($tab1->eq(1)->filterXPath('//tr') as $tr_node){
                    if(is_object($tr_node->childNodes->item(0)) and $tr_node->childNodes->item(0)->tagName == 'td'){
                        $td = $tr_node->childNodes->item(0);
                        $nutrient_name = $this->ediblePartMisureUnit($td->textContent);

                        $nutrient = $em->getRepository('NutritionistStoreBundle:Nutrient')->findByNameLike($nutrient_name);
                        echo $nutrient->getName();
                    }

                    if(is_object($tr_node->childNodes->item(1)) and $tr_node->childNodes->item(1)->nodeName == 'td'){
                        $value = "";
                        $value = trim($tr_node->childNodes->item(1)->textContent);
                        if(is_numeric($value)){
                            $value = $value;
                            $note = "";
                        }
                        elseif(is_string($value)){
                            $note = $value;
                            $value = 0;
                        }
                        else{
                            $note = $value;
                            $value = 0;

                        }
                        echo $value." ";
                        echo $note."<br/>";
                    }
                    $foodNutrient = new FoodNutrient();
                    $foodNutrient->setFood($food);
                    $foodNutrient->setNutrient($nutrient);
                    $foodNutrient->setFoodNutrient($value);
                    $foodNutrient->setNote($note);


                    ++$i;
                    if($i > 29){die();}



                }
            }
            return array('name' => 'Stefania');
        }
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
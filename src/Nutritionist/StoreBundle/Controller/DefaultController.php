<?php

namespace Nutritionist\StoreBundle\Controller;

use Goutte\Client;
use Nutritionist\StoreBundle\Entity\Category;
use Nutritionist\StoreBundle\Entity\Food;
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
                        $pos = strpos($td->textContent,'(');
                        $nutrient_name = substr($td->textContent,0,$pos);
                        echo $nutrient_name."--> ";
                        $nutrient = $em->getRepository('NutritionistStoreBundle:Nutrient')->findByNameLike($nutrient_name);
                        var_dump($nutrient);
                        ++$i;


                        //$nutrient = new Nutrient();
                        //$nutrient->setName($td->textContent);
                    }
                    /*if(is_object($tr_node->childNodes->item(1)) and $tr_node->childNodes->item(1)->tagName == 'td'){

                    }*/
                    //print_r($tr_node->childNodes->item(1));
                    echo "<br/><br/><br/>";
                }


            }
        }




        return array('name' => 'Stefania');
    }
}

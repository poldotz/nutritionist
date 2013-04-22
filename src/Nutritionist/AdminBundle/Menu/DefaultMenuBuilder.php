<?php
/**
 * Created by JetBrains PhpStorm.
 * User: poldotz
 * Date: 18/04/13
 * Time: 23.19
 * To change this template use File | Settings | File Templates.
 */

namespace Nutritionist\AdminBundle\Menu;
use Admingenerator\GeneratorBundle\Menu\AdmingeneratorMenuBuilder;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Router;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;


class DefaultMenuBuilder extends AdmingeneratorMenuBuilder {


    /**
     * @param \Knp\Menu\FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
        $this->dividers = array();
    }


    public function createAdminMenu(Request $request)
    {
        $menu = parent::createAdminMenu($request);

        $menu->addChild('Category', array('route' => 'Nutritionist_StoreBundle_CategoryAdmin_list'));
        $menu->addChild('Food', array('route' => 'Nutritionist_StoreBundle_FoodAdmin_list'));
        //$menu->addChild('Nutrient', array('route' => 'NutritionistStoreBundle_admin_nutritionist_store_bundle_NutrinetAdmin'));


        //$dropdownMenu = $this->addDropdownMenu($menu, 'Nutrient',true);
        //$dropdownMenu->addChild('Item1', array('route' => 'Your_RouteName'));
        //$this->addDivider($dropdownMenu);
        //$dropdownMenu->addChild('Item2', array('route' => 'Your_RouteName'));

        return $menu;
    }

}
<?php

namespace Nutritionist\StoreBundle\Controller\CategoryAdmin;

use Admingenerated\NutritionistStoreBundle\BaseCategoryAdminController\ListController as BaseListController;

class ListController extends BaseListController
{

    /*protected function getFilterForm()
    {
        $filters = $this->getFilters();
        $filters_like = array();
        foreach($filters as $key =>$value){
            if(is_string($value)){
                $value = "%".$value."%";
            }
            $filters_like[$key]=$value;
        }
        return $this->createForm($this->getFiltersType(), $filters_like);
    }*/

}

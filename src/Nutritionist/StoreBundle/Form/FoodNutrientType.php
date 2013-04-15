<?php

namespace Nutritionist\StoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FoodNutrientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('foodNutrient')
            ->add('note')
            ->add('food')
            ->add('nutrient')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Nutritionist\StoreBundle\Entity\FoodNutrient'
        ));
    }

    public function getName()
    {
        return 'nutritionist_storebundle_foodnutrienttype';
    }
}

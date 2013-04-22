<?php
/**
 * Created by JetBrains PhpStorm.
 * User: poldotz
 * Date: 20/04/13
 * Time: 8.56
 * To change this template use File | Settings | File Templates.
 */

namespace Nutritionist\StoreBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class SearchTypeExtension extends AbstractTypeExtension
{
    /**
     * Restituisce il nome del tipo da estendere.
     *
     * @return string Il nome del tipo da estendere
     */
    public function getExtendedType()
    {
        return 'search';
    }

    /**
     * Aggiunge l'opzione like
     *
     * @param \Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setOptional(array('like'));
    }
}
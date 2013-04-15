<?php
/**
 * Created by JetBrains PhpStorm.
 * User: poldotz
 * Date: 13/04/13
 * Time: 0.20
 * To change this template use File | Settings | File Templates.
 */

namespace Nutritionist\StoreBundle\DataFixture\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nutritionist\StoreBundle\Entity\Meal;
use Gedmo\Mapping\Annotation as Gedmo;

class LoadMealData implements FixtureInterface {


    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        $meal = new Meal();
        $meal->setName('Colazione');
        $manager->persist($meal);
        $manager->flush();

        $meal->setName('Breakfast');
        $meal->setTranslatableLocale('en_us'); // change locale
        $manager->persist($meal);
        $manager->flush();

        $meal = new Meal();
        $meal->setName('Spuntino');
        $manager->persist($meal);
        $manager->flush();

        $meal->setName('Snack');
        $meal->setTranslatableLocale('en_us'); // change locale
        $manager->persist($meal);
        $manager->flush();


        $meal = new Meal();
        $meal->setName('Pranzo');
        $manager->persist($meal);
        $manager->flush();

        $meal->setName('Lunch');
        $meal->setTranslatableLocale('en_us'); // change locale
        $manager->persist($meal);
        $manager->flush();

        $meal = new Meal();
        $meal->setName('Cena');
        $manager->persist($meal);
        $manager->flush();

        $meal->setName('Dinner');
        $meal->setTranslatableLocale('en_us'); // change locale
        $manager->persist($meal);
        $manager->flush();

        $meal = new Meal();
        $meal->setName('Pasto Libero');
        $manager->persist($meal);
        $manager->flush();

        $meal->setName('Free Meal');
        $meal->setTranslatableLocale('en_us'); // change locale
        $manager->persist($meal);
        $manager->flush();


    }

}
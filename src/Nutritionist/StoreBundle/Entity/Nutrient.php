<?php

namespace Nutritionist\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nutrient
 *
 * @ORM\Table()
 *  @ORM\Entity(repositoryClass="Nutritionist\StoreBundle\Entity\NutrientRepository")
 */
class Nutrient
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", unique=true)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="note", type="string", nullable=true)
     */
    private $note;


    /**
     * @ORM\OneToMany(targetEntity="FoodNutrient", mappedBy="nutrient")
     */
    protected $foodNutrients;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     * Set name
     *
     * @param text $name
     * @return Nutrient
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return integer
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->foodNutrients = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add foodNutrients
     *
     * @param \Nutritionist\StoreBundle\Entity\FoodNutrient $foodNutrients
     * @return Nutrient
     */
    public function addFoodNutrient(\Nutritionist\StoreBundle\Entity\FoodNutrient $foodNutrients)
    {
        $this->foodNutrients[] = $foodNutrients;
    
        return $this;
    }

    /**
     * Remove foodNutrients
     *
     * @param \Nutritionist\StoreBundle\Entity\FoodNutrient $foodNutrients
     */
    public function removeFoodNutrient(\Nutritionist\StoreBundle\Entity\FoodNutrient $foodNutrients)
    {
        $this->foodNutrients->removeElement($foodNutrients);
    }

    /**
     * Get foodNutrients
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFoodNutrients()
    {
        return $this->foodNutrients;
    }

    /**
     * Set note
     *
     * @param string $note
     * @return Nutrient
     */
    public function setNote($note)
    {
        $this->note = $note;
    
        return $this;
    }

    /**
     * Get note
     *
     * @return string 
     */
    public function getNote()
    {
        return $this->note;
    }
}
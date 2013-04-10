<?php

namespace Nutritionist\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FoodNutrient
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Nutritionist\StoreBundle\Entity\FoodNutrientRepository")
 */
class FoodNutrient
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
     * @ORM\ManyToOne(targetEntity="Food", inversedBy="foodNutrients")
     * @ORM\JoinColumn(name="food_id", referencedColumnName="id")
     */
    protected $food;


    /**
     * @ORM\ManyToOne(targetEntity="Nutrient", inversedBy="foodNutrients")
     * @ORM\JoinColumn(name="nutrient_id", referencedColumnName="id")
     */
    protected $nutrient;

    /**
     * @var decimal
     * @ORM\Column(name="food_nutrient", type="decimal", scale=2, precision=2)
     *
     */
    protected $foodNutrient;

    /**
     * @var string
     * @ORM\Column(name="note", type="string", nullable=true)
     */
    protected $note;



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
     * Set foodNutrient
     *
     * @param float $foodNutrient
     * @return FoodNutrient
     */
    public function setFoodNutrient($foodNutrient)
    {
        $this->foodNutrient = $foodNutrient;
    
        return $this;
    }

    /**
     * Get foodNutrient
     *
     * @return float 
     */
    public function getFoodNutrient()
    {
        return $this->foodNutrient;
    }

    /**
     * Set food
     *
     * @param \Nutritionist\StoreBundle\Entity\food $food
     * @return FoodNutrient
     */
    public function setFood(\Nutritionist\StoreBundle\Entity\food $food = null)
    {
        $this->food = $food;
    
        return $this;
    }

    /**
     * Get food
     *
     * @return \Nutritionist\StoreBundle\Entity\food 
     */
    public function getFood()
    {
        return $this->food;
    }

    /**
     * Set nutrient
     *
     * @param \Nutritionist\StoreBundle\Entity\nutrient $nutrient
     * @return FoodNutrient
     */
    public function setNutrient(\Nutritionist\StoreBundle\Entity\nutrient $nutrient = null)
    {
        $this->nutrient = $nutrient;
    
        return $this;
    }

    /**
     * Get nutrient
     *
     * @return \Nutritionist\StoreBundle\Entity\nutrient 
     */
    public function getNutrient()
    {
        return $this->nutrient;
    }

    /**
     * Set note
     *
     * @param string $note
     * @return FoodNutrient
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
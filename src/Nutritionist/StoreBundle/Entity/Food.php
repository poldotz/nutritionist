<?php

namespace Nutritionist\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Food
 *
 * @ORM\Table()
 *  @ORM\Entity(repositoryClass="Nutritionist\StoreBundle\Entity\FoodRepository")
 */
class Food
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
     * @Gedmo\Translatable
     * @ORM\Column(name="name", unique=true, type="string")
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="foods")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;

    /**
     * @Gedmo\Translatable
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(name="slug", type="string")
     */
    private $slug;

    /**
     * @Gedmo\Locale
     * Used locale to override Translation listener`s locale
     * this is not a mapped field of entity metadata, just a simple property
     */
    private $locale;

    /**
     * @ORM\OneToMany(targetEntity="FoodNutrient", mappedBy="food")
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
     * @return Food
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return text
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set category
     *
     * @param \Nutritionist\StoreBundle\Entity\Category $category
     * @return Food
     */
    public function setCategory(\Nutritionist\StoreBundle\Entity\Category $category = null)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return \Nutritionist\StoreBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
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
     * @return Food
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
     * Set slug
     *
     * @param string $slug
     * @return Food
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }
}
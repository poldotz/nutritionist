<?php

namespace Nutritionist\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Category
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Nutritionist\StoreBundle\Entity\CategoryRepository")
 */
class Category
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
     * @ORM\Column(name="name", unique=true, type="string", length=250)
     */
    private $name;

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
     * @ORM\OneToMany(targetEntity="Food", mappedBy="category")
     */
    protected $foods;


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
     * @param string $name
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string
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
        $this->foods = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add foods
     *
     * @param \Nutritionist\StoreBundle\Entity\Food $foods
     * @return Category
     */
    public function addFood(\Nutritionist\StoreBundle\Entity\Food $foods)
    {
        $this->foods[] = $foods;
    
        return $this;
    }

    /**
     * Remove foods
     *
     * @param \Nutritionist\StoreBundle\Entity\Food $foods
     */
    public function removeFood(\Nutritionist\StoreBundle\Entity\Food $foods)
    {
        $this->foods->removeElement($foods);
    }

    /**
     * Get foods
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFoods()
    {
        return $this->foods;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Category
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
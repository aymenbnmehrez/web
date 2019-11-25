<?php
// src/AppBundle/Entity/User.php

namespace UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private $first_name;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private $last_name;
    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */
    private $image;
//    /**
//     * @ORM\@ManyToMany(targetEntity="AppBundle\Entity\Category")
//     * @JoinTable(name="provider_category",
//     *     JoinColumns={@JoinColumn(name="id",referencedColumnName="id")},       
//     *     inverseJoinColumns={@JoinColumn(name="category_id",referencedColumnName="id")}
//     *     )
//     */
//    private  $categories;
      /**
       * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Category")
       * @ORM\JoinTable(name="provider_category",
       *      joinColumns={@JoinColumn(name="id", referencedColumnName="id")},
       *      inverseJoinColumns={@JoinColumn(name="category_id", referencedColumnName="category_id")}
       *      )
       **/
    private $categories;
    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Ad",mappedBy="user")
     */
    private $ads;
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\AskService",mappedBy="user")
     */
    private $ask_services;
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Post",mappedBy="user")
     */
    private $posts;
    /**
     * @return ArrayCollection
     */
    public function getAds()
    {
        return $this->ads;
    }

    /**
     * @param ArrayCollection $ads
     */
    public function setAds($ads)
    {
        $this->ads = $ads;
    }

    /**
     * @return mixed
     */
    public function getAskServices()
    {
        return $this->ask_services;
    }

    /**
     * @param mixed $ask_services
     */
    public function setAskServices($ask_services)
    {
        $this->ask_services = $ask_services;
    }

    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $categories
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param mixed $first_name
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param mixed $last_name
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    public function __construct()
    {
        parent::__construct();
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();  // your own logic
        $this->ads = new ArrayCollection();  // your own logic
        $this->ask_services = new ArrayCollection();  // your own logic
        $this->posts = new ArrayCollection();  // your own logic



        // your own logic
    }
}

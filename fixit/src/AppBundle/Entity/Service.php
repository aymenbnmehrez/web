<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="service")
 */
class Service
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $service_id;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $name;
    /**
     * @ORM\ManyToOne(targetEntity="category",inversedBy="services")
     * @ORM\JoinColumn(name="category_id",referencedColumnName="category_id")
     */
    private $category;

    /**
     * @return mixed
     */
    public function getServiceId()
    {
        return $this->service_id;
    }

    /**
     * @param mixed $service_id
     */
    public function setServiceId($service_id)
    {
        $this->service_id = $service_id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

}
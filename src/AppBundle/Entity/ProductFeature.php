<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductFeature
 *
 * @ORM\Table(name="product_feature")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductFeatureRepository")
 */
class ProductFeature
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="featureValue", type="string", length=100)
     */
    private $featureValue;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    private $updated;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set featureValue
     *
     * @param string $featureValue
     *
     * @return ProductFeature
     */
    public function setFeatureValue($featureValue)
    {
        $this->featureValue = $featureValue;

        return $this;
    }

    /**
     * Get featureValue
     *
     * @return string
     */
    public function getFeatureValue()
    {
        return $this->featureValue;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return ProductFeature
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return ProductFeature
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }
}


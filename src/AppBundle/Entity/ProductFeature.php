<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

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
     * @Gedmo\Timestampable(on="create")
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="update")
     */
    private $updated;

    /**
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Product", inversedBy="features")
     */
    private $product;

    /**
     * @var Feature
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Feature", cascade={"persist"})
     */
    private $feature;

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
     */
    public function setFeatureValue($featureValue)
    {
        $this->featureValue = $featureValue;
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
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
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

    /**
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param Product $product
     */
    public function setProduct($product)
    {
        $this->product = $product;
    }

    /**
     * @return Feature
     */
    public function getFeature()
    {
        return $this->feature;
    }

    /**
     * @param Feature $feature
     */
    public function setFeature($feature)
    {
        $this->feature = $feature;
    }

    public function getFeatureName()
    {
        return $this->feature->getName();
    }
}


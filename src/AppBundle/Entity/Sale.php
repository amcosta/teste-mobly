<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Sale
 *
 * @ORM\Table(name="sale")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SaleRepository")
 */
class Sale
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
     * @var float'
     *
     * @ORM\Column(name="shipping", type="decimal", precision=10, scale=2)
     */
    private $shipping;

    /**
     * @var Address
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Address")
     */
    private $deliveryAddress;

    /**
     * @var Customer
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Customer")
     */
    private $customer;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\SaleItem", mappedBy="sale", cascade={"all"})
     */
    private $items;

    /**
     * @var SaleStatus
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\SaleStatus")
     */
    private $status;

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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getShipping()
    {
        return $this->shipping;
    }

    /**
     * @param float $shipping
     */
    public function setShipping($shipping)
    {
        $this->shipping = $shipping;
    }

    /**
     * @return Address
     */
    public function getDeliveryAddress()
    {
        return $this->deliveryAddress;
    }

    /**
     * @param Address $deliveryAddress
     */
    public function setDeliveryAddress($deliveryAddress)
    {
        $this->deliveryAddress = $deliveryAddress;
    }

    /**
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param Customer $customer
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    /**
     * @return ArrayCollection
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param ArrayCollection $items
     */
    public function setItems($items)
    {
        $this->items = array_map(function (SaleItem $item) {
            $item->setSale($this);
            return $item;
        }, $items);
    }

    /**
     * @return SaleStatus
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param SaleStatus $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    public function calculateSubTotal()
    {
        return array_reduce($this->items, function ($total, SaleItem $saleItem) {
            $total += $saleItem->calculateTotal();
            return $total;
        }, 0);
    }

    public function calculateTotal()
    {
        $subTotal = $this->calculateSubTotal();

        return $subTotal + $this->shipping;
    }
}


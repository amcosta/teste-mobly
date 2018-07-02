<?php

namespace AppBundle\Fixtures;

use AppBundle\Entity\SaleStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SaleStatusFixture extends Fixture
{
    private $data = [
        'Pago',
        'Cancelado',
        'Em transporte',
        'Aguardando pagamento'
    ];

    public function load(ObjectManager $manager)
    {
        foreach ($this->data as $data) {
            $status = new SaleStatus();
            $status->setName($data);

            $manager->persist($status);
        }

        $manager->flush();
    }
}
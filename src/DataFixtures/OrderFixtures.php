<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OrderFixtures extends Fixture
{
    public function getDependencies(): array
    {
        return [
            ProductFixtures::class,
        ];
    }

    public function load(ObjectManager $manager): void
    {
        $product1 = new Product();
        $product1->setCode('COCA')
            ->setLabel('Bouteille de Coca-Cola')
            ->setPrice(1000)
            ->setIsActive(true);

        $product2 = new Product();
        $product2->setCode('FANTA')
            ->setLabel('Bouteille de Fanta')
            ->setPrice(700)
            ->setIsActive(true);

        $product3 = new Product();
        $product3->setCode('PIZZ-INDIAN')
            ->setLabel('Pizza Indian')
            ->setPrice(1500)
            ->setIsActive(true);

        $manager->persist($product1);
        $manager->persist($product2);
        $manager->persist($product3);

        $manager->flush();
    }
}

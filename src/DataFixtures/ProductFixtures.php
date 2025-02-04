<?php

namespace App\DataFixtures;

use App\Entity\Line;
use App\Entity\Order;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $productRepository = $manager->getRepository(Product::class);
        $products = $productRepository->findAll();

        for ($i = 1; $i <= 20; $i++) {
            $order = new Order();
            $order->setStatus(rand(0, 1) ? 'pending' : 'paid')
            ->setCreatedAt(new \DateTimeImmutable())
                ->setCode('ORD' . str_pad($i, 3, '0', STR_PAD_LEFT));

            $lineCount = rand(1, 3);
            $totalAmount = 0;

            for ($j = 0; $j < $lineCount; $j++) {
                $product = $products[array_rand($products)];

                $quantity = rand(1, 5);
                $line = new Line();
                $line->setAmount($product->getPrice())
                    ->setQuantity($quantity)
                    ->setProduct($product);

                $order->addOrderLine($line);

                $totalAmount += $line->getAmount() * $line->getQuantity();
            }

            $order->setAmount($totalAmount);
            $manager->persist($order);
        }

        $manager->flush();
    }
}

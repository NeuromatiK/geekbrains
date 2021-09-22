<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture implements FixtureGroupInterface
{


    public function load(ObjectManager $manager)
    {

        for ($i = 0 ; $i < 10 ; $i++) {

            $product = new Product();
            $product->setTitle('Title_' . $i);
            $product->setPrice($i);
            $product->setDescription('');
            $product->setCategoryId(0);
            $manager->persist($product);
        }
        $manager->flush();
    }

    public static function getGroups() : array
    {

        return [ 'user_post' ];
    }
}

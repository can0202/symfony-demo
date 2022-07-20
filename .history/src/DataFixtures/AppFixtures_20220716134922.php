<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\DBAL\Driver\IBMDB2\Exception\Factory;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        for ($i = 1; $i <= 5; $i++) {
            $post = new Post();
            $post->setTitle('List group item heading' . $i);
            $post->setContent('Some quick example text to build on the card title and make up the bulk of the cards content.');
            $post->setCreatedAt(new \DateTime());
            $manager->persist($post);
        }

        for ($j = 1; $j <= 3; $j++) {
            $category = new Category();
            $category->setTitle('Category title ' . $j);
            $manager->persist($category);
        }

        $manager->flush();
    }
}

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

        for ($i = 1; $i <= 3; $i++) {
            $category = new Category();
            $post->setTitle('Category title ' . $i);
            $manager->persist($category);
        }

        $manager->flush();
    }
}

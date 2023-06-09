<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;
use Faker;

class ProductsFixtures extends Fixture
{

    public function __construct(private readonly SluggerInterface $slugger)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();

        for ($prod = 1; $prod <= 10; $prod++) {
            $product = new Product();
            $product->setName($faker->name());
            $product->setDescription($faker->text(300));
            $product->setSlug($this->slugger->slug($product->getName())->lower());
            $product->setPrice($faker->numberBetween(900, 150000));
            $product->setStock($faker->numberBetween(0, 10));

            //
            $category = $this->getReference('cat-' . rand(1, 8));
            $product->setCategory($category);
            $this->setReference('prod-'.$prod, $product);

            $manager->persist($product);

            $this->addReference('prod-' . $prod, $product);
        }
        $manager->flush();
    }
}

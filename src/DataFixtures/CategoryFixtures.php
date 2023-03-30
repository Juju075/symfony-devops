<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategoryFixtures extends Fixture
{
    private int $counter = 1;


    public function __construct(private readonly SluggerInterface $slugger)
    {
    }

    //SQLSTATE[23000]: Integrity constraint violation: 1451 Cannot delete or update a parent row: a foreign key

    public function load(ObjectManager $manager): void
    {
        $items = [
            'Informatique' => ['Laptops', 'Screen', 'Mouse'],
            'Mode' => ['Man', 'Woman', 'Child']
        ];
        foreach ($items as $category => $array) {

            $this->createCategory(name: $category, manager: $manager, parent: false);
            foreach ($array as $value)
            {
               $this->createCategory(name: $value, manager: $manager, parent: true);

            }
        }
        $manager->flush();
    }

    public function createCategory(string $name, ObjectManager $manager, bool $parent): Category
    {
        $category = new Category();
        $category->setName($name);
        $category->setSlug($this->slugger->slug($category->getName())->lower());
        if ($parent) {
            $category->setParent($category);// will save this category's instance category(name,slug)
        }
        $manager->persist($category);

        //stock la category (reference) mise en memoire d'un element
        $this->addReference('cat-'. $this->counter, $category);
        $this->counter++;

        return $category;
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategoryFixture extends Fixture
{
    public function __construct(private readonly SluggerInterface $slugger)
    {
    }

    //SQLSTATE[23000]: Integrity constraint violation: 1451 Cannot delete or update a parent row: a foreign key

    public function load(ObjectManager $manager): void
    {
        $items = [
            'informatique' => ['Laptops', 'Screen', 'Mouse'],
            'mode' => ['Man', 'Woman', 'Child']
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
            $category->setParent($category); // will save this category's instance category(name,slug)
            //erreur parent_id doit etre la
        }
        $manager->persist($category);
        return $category;
    }
}

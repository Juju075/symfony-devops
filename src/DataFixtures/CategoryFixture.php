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
            'parent' => 'Informatique',
            'category' => 'Ordinateurs portables'
        ];
        foreach ($items as $item => $value) {
            if ($item !== 'parent') {
                $item = $this->createCategory(name: $value, manager: $manager, parent: true);
                continue;
            }
            $item = $this->createCategory(name: $value, manager: $manager, parent: false);
        }
        $manager->flush();
    }

    public function createCategory(string $name, ObjectManager $manager, bool $parent): Category
    {
        $category = new Category();
        $category->setName($name);
        $category->setSlug($this->slugger->slug($category->getName())->lower());
        if ($parent) {
            $category->setParent($category);
        }
        $manager->persist($category);
        return $category;
    }
}

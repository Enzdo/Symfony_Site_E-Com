<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategoriesFixtures extends Fixture
{

    private $counter = 1;

    public function __construct(private SluggerInterface $slugger){}

    public function load(ObjectManager $manager): void
    {
        $parent = $this->createCategory('Gateau', null, $manager);
        
        $this->createCategory('Gateau au chocolat', $parent, $manager);
        $this->createCategory('Gateau a la vanille', $parent, $manager);
        $this->createCategory('Gateau au ammande', $parent, $manager);

        $parent = $this->createCategory('Viennoiserie', null, $manager);

        $this->createCategory('Chausson aux pommes', $parent, $manager);
        $this->createCategory('Chouquette', $parent, $manager);
        $this->createCategory('Corniotte', $parent, $manager);

        $parent = $this->createCategory('Nos specialités', null, $manager);

        $this->createCategory('La religieuse', $parent, $manager);
        $this->createCategory('Les macarons', $parent, $manager);
        $this->createCategory('Les chouquettes', $parent, $manager);
                
        $manager->flush();
    }

    public function createCategory(string $name, Categories $parent = null, ObjectManager $manager)
    {
        $category = new Categories();
        $category->setName($name);
        $category->setSlug($this->slugger->slug($category->getName())->lower());
        $category->setParent($parent);
        $category->setImage('image');
        
        // Condition pour définir la valeur de "category_order"
        if ($this->counter == 1) {
            $category->setCategoryOrder(0);
        } elseif ($this->counter == 12) {
            $category->setCategoryOrder(12);
        } else {
            $category->setCategoryOrder(1);
        }

        $manager->persist($category);

        $this->addReference('cat-'.$this->counter, $category);
        $this->counter++;

        return $category;
    }
}

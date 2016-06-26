<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Category;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCategoryData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $prefillCategories = [
            1 => 'Akt wandalizmu',
            'Problem z infrastrukturą',
            'Oświetlenie i zieleń miejska',
            'Zaśmiecanie',
            'Niebezpieczne miejsce',
        ];

        foreach ($prefillCategories as $catId => $catName) {
            $category = new Category();
            $category->setId($catId);
            $category->setName($catName);
            $manager->persist($category);
        }

        $manager->flush();
    }
}
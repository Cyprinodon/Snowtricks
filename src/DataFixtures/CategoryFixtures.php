<?php

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
  public const CATEGORY_ONE_REFERENCE = "backflip";
  public const CATEGORY_TWO_REFERENCE = "cork";
  public const CATEGORY_THREE_REFERENCE = "air";

  public function load(ObjectManager $manager)
  {
    $categoriesData = [
      [ "name" => "Backflips", "reference" => self::CATEGORY_ONE_REFERENCE ],
      [ "name" => "Vrilles", "reference" => self::CATEGORY_TWO_REFERENCE ],
      [ "name" => "Airs", "reference" => self::CATEGORY_THREE_REFERENCE ]
    ];

    foreach ($categoriesData as $categoryData)
    {
      $category = new Category();

      $category->setUrl($categoryData["name"]);
      $manager->persist();
      $this->addReference($categoryData["reference"], $category);
    }
    $manager->flush();
  }
}
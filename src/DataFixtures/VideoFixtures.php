<?php

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use App\DataFixtures\TrickFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class VideoFixtures extends Fixture implements DependentFixtureInterface
{
  public function Load(ObjectManager $manager)
  {
    $videosData = [
      [
        "url" => "https://youtu.be/Br6ZJM01I6s",
        "trick-reference" => TrickFixtures::TRICK_ONE_REFERENCE,
      ],
      [
        "url" => "https://youtu.be/2Ul5P-KucE8",
        "trick-reference" => TrickFixtures::TRICK_TWO_REFERENCE,
      ],
      [
        "url" => "https://youtu.be/XATkSnCFsRU",
        "trick-reference" => TrickFixtures::TRICK_FOUR_REFERENCE,
      ],
      [
        "url" => "https://youtu.be/vquZvxGMJT0",
        "trick-reference" => TrickFixtures::TRICK_FIVE_REFERENCE,
      ]
    ];

    foreach ($videosData as $videoData)
    {
      $video = new Video();

      $video->setUrl($videoData["url"]);
      $video->setTrick($this->getReference($videoData["trick-reference"]));
      $video->setAddedAt(new \DateTime());

      $manager->persist();
    }
    $manager->flush();
  }

  public function getDependencies()
  {
    return [ TrickFixtures::class ];
  }
}
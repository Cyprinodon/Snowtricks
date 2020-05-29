<?php

namespace App\DataFixtures;

use App\Entity\Message;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class MessageFixtures extends Fixture implements DependentFixtureInterface
{
  public function load(ObjectManager $manager)
  {
    $messagesData = [
      [
        "content" => "Salut à tous. Je viens tout juste de m'inscrire pour dire que j'adore cette figure. Elle est vraiment impressionnante !",
        "user-reference" => UserFixtures::FIRST_USER_REFERENCE,
        "trick-reference" => TrickFixtures::TRICK_ONE_REFERENCE
      ],
      [
        "content" => "Trop Bien.",
        "user-reference" => UserFixtures::FIRST_USER_REFERENCE,
        "trick-reference" => TrickFixtures::TRICK_ONE_REFERENCE
      ],
      [
        "content" => "Cool !!!",
        "user-reference" => UserFixtures::FIRST_USER_REFERENCE,
        "trick-reference" => TrickFixtures::TRICK_TWO_REFERENCE
      ],
      [
        "content" => "Meh, je fais la même chose les yeux bandés.",
        "user-reference" => UserFixtures::FIRST_USER_REFERENCE,
        "trick-reference" => TrickFixtures::TRICK_THREE_REFERENCE
      ],
      [
        "content" => "C'est beau la neige.",
        "user-reference" => UserFixtures::FIRST_USER_REFERENCE,
        "trick-reference" => TrickFixtures::TRICK_FOUR_REFERENCE
      ],
      [
        "content" => "Quelqu'un a déjà essayé ça ?",
        "user-reference" => UserFixtures::FIRST_USER_REFERENCE,
        "trick-reference" => TrickFixtures::TRICK_FIVE_REFERENCE
      ]
    ];

    //Création d'un utilisateur
    foreach($messagesData as $messageData)
    {
      $message = new Message();

      $message->setUser($this->getReference($messageData["user-reference"]));
      $message->setTrick($this->getReference($messageData["trick-reference"]));
      $message->setcontent($messageData["content"]);
      $message->setCreatedAt(new \DateTime());

      $manager->persist($message);
    }
    $manager->flush();
  }

  public function getDependencies()
  {
    return [
      UserFixtures::class,
      TrickFixtures::class
    ];
  }


}
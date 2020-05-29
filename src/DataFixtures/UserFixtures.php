<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
  public const ADMINISTRATOR_REFERENCE = 'administrator';
  public const FIRST_USER_REFERENCE = 'first-user';

  public function __construct(UserPasswordEncoderInterface $encoder)
  {
    $this->encoder = $encoder;
  }

  public function load(ObjectManager $manager)
  {
    $usersData = [
      [
        "username" => "Administrateur",
        "password" => "admin",
        "roles" => ["ROLE_ADMIN"],
        "reference" => self::ADMINISTRATOR_REFERENCE,
      ],
      [
        "username" => "Trickstar101",
        "password" => "MotDePasseSuperSolide",
        "roles" => ["ROLE_USER"],
        "reference" => self::FIRST_USER_REFERENCE,
      ]
    ];
    //Création des utilisateurs
    foreach ($usersData as $userData)
    {
      $user = new User();
      $user->setUsername($userData["username"]);
      $password = $this->encoder->encodePassword($user, $userData["password"]);
      $user->setPassword($password);
      $user->setRoles($userData["roles"]);

      $manager->persist($user);

      $this->addReference($userData["reference"], $user);
    }
    $manager->flush();
  }
}
<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use function Symfony\Component\String\u;

class AppFixtures extends Fixture
{
    private $userPasswordEncoder;
    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User('miguel@gmail.com');
        $password =  $this->userPasswordEncoder->encodePassword($user, '123');
        $user->setPassword($password);
        $manager->persist($user);
        $manager->flush();
    }
}

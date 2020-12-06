<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setName('admin');
        $user->setLastname('A');
        $user->setBirthday(new \DateTime('1999-12-19'));
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'admin01'
        ));

        $userRand = new User();
        $userRand->setUsername('Randal');
        $userRand->setName('Rand');
        $userRand->setLastname('R');
        $userRand->setBirthday(new \DateTime('1999-09-15'));
        $userRand->setRoles(['ROLE_USER']);
        $userRand->setPassword($this->passwordEncoder->encodePassword(
            $userRand,
            'rand01'
        ));

        $manager->persist($user);
        $manager->persist($userRand);
        $manager->flush();
    }
}

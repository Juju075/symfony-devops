<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class UsersFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordEncoder,
        private SluggerInterface            $slugger)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setEmail('monemail@gmail.com');
        $admin->setLastname('prenomtest');
        $admin->setFirstname('nomtest');
        $admin->setAddress('1 rue hoche');
        $admin->setCity('Paris');
        $admin->setZipcode('75001');
        $admin->setPassword($this->passwordEncoder->hashPassword($admin,'admin'));

        $manager->flush();
    }
}

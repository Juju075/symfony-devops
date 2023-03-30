<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Faker;

class UsersFixtures extends Fixture
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordEncoder,
        private SluggerInterface                     $slugger)
    {
    }

    public function load(ObjectManager $manager): void
    {


        $faker = Faker\Factory::create('en_US');
        for ($usr = 1; $usr <= 5; $usr++) {
            $user = new User();
            if ($usr = 1) {
                $role = ['ROLE_ADMIN', 'admin'];
            } else {
                $role = ['ROLE_USER', 'secret'];
            }

            $faker = Faker\Factory::create('en_US');

            //TODO named param
            $user->setRoles([$role[1]]);
            $user->setEmail($faker->email);
            $user->setLastname($faker->lastName);
            $user->setFirstname($faker->firstName);
            $user->setAddress($faker->streetAddress);
            $user->setCity($faker->city);
            $user->setZipcode(str_replace(' ', '', $faker->postcode));
            $user->setPassword($this->passwordEncoder->hashPassword($user, $role[2]));
            $manager->persist($user);
        };
        $manager->flush();
    }
}

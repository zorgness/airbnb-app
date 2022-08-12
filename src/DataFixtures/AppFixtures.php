<?php

namespace App\DataFixtures;

use App\Entity\Flat;
use App\Entity\Account;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $user = new Account();
        $user->setUsername('toto')
              ->setEmail('toto@gmail.com');
        $password = $this->hasher->hashPassword($user, '123456');
        $user->setPassword($password);
        $manager->persist($user);

        $user2 = new Account();
        $user2->setUsername('denis')
              ->setEmail('denis@gmail.com');
        $password = $this->hasher->hashPassword($user2, '123456');
        $user2->setPassword($password);
        $manager->persist($user2);


        $flat1 = new Flat();
        $flat1->setAddress('49 boulevard Carnot, Aix-en-Provence')
              ->setPricePerDay(33)
              ->setDescription('nice flat in Aix-en-Provence')
              ->setOwner($user);
        $manager->persist($flat1);

        $flat2 = new Flat();
        $flat2->setAddress('19 rue pavillion, Aix-en-Provence')
              ->setPricePerDay(42)
              ->setDescription('lovely flat in Aix-en-Provence')
              ->setOwner($user2);
        $manager->persist($flat2);


        $manager->flush();
    }
}

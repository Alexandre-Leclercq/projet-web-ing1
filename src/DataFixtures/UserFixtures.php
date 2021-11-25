<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    
    public function load(ObjectManager $manager)
    {
        /*
        $role = $manager->getRepository(Role::class)->find('1'); // ROLE_USER
        $user = new User();
        $user->setEmail('test@test.com')
            ->setFirstName('John')
            ->setLastName('Doe')
            ->setRoles($role);

        $password = $this->passwordHasher->hashPassword($user, 'Test_1234');
        $user->setPassword($password);

        $manager->persist($user);
        $manager->flush();
        */
    }
}

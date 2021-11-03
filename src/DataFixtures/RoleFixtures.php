<?php

namespace App\DataFixtures;

use App\Entity\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RoleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // 1
        $role = new Role();
        $role->setCaption('ROLE_USER');
        $manager->persist($role);
        $manager->flush();
        $manager->clear();

        // 2
        $role = new Role();
        $role->setCaption('ROLE_EDITOR');
        $manager->persist($role);
        $manager->flush();
        $manager->clear();

        // 3
        $role = new Role();
        $role->setCaption('ROLE_ADMIN');
        $manager->persist($role);
        $manager->flush();
        $manager->clear();
    }
}

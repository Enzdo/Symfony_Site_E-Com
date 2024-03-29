<?php
namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Faker;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordEncoder,
        private SluggerInterface $slugger
    ){}

    public function load(ObjectManager $manager): void
    {
        $admin = new Users();
        $admin->setEmail('admin@gmail.com');
        $admin->setLastname('Deniau');
        $admin->setFirstname('Enzo');
        $admin->setAdress('12 rue du port');
        $admin->setZipcode('75001');
        $admin->setCity('Paris');
        $admin->setPassword(
            $this->passwordEncoder->hashPassword($admin, 'admin')
        );
        $admin->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);

        $superadmin = new Users();
        $superadmin->setEmail('superadmin@gmail.com');
        $superadmin->setLastname('Deniau');
        $superadmin->setFirstname('Enzo');
        $superadmin->setAdress('12 rue du port');
        $superadmin->setZipcode('75001');
        $superadmin->setCity('Paris');
        $superadmin->setPassword(
            $this->passwordEncoder->hashPassword($superadmin, 'admin')
        );
        $superadmin->setRoles(['ROLE_SUPER_ADMIN']);

        $manager->persist($superadmin);

        $faker = Faker\Factory::create('fr_FR');

        for($usr = 1; $usr <= 50; $usr++){
            $user = new Users();
            $user->setEmail($faker->email);
            $user->setLastname($faker->lastName);
            $user->setFirstname($faker->firstName);
            $user->setAdress($faker->streetAddress);
            $user->setZipcode(str_replace(' ', '', $faker->postcode));
            $user->setCity($faker->city);
            $user->setPassword(
                $this->passwordEncoder->hashPassword($user, 'secret')
            );
            $manager->persist($user);
        }

        $manager->flush();
    }
}
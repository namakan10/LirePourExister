<?php

namespace App\DataFixtures;

use App\Entity\Member;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\Validator\Constraints\Date;

class UserAndMemberFixtures extends Fixture
{
    private $userManager;

    public function __construct(UserManagerInterface $userManager)
    {
        $this->userManager = $userManager;
    }

    public function load(ObjectManager $manager)
    {
        // Create admin
        $admin = $this->userManager->createUser();
        $admin->setUsername("admin");
        $admin->setEmail('admin@gmail.com');
        $admin->setEmailCanonical('admin@gmail.com');
        $admin->setEnabled(1);
        $admin->setPlainPassword('admin');
        $admin->setRoles(array("ROLE_SUPER_ADMIN"));
        $this->userManager->updateUser($admin);

        //Create one membre for test
        $member = $this->userManager->createUser();
        $member->setUsername("member");
        $member->setEmail('member@gmail.com');
        $member->setEmailCanonical('member@gmail.com');
        $member->setEnabled(1);
        $member->setPlainPassword('member');
        $this->userManager->updateUser($member);

        $faker = Factory::create('fr_FR');
        $date = new \DateTime();
        $memberDetails = new Member();
        $memberDetails->setUser($member)
            ->setFirtName("Moussa")
            ->setLastName("Diarra")
            ->setPhone(75582145)
            ->setEmail('member@gmail.com')
            ->setAddress("Bamako, Mali, Hamdallaye")
            ->setSexe("Masculin")
            ->setBirthdayDt($faker->dateTimeBetween($startDate = '-18 years', $endDate = '-6 years'))
            ->setExpiredAt($date);
        $manager->persist($memberDetails);


        //Generate 200 user
        $sexe = "Masculin";
        for($i = 0; $i<100; $i++){
            $email = $faker->email;
            $member = $this->userManager->createUser();
            $member->setUsername($faker->userName)
                ->setEmail($email)
                ->setEmailCanonical($email)
                ->setEnabled(1)
                ->setPlainPassword($faker->password);
            $this->userManager->updateUser($member);


            $date = new \DateTime();
            $memberDetails = new Member();
            $memberDetails->setUser($member)
                ->setFirtName($faker->firstName)
                ->setLastName($faker->lastName)
                ->setPhone($faker->randomNumber($nbDigits = 8, $strict = false))
                ->setEmail($email)
                ->setRegistrationDt($faker->dateTimeBetween($startDate = '-5 months', $endDate ='now'))
                ->setAddress($faker->address)
                ->setBirthdayDt($faker->dateTimeBetween($startDate = '-50 years', $endDate = '-6 years'))
                ->setSexe($sexe)
                ->setExpiredAt($faker->dateTimeBetween($startDate = 'now', $endDate = '+1 years'));
            $manager->persist($memberDetails);

            if($sexe == "Masculin"){
                $sexe = "Feminin";
            }
            else{
                $sexe = "Masculin";
            }
        }

        $manager->flush();
    }
}

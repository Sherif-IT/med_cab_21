<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Doctor;
use App\Entity\Department;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

         $doc = new Doctor();
         $doc->setFirstName("Rahmane");
         $doc->setLastName("Diabi"); 
         $dep = new Department();
         $dep->setDepartmentName("Pediatrie");
         $doc->setIdDepartment($dep);
         $doc->setEmail("doc@gmail.com");
         $doc->setPhone("+33751411568");
         $manager->persist($doc); 

         $doc = new Doctor();
         $doc->setFirstName("Khoudouss");
         $doc->setLastName("Rahim"); 
         $dep = new Department();
         $dep->setDepartmentName("Ophtalmologie");
         $doc->setIdDepartment($dep);
         $doc->setEmail("doc@gmail.com");
         $doc->setPhone("+33751411568");
         $manager->persist($doc);
         
         $doc = new Doctor();
         $doc->setFirstName("Abrahim");
         $doc->setLastName("Seydina"); 
         $dep = new Department();
         $dep->setDepartmentName("Odontologie");
         $doc->setIdDepartment($dep);
         $doc->setEmail("doc@gmail.com");
         $doc->setPhone("+33751411568");
         $manager->persist($doc); 
        $manager->flush();
        
        /*$p = new Patient();
        $p->setFirstName("Mario");
        $p->setLastName("Gomis");
        $p->setPhone("+33753412565");
        $p->setPhone("+33753412565");
        $p->setPatientName("ff");
        $p->setAddress("rue Belsuce 11, Mulhouse,FR"); */
    }
}

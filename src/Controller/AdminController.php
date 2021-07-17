<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\AppointmentFormType; 
use App\Entity\Appointment;
use App\Entity\Doctor;
/**
 * @Route("/nimda")
*/
class AdminController extends AbstractController
{

    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
            $this->entityManager = $entityManager;
    }

   
}

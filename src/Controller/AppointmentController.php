<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\AppointmentFormType; 
use App\Entity\Appointment;
use App\Entity\Patient;
use App\Entity\Doctor;


class AppointmentController extends AbstractController
{ 

    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/book-appointment",  name="make_appointment")
    */
    public function index(Request $request): Response
    {   
        $rdv = new Appointment();   
        $patientRepo = $this->getDoctrine()
        ->getRepository(Patient::class) ;  
        $p = $patientRepo->find(1);  
        $rdv->setIdPatient($p);
        //$doctor = new Doctor();
        /*$doctorRepo = $this->getDoctrine()
        ->getRepository(Doctor::class) ;  
        $doc = $doctorRepo->find(1);  
        $rdv->getDoctors()->add($doc);*/
        $form = $this->createForm(
            AppointmentFormType::class,  $rdv, [ 'entityManager' => $this->getDoctrine()->getManager(), ]
        );
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $rdvDuration = '+ 2 hours';
            $startTime = $form->getData()->getStartTime();
            $endTime = $startTime->modify($rdvDuration); 
            $rdv = $form->getData()->setEndTime($endTime); 
            $this->entityManager->persist($rdv); 
            $this->entityManager->flush(); 
            
            return $this->redirectToRoute('make_appointment');
        } 
        
        return $this->render('appointment/index.html.twig', [
            'controller_name' => 'BlogController', 
            'form' => $form->createView(),
        ]);
    }
}

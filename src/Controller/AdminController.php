<?php

namespace App\Controller;

use App\Repository\AppointmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\FCAppointmentGrid;

/**
 * @Route("/nimda")
 */
class AdminController extends AbstractController        
{
    /**
     * @Route("/", name="admin_index"  , methods={"GET"})
     * @param AppointmentRepository $appointment
     * @return Response
     */
    public function index(AppointmentRepository $appointmentRepository)
    { 
        return $this->render('admin/index.html.twig');
    }
      
    /**
     * @Route("/agenda", name="admin_agenda"  , methods={"GET"})
     * @param AppointmentRepository $appointment
     * @return Response
     */
    public function agenda(AppointmentRepository $appointmentRepository)
    {
        $appointments = $appointmentRepository->findAll();
        $FCRdvGrid = new FCAppointmentGrid(); 
        $FCappointments = []; 

        foreach ($appointments as $appointment) {
            $rdvDate = $appointment->getAppointmentDay();
            $appointment->setStartTime($appointment->getStartTime()->setDate($rdvDate->format('Y'),$rdvDate->format('m'),$rdvDate->format('d')));
            $appointment->setEndTime($appointment->getEndTime()->setDate($rdvDate->format('Y'),$rdvDate->format('m'),$rdvDate->format('d')));
            $FCappointments[] = [
                'id' => $appointment->getId(),
                'start' => $appointment->getStartTime()->format('Y-m-d H:i:s'),
                'end' => $appointment->getEndTime()->format('Y-m-d H:i:s'),
                'title' =>  $appointment->getIdPatient()->getFullName(),
                'backgroundColor' => $FCRdvGrid->getFCBgColor(),
                'borderColor' => $FCRdvGrid->getFCBorderColor(),
                'textColor' => $FCRdvGrid->getFCTextColor(), 
            ];  
        }
        $FCappointments = json_encode($FCappointments);

        return $this->render('admin/agenda.html.twig', compact('FCappointments'));
      }

    /**
     * @Route("/manage-appointments", name="admin_planning"  , methods={"GET"})
     * @param AppointmentRepository $appointment
     * @return Response
     */
    public function planning(AppointmentRepository $appointmentRepository)
    {
        $appointments = $appointmentRepository->findAll(); 

        return $this->render('admin/planning.html.twig', ['appointments' => $appointments]);
    }

    /*
    /**
     * @Route("/confirm-appointment/{id}", name="admin_confirm_appointment"  , methods={"GET"}) 
     */
    public function confirmAppointment($id, AppointmentRepository $appointmentRepository)
    { 
        $entityManager = $this->getDoctrine()->getManager();
        $appointment  = $appointmentRepository->find($id); 
        $appointment->setConfirmed(true); 
        $entityManager->flush();

        return $this->redirectToRoute('admin_planning');
    }

    /**
     * @Route("/invalidate-appointment/{id}", name="invalidate_apppointment"  , methods={"GET"}) 
     */
    public function invalidateAppointment($id, AppointmentRepository $appointmentRepository)
    { 
        $entityManager = $this->getDoctrine()->getManager();
        $appointment  = $appointmentRepository->find($id); 
        $appointment->setConfirmed(false); 
        $entityManager->flush();

        return $this->redirectToRoute('admin_planning');
    }

    /**
     * @Route("/login", name="admin_login")
     */
    public function login()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }

 }

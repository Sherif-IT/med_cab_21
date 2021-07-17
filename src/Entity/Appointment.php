<?php

namespace App\Entity;

use App\Repository\AppointmentRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Entity(repositoryClass=AppointmentRepository::class)
 */
class Appointment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="time_immutable")
     */
    private $startTime;

    /**
     * @ORM\Column(type="time_immutable")
     */
    private $endTime;

    /**
     * @ORM\Column(type="date_immutable")
     */
    private $appointmentDay;

      /**
     * @ORM\ManyToOne(targetEntity=Patient::class, inversedBy="appointments",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $idPatient;

    /**
     * @ORM\ManyToOne(targetEntity=Doctor::class, inversedBy="appointments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idDoctor;


    private $doctors;

    public function __construct()
    {
        $this->doctors = new ArrayCollection();
    }

   
    public function getDoctors(): ArrayCollection
    {
        return $this->doctors;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartTime(): ?\DateTimeImmutable
    {
        return $this->startTime;
    }

    public function setStartTime(\DateTimeImmutable $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getEndTime(): ?\DateTimeImmutable
    {
        return $this->endTime;
    }

    public function setEndTime(\DateTimeImmutable $endTime): self
    {
        $this->endTime = $endTime;

        return $this;
    }

    public function getAppointmentDay(): ?\DateTimeImmutable
    {
        return $this->appointmentDay;
    }

    public function setAppointmentDay(\DateTimeImmutable $appointmentDay): self
    {
        $this->appointmentDay = $appointmentDay;

        return $this;
    }

    public function getIdDoctor(): ?Doctor
    {
        return $this->idDoctor;
    }

    public function setIdDoctor(?Doctor $idDoctor): self
    {
        $this->idDoctor = $idDoctor;

        return $this;
    }

    public function getIdPatient(): ?Patient
    {
        return $this->idPatient;
    }

    public function setIdPatient(?Patient $idPatient): self
    {
        $this->idPatient = $idPatient;

        return $this;
    }
}

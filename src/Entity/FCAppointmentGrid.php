<?php

namespace App\Entity;

use App\Repository\FCAppointmentGridRepository;
use Doctrine\ORM\Mapping as ORM;

class FCAppointmentGrid
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    

    /**
     * @ORM\Column(type="string", length=16)
     */
    private $FCBgColor;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private $FCBorderColor;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private $FCTextColor;

    function __construct(){
        $this->setFCBgColor("#b31e1e");
        $this->setFCTextColor("#f2e3e3");
        $this->setFCBorderColor("#331f1f");
    }

    function _construct($bgColor, $txtColor, $borderColor ){
        $this->setFCBgColor($bgColor);
        $this->setFCTextColor($txtColor);
        $this->setFCBorderColor($borderColor);
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getFCBgColor(): ?string
    {
        return $this->FCBgColor;
    }

    public function setFCBgColor(string $FCBgColor): self
    {
        $this->FCBgColor = $FCBgColor;

        return $this;
    }

    public function getFCBorderColor(): ?string
    {
        return $this->FCBorderColor;
    }

    public function setFCBorderColor(string $FCBorderColor): self
    {
        $this->FCBorderColor = $FCBorderColor;

        return $this;
    }

    public function getFCTextColor(): ?string
    {
        return $this->FCTextColor;
    }

    public function setFCTextColor(string $FCTextColor): self
    {
        $this->FCTextColor = $FCTextColor;

        return $this;
    }
}

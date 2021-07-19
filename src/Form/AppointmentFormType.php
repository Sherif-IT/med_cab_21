<?php

namespace App\Form;

use App\Form\DoctorFormType;
use App\Entity\Appointment;
use App\Entity\Doctor; 
use App\Entity\Department; 
use App\Entity\Patient; 
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType; 
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormBuilderInterface;  
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AppointmentFormType extends AbstractType
{ 
    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
     {
         $this->entityManager = $entityManager;
     }

    public function getAppointsmentDoctors(Type $var = null)
    {
        $doctor = new Doctor();
        $doctorRepo =  $this->$entityManager->getRepository('App:Doctor') ;  
        $doc = $doctorRepo->find(1);  
        $rdv->getDoctors()->add($doc); 
         
        return $rdv;
    }

    private function addDoctorsField( $form, ?Department $department)
{
  $builder = $form->getConfig()->getFormFactory()->createNamedBuilder(
    'idDoctor',
    EntityType::class,
    null,
    [
      'class'           => Doctor::class,
      'placeholder'     => $department ? 'Sélectionnez votre docteur' : 'Sélectionnez votre service',
      'mapped'          => true,
      'required'        => false,
      'auto_initialize' => false,
      'choices'         => $department ? $department->getDoctors() : []
    ]
  );
  /*$builder->addEventListener(
    FormEvents::POST_SUBMIT,
    function (FormEvent $event) {
      $form = $event->getForm();
      $this->addVilleField($form->getParent(), $form->getData());
    }
  );*/
  $form->add($builder->getForm());
}
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startTime', TimeType::class, [
                'widget'       => 'single_text', 
                'input'  => 'datetime_immutable', 
                'html5' => false,
                'data' =>  new \DateTimeImmutable('08:00:00'), 
                'label' => false,
                'attr' => ['class' => 'form-select bg-white border-0'],
                //'choice_value' => $options['entityManager']->getRepository('App:Department')->find(1),
              ])
            ->add('endTime', TimeType::class,[
                'row_attr' => ['hidden ' => 'hidden'],
                'label' => false,
                'input'  => 'datetime_immutable', 
                'data' =>  new \DateTimeImmutable('08:00:00'), 
            ])
            ->add('appointmentDay', DateType::class, [
                'widget'       => 'single_text',
                'label' => false, 
                'input'  => 'datetime_immutable',
                'data' => new \DateTimeImmutable('2021-01-07'),
                'attr' => ['class' => 'form-select bg-white border-0'],
                //'choice_value' => $options['entityManager']->getRepository('App:Department')->find(1),
              ])
            /*->add('idDoctor', CollectionType::class, [
                'entry_type' => ChoiceType::class,   
                'entry_options' => [
                    'choices' => [
                        $rdv,
                    ],
                    'choice_value' => 'doctors',
                    'label' => 'idDoctor_lb',
                    'attr' => ['class' => 'doctor-box'],
                ],
            ]) */
            ->add('idDepartment', EntityType::class, [
                'class'       => Department::class, 
                'label' => false,
                'mapped'      => false,
                'required'    => false,
                'attr' => ['class' => 'form-select bg-white border-0'],
                'placeholder' => 'Choisir un service'
                //'choice_value' => $options['entityManager']->getRepository('App:Department')->find(1),
              ])
              ->add('idDoctor', EntityType::class, [
                'class'       => Doctor::class,
                'label' => false, 
                'mapped'      => true,
                'required'    => true,
                'attr' => ['class' => 'form-select bg-white border-0'],
                'placeholder' => 'Selectionner un docteur'
                //'choice_value' => $options['entityManager']->getRepository('App:Department')->find(1),
              ])
              
          
            ->add(
                'submit',
                SubmitType::class,
                [
                    'attr' => ['class' => 'form-submit btn btn-primary w-100 py-3'],
                    'label' => 'book your appointment!'
                ]
                );


        $builder->get('idDepartment')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
              $form = $event->getForm();
              $this->addDoctorsField($form->getParent(), $form->getData());
            }
          );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Appointment::class,
            'entityManager' => null,
        ]);
    }
}

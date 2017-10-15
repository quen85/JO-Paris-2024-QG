<?php

namespace QuentinBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;


class AthleteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('lastname', TextType::class, array('label' => 'athlete_lastname'))
            ->add('firstname', TextType::class, array('label' => 'athlete_firstname'))
            ->add('birthday', BirthdayType::class, array('label' => 'athlete_date_birthday'))
            ->add('picture', FileType::class, array('label' => 'athlete_picture', 'data_class' => null))
            ->add('pays', EntityType::class, array(
                'class' => 'QuentinBundle:Pays',
                'label' => 'athlete_country',
                'choice_label' => 'name',
                    'multiple' => false,
                    'expanded' => false,
                )
            )
            ->add('discipline', EntityType::class, array(
                'class' => 'QuentinBundle:Discipline',
                'choice_label' => 'name')
            )
            ->add('save', SubmitType::class, array(
                'label'        => 'save'
            ));;
    }

}
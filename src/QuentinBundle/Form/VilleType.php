<?php

namespace QuentinBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;


class VilleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('name', TextType::class, array(
                'label'     =>  'ville_name'
            ))
            ->add('save', SubmitType::class, array(
                'label'        => 'save'
            ));;
    }

}
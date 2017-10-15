<?php

namespace QuentinBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;


class PaysType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('name', TextType::class, array('label' => 'pays_name'))
            ->add('flag', FileType::class, array('label' => 'pays_flag', 'data_class' => null))
            ->add('save', SubmitType::class, array(
                'label'        => 'save'
            ));;
    }

}
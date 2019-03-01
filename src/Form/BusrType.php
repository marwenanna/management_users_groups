<?php

namespace App\Form;

use App\Entity\Agrp;
use App\Entity\Busr;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints\Length;

class BusrType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'label'    => 'First name',
            ])
            ->add('lastname', TextType::class, [
                    'label'    => 'Last name',
            ])
            ->add('email', TextType::class, [
                'label'    => 'Email',
            ])
            ->add('state', CheckboxType::class, [
                'label'    => 'State: (active/ non active)',
                'required' => false,
            ])
            ->add('grp',EntityType::class,[
                'class' => Agrp::class,
                'choice_label' => 'name',
                'label'=> 'Which group do you want ?'
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'label'=> 'Creation date *',
                'html5'  => true,
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
            ]);

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Busr::class,
        ]);
    }
}

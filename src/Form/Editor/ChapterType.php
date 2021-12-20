<?php

namespace App\Form\Editor;

use App\Entity\Chapter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChapterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('step', TextType::class, [
                'required' => true,
                'disabled' => true 
            ])
            ->add('caption', TextType::class, [
                'required' => false,
                'disabled' => true 
            ])
            ->add('content')
            ->add('active', CheckboxType::class)
            ->add('idCourse', TextType::class, [
                'required' => true,
                'disabled' => true 
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chapter::class,
        ]);
    }
}

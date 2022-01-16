<?php

namespace App\Form\Editor;

use App\Entity\Chapter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class EditChapterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $option
     * @return void
     * Create the edit chapter form
     */
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
            ->add('content', TextareaType::class, [
                'attr' => ['class' => 'tinymce']
            ])
            ->add('active', CheckboxType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chapter::class,
        ]);
    }
}

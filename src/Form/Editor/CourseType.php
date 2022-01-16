<?php

namespace App\Form\Editor;

use App\Entity\User;
use App\Entity\Course;
use App\Entity\Category;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CourseType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $option
     * @return void
     * Create the course form
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('caption', TextType::class, [
                'required' => true,
                'disabled' => false
            ])
            ->add('description', TextareaType::class, [
                'required' => true,
                'disabled' => false
            ])
            ->add('image', FileType::class, [
                'required' => false,
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'imge/jpg',
                            'image/png'
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image',
                    ])
                ]
            ])
            ->add('active', CheckboxType::class)
            ->add('idUser', EntityType::class, [
                'class' => User::class,
                'choice_label' => function(User $user) {
                    return $user->getFirstName() . ' ' . $user->getLastName();
                },
                'required' => true,
                'disabled' => $options['admin'] ? false : true,
                'multiple' => false,
                'expanded' => false,
                'placeholder' => ''
            ])
            ->add('idCategory', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'caption',
                'query_builder' => function (EntityRepository $er){
                    return $er->createQueryBuilder('c')
                        ->andWhere('c.active = 1');
                },
                'placeholder' => ''
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Course::class,
            'admin' => false,
        ]);

        $resolver->setAllowedTypes('admin', 'boolean');
    }
}
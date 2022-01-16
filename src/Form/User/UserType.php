<?php

namespace App\Form\User;

use App\Entity\Role;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $option
     * @return void
     * Create the profile form
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class)
            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class)
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'required' => false,
                'constraints' => [
                    new Regex(
                    '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#\$%\^&\*|_+=\-])(?=.*[0-9])(?=.{8,})/',
                    'Password must contain 8 or more characters with uppercase, lowercase, number and special character'
                    )
                ],
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat Password'],
            ])
            ->add('idRole', EntityType::class, [
                'class' => Role::class,
                'query_builder' => function (EntityRepository $er){
                    return $er->createQueryBuilder('r')
                        ->andWhere('r.active = 1');
                },
                'label_format' => 'Role',
                'choice_label' => 'externCaption',
                'required' => false,
                'disabled' => true,
                'multiple' => false,
                'expanded' => false,
                'placeholder' => ''
            ])
            ->add('picture', FileType::class, [
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
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

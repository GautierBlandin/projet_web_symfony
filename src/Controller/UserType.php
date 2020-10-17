<?php


namespace App\Controller;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;


use App\Entity\User;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Email Address',
                    'class' => 'register-input-field'
                ],
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => false,
                    'attr' => [
                        'placeholder' => 'Password',
                        'class' => 'register-input-field'
                    ]],
                'second_options' => ['label' => false,
                    'attr' => [
                        'placeholder' => 'Confirm Password',
                        'class' => 'register-input-field'
                    ]],
            ])
            ->add('first_name', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'First Name',
                    'class' => 'register-input-field'
                ]
            ])
            ->add('last_name', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Last Name',
                    'class' => 'register-input-field'
                ]
            ])
            ->add('adress', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Adress',
                    'class' => 'register-input-field'
                ]
            ])
            ->add('phoneNumber', telType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Phone Number',
                    'class' => 'register-input-field'
                ]
            ])
            ->add('age', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Age',
                    'class' => 'register-input-field'
                ]
            ])
            ->add('studies', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Previous studies',
                    'class' => 'register-input-field'
                ]
            ])
            ->add('gender', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Gender',
                    'class' => 'register-input-field'
                ]
            ])
            ->add('experience', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Previous working experience',
                    'class' => 'register-input-field'
                ]
            ])
            ->add('availabilities', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Availabilities (per day, week, month..)',
                    'class' => 'register-input-field'
                ]
            ])
            ->add('biography', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Describe yourself...',
                    'class' => 'register-input-field'
                ]
            ])
            ->add('register', SubmitType::class, [
                'label' => 'Register Account',
                'attr'=> [
                    'class' => 'register-button-input'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
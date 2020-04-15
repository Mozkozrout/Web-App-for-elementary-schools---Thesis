<?php

namespace App\Form;

use App\Entity\Ucitele;
use App\Entity\User;
use App\Entity\Zak;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            -> add('username', TextType::class, ['label' => 'Uživatelské jméno','attr' => []])
            -> add('roles', CollectionType::class, ['label' => 'Role', 'allow_delete' => true, 'required'=> false])
            -> add('password', TextType::class, ['label' => 'Zašifrované heslo', 'attr' => [] ])
            -> add('ucitel', EntityType::class, ['label' => 'Učitel', 'class' => Ucitele::class, 'empty_data' => null, 'required'=> false])
            -> add('zak', EntityType::class, ['label' => 'Žák', 'class' => Zak::class, 'empty_data' => null, 'required' => false])
            -> add('Upravit', SubmitType::class, ['attr' => ['class' => 'btn-outline-success']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

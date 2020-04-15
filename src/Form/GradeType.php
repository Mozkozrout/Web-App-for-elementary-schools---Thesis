<?php

namespace App\Form;

use App\Entity\Predmet;
use App\Entity\Ucitele;
use App\Entity\Zak;
use App\Entity\Znamka;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GradeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            -> add('hodnota', ChoiceType::class, ['choices' => ['0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5'], 'required' => true, 'label' => 'Známka:'])
            -> add('ucitel', EntityType::class, ['class' => Ucitele::class, 'label' => 'Učitel', 'required' => true])
            -> add('poznamka', TextareaType::class, ['label' => 'Poznámka', 'required' => false])
            -> add('zak', EntityType::class, ['class' => Zak::class, 'label' => 'Žák', 'required' => true])
            -> add('predmet', EntityType::class, ['class' => Predmet::class, 'label' => 'Předmět', 'required' => true])
            -> add('datum', DateType::class, ['required' => true, 'label' => 'Datum zápisu', 'years' => [date('Y')], 'months' => [date('m')], 'days' => [date('d')]])
            -> add('save', SubmitType::class,['label' => 'Uložit', 'attr' => ['class' => 'btn btn-outline-success float-left']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Znamka::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Cas;
use App\Entity\Den;
use App\Entity\Doba;
use App\Entity\Predmet;
use App\Entity\Trida;
use App\Entity\Ucebna;
use App\Entity\Ucitele;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TimeTableType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            -> add('den', EntityType::class, ['class' => Den::class, 'attr' => [], 'required' => true])
            -> add('predmet', EntityType::class, ['class' => Predmet::class, 'required' => true])
            -> add('ucitel', EntityType::class, ['class' => Ucitele::class, 'required' => true])
            -> add('trida', EntityType::class, ['class' => Trida::class, 'attr' => [], 'required' => true])
            -> add('ucebna', EntityType::class, ['class' => Ucebna::class, 'required' => true])
            -> add('doba', EntityType::class, ['class' => Doba::class, 'attr' => [], 'required' => true])
            -> add('save', SubmitType::class, ['label' => 'Uložit', 'attr' => ['class' => 'btn btn-outline-success float-left']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cas::class,
        ]);
    }
}

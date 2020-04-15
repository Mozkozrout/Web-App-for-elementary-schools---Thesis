<?php

namespace App\Form;

use App\Entity\Skola;
use App\Entity\Trida;
use App\Entity\Zak;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ZakType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            -> add('jmeno', TextType::class, ['label' => 'Jméno', 'attr' => ['placeholder' => 'Jméno']])
            -> add('prijmeni', TextType::class, ['label' => 'Příjmení', 'attr' => ['placeholder' => 'Příjmení']])
            -> add('datNar', DateType::class, ['years' => range(date('Y') - 9, date('Y') - 17),'required' => true, 'label' => 'Datum narození'])
            -> add('image', FileType::class, ['mapped' => false, 'required' => false, 'attr' => ['placeholder' => 'Vyberte'], 'label' => 'Profilový obrázek'])
            -> add('stat', TextType::class, ['label' => 'Země pobytu', 'required' => true, 'attr' => ['placeholder' => 'Země pobytu']])
            -> add('mesto', TextType::class, ['label' => 'Město', 'required' => true, 'attr' => ['placeholder' => 'Město']])
            -> add('ulice', TextType::class, ['label' => 'Ulice', 'required' => true, 'attr' => ['placeholder' => 'Ulice']])
            -> add('cisPop', TextType::class, ['label' => 'Číslo popisné', 'required' => true, 'attr' => ['placeholder' => 'Číslo popisné']])
            -> add('psc', TextType::class, ['label' => 'Poštovní směrovací číslo', 'required' => true, 'attr' => ['placeholder' => 'Poštovní směrovací číslo']])
            -> add('poznamka', TextareaType::class, ['label' => 'Poznámky', 'required' => false, 'attr' => ['placeholder' => 'Zadejte dodatečné důležité informace']])
            -> add('trida', EntityType::class, ['class' => Trida::class, 'required' => true, 'attr' => ['placeholder' => 'Vyberte'], 'label' => 'Třída'])
            -> add('skola', EntityType::class, ['class' => Skola::class, 'empty_data' => '1'])
            -> add('save', SubmitType::class, ['attr' => ['class' => 'btn btn-outline-success float-left'], 'label' => 'Uložit'])
            -> add('tel', TelType::class, ['attr' => ['data-mask' => '+000000000000', 'placeholder' => '+123456789123'], 'label' => 'Telefon rodiče', 'required' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Zak::class,
        ]);
    }
}

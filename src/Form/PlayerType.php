<?php

namespace App\Form;

use App\Entity\Club;
use App\Entity\National;
use App\Entity\Player;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('dateNaissance')
            ->add('nationalite')
            ->add('parcours')
            ->add('nombreBut')
            ->add('club' , EntityType::class,[
                'class' => Club::class,
                'choice_label' => 'name'
            ] )
            ->add('national' ,EntityType::class,[
                'class' => National::class,
                'choice_label' => 'name'
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Player::class,
        ]);
    }
}

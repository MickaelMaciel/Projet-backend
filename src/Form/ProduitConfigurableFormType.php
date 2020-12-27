<?php

namespace App\Form;

use App\Entity\ProduitConfigurable;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\SousTypeProduit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Fabricant;

class ProduitConfigurableFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('produitConfigurableCreationAt',DateType::class,[
                 'widget' => 'single_text',
                 'input'  => 'timestamp'
             ])
             ->add('produitConfigurableMajAt',DateType::class,[
                 'widget' => 'single_text',
                 'input'  => 'datetime_immutable'
             ])
            ->add('sousTypeProduit')
            ->add('sousTypeProduit',EntityType::class,[
                'class'=>SousTypeProduit::class,
                'choice_label'=>'name',
                'label'=>'SousTypeProduit'
            ])
            ->add('fabricant',EntityType::class,[
                'class'=>Fabricant::class,
                'choice_label'=>'name',
                'label'=>'Fabricant'
            ])
           // ->add('fabricant')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProduitConfigurable::class,
        ]);
    }
}

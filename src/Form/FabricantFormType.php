<?php

namespace App\Form;

use App\Entity\Fabricant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class FabricantFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,[
                'constraints'=>[
                    new NotBlank(['message'=>'Le nom est manquant.']),
                    new Length([
                        'max'=>255,
                        'maxMessage'=>'Le nom ne peut comporter plus de {{limit}} caractères.'
                    ])
                ]
            ])
            ->add('fabricantDescription',TextareaType::class,[
                'constraints'=>[
                    new NotBlank(['message'=>'La description est manquante.']),
                    new Length([
                        'min'=>255,
                        'minMessage'=>'La description est trop courte et doit contenir au moins {{limit}} caractères.'
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        //L'option data_class indique que le formulaire est lié à la classe Artist
       // et le formulaire retournera toujours ses données sous la forme d'une instance de Artist
       // Sans l'option data_class, un formulaire travaille avec un tableau associatif
        $resolver->setDefaults([
            'data_class' => Fabricant::class,
        ]);
    }
}

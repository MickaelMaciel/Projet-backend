<?php

namespace App\Form;

use App\Entity\ArticleSimple;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleSimpleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('articleSimpleName')
            ->add('articleSimplePrixAchat')
            ->add('articleSimplePrixVente')
            ->add('produitConfigurable')
            ->add('variationCouleur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ArticleSimple::class,
        ]);
    }
}

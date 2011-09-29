<?php

namespace Acme\DiggBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PostType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('score')
        ;
    }

    public function getName()
    {
        return 'acme_diggbundle_posttype';
    }
}

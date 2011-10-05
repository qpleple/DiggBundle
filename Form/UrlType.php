<?php

namespace Acme\DiggBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class UrlType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('address')
            ->add('facebookScore')
            ->add('twitterScore')
            ->add('googleScore')
            ->add('diggScore')
            ->add('totalScore')
            ->add('lastCheck')
        ;
    }

    public function getName()
    {
        return 'acme_diggbundle_urltype';
    }
}

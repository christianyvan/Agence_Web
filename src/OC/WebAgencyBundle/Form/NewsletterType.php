<?php

namespace OC\WebAgencyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class NewsletterType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		$builder
            ->add('lastName', TextType::class, array(
                'attr' => array(
                    'placeholder' => 'Nom',
                    'class' => 'imputf'
                ))
            )
			->add('firstName', TextType::class, array(
			    'attr' => array(
			        'placeholder' => 'Prénom',
                    'class' => 'imputf'
                ))

            )
			->add('email', TextType::class, array(
			    'attr' => array(
			        'placeholder' => 'Email',
                    'class' => 'imputf'
                ))

            )
			->add('save', SubmitType::class, array('label'=> 'Envoyer'))
		;
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OC\WebAgencyBundle\Entity\Contact'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'oc_webagencybundle_contact';
    }


}

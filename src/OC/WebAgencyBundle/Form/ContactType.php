<?php

namespace OC\WebAgencyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class ContactType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		$builder->add('lastName', TextType::class, array('label'=> 'Nom'))
			->add('firstName', TextType::class, array('label'=> 'Prénom'))
			->add('email', TextType::class, array('label'=> 'Email'))
			->add('object', TextType::class, array('label'=> 'Sujet'))
			->add('message', TextareaType::class, array('label'=> 'Message'))
			->add('date',DateType::class, array('label'=> 'Date'))
			->add('response',TextareaType::class,array('label'=>'reply','attr' => array(
				'class' => 'ckeditor')))
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

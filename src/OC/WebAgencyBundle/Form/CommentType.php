<?php

namespace OC\WebAgencyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('author',TextType::class,array('attr' =>array('class'=>'form-control ')))
				->add('email',TextType::class,array('attr' =>array('class'=>'form-control ')))
				->add('content',TextareaType::class,array('attr' =>array('class'=>'form-control ckeditor ')))
				->add('postId',IntegerType::class,array('attr' =>array('class'=>'form-control ')))
				->add('isSeen',ChoiceType::class,array('attr' =>array('class'=>'form-control '),
					'label' =>'Vue',
					'choices' 	=> array(
						'Not seen'  => 0,
						'Seen'		=> 1
					)
				))
				->add('date',DateType::class,array('attr' =>array('class'=>'form-control ')))
				;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OC\WebAgencyBundle\Entity\Comment'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'oc_webagencybundle_comment';
    }


}

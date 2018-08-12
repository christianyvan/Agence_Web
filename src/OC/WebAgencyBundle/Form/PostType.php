<?php

namespace OC\WebAgencyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use OC\WebAgencyBundle\Repository\CategoryRepository;

class PostType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title',TextType::class)
				->add('name',TextType::class)
				->add('content',TextareaType::class)
                // Abdel : charger la liste des catégories
                ->add('category', EntityType::class, array(
                'class'         => 'OCWebAgencyBundle:Category',
                'choice_label'  => 'name',
                'multiple'      => false,
                'query_builder' => function(CategoryRepository $repository) {
                    return $repository->getLikeQueryBuilder();
                }
                ))
				->add('email',EmailType::class)
				//->add('image',FileType::class, array('data_class' => null,'label' => 'Image(JPG)'))
                ->add('imageFile', VichImageType::class, ['required' => false, 'label' => 'Image'])
                ->add('date',DateType::class)
				->add('isPosted',ChoiceType::class,array(
					'label' => 'Published',
					'choices' => array(
						'Yes' => '1',
						'No' => '0',
				)));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OC\WebAgencyBundle\Entity\Post'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'oc_webagencybundle_post';
    }


}

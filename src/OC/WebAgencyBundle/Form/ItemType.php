<?php

namespace OC\WebAgencyBundle\Form;

use OC\WebAgencyBundle\Entity\Page;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ItemType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array(
                'label' => 'Titre'
            ))
            ->add('subtitle', TextType::class, array(
                'label' => 'Sous-titre'
            ))
            ->add('content', TextareaType::class, array(
            'label' => 'Contenu',
             'attr' => ['rows' => '8','cols' => '10']
            ))
            //->add('content', CKEditorType::class, array('config' => array('toolbar' => 'my_toolbar_1')))
            ->add('imageFile', VichImageType::class, ['required' => false, 'label' => 'Image'])
            ->add('page', EntityType::class, ['class' => Page::class, 'choice_label' => 'title', 'label' => 'Page du site']);
            //->add('createdAt');
            //->add('updatedAt');

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OC\WebAgencyBundle\Entity\Item'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'oc_webagencybundle_item';
    }


}

<?php

namespace Uerka\TranslationFormBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TranslationItemType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        foreach ($options['fields'] as $fieldName => $fieldSettings) {
            $fieldWidget = !empty($fieldSettings['widget_class']) ? $fieldSettings['widget_class'] : TextType::class;
            $fieldOptions = !empty($fieldSettings['options']) ? $fieldSettings['options'] : [];

            $builder->add($fieldName, $fieldWidget, $fieldOptions);
        }
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'fields' => [],
        ]);
    }
}

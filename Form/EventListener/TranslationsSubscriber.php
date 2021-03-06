<?php

namespace Uerka\TranslationFormBundle\Form\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Uerka\TranslationFormBundle\Form\Type\TranslationItemType;

class TranslationsSubscriber implements EventSubscriberInterface
{
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::SUBMIT => 'submit',
        ];
    }

    /**
     * @param FormEvent $event
     */
    public function preSetData(FormEvent $event)
    {
        $form = $event->getForm();
        $formOptions = $form->getConfig()->getOptions();

        $fieldsOptions = $formOptions['fields'];
        $entity = $event->getForm()->getParent()->getData();

        foreach ($formOptions['locales'] as $locale) {
            $form->add($locale, TranslationItemType::class, [
                'required' => in_array($locale, $formOptions['required_locales'], true),
                'fields' => $fieldsOptions,
                // if form is within embedded form (CollectionType) we're getting entity === null
                'data_class' => $entity ? $entity::getTranslationEntityClass() : $event->getForm()->getParent()->getConfig()->getOptions()['data_class'].'Translation',
            ]);
        }
    }

    /**
     * @param FormEvent $event
     */
    public function submit(FormEvent $event)
    {
        $data = $event->getData();
        $entity = $event->getForm()->getParent()->getData();

        foreach ($data as $locale => $translation) {
            if (!$translation) {
                unset($data[$locale]);
            } else {
                $translation->setLocale($locale);
                $translation->setTranslatable($entity);
            }
        }

        $event->setData($data);
    }
}

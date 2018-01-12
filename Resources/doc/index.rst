# UerkaTranslationFormBundle

Simplified version of https://github.com/a2lix/TranslationFormBundle. Supports only https://github.com/KnpLabs/DoctrineBehaviors.
Supports symfony4

##Installation
```bash
composer require uerka/translation-form-bundle
```

Add to bundles:

Symfony4 - bundles.php

```php 
return [
    ...
    Uerka\TranslationFormBundle\UerkaTranslationFormBundle::class => ['all' => true],
```

Symfony3 - AppKernel.php

```php 
public function registerBundles()
{
    $bundles = [
    ...
    new Uerka\TranslationFormBundle\UerkaTranslationFormBundle(),
}
```

## Configuration
```yaml
uerka_translation_form: 
    locales: ["ru", "en"]
```

Add theme to twig settings:

```yaml
twig:
    ...
    form_themes: 
        ...
        - 'UerkaTranslationFormBundle:form:fields.html.twig'
```

# Using form

```php
...
use Uerka\TranslationFormBundle\Form\Type\TranslationsType;

class ExampleFormType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('translations', TranslationsType::class, [
                'locales' => ['ru', 'en', 'fr'], // optional, defaults to bundle's config
                'required_locales' => ['en'], // optional, default []
                'fields' => [
                    'name' => [
                        'widget_class' => TextType::class, // optional, default TextType::class
                        'options' => [ // will be passed to field's options
                            'label' => 'form.label.name',
                        ],
                    ],
                    'shortDescription' => [
                        'widget_class' => TextareaType::class,
                        'options' => [
                            'label' => 'form.label.short_description',
                            'required' => false,
                        ]
                    ],
                ],
            ]);
            ...
       }
    ...
}
```

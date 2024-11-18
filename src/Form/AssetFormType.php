<?php

namespace App\Form;

use App\Entity\Asset;
use App\Entity\Host;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AssetFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('label_no')
            ->add('name')
            ->add('host', EntityType::class, [
                'class' => Host::class,
                'placeholder' => 'Kein Host ausgewählt', // Standardwert als Platzhalter
                'empty_data' => null,
                'required' => false,
                'choice_label' => function ($host, $key, $index) {
                    /** @var Host $host */
                    return $host->getIp() . ' / ' . $host->getName();
                },
            ])
            ->add('save', SubmitType::class, ['label' => 'Speichern']);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Asset::class,
        ]);
    }
}

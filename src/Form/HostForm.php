<?php

namespace App\Form;

use App\Entity\Host;
use App\Entity\HostType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HostForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, ['label' => 'Name des Endgerätes'])
            ->add('mac', null, [
                'label' => 'MAC Adresse'
            ])
            ->add('ip', null, ['label' => 'IP Adresse'])
            ->add('is_static', ChoiceType::class , [
                'choices'  => [
                    'Ja' => 1,
                    'Nein' => 0,
                ],
                'label' => 'Ist die Zuordnung statisch?',
            ])
            ->add('asset_id', null, ['label' => 'AssetID'])
            ->add('description', null, ['label' => 'Beschreibung'])
            ->add('type', EntityType::class, [
                'class' => HostType::class,
'choice_label' => 'name',
            'choice_value' => 'id',
            'label' => 'Host Typ'])
            ->add('save', SubmitType::class, ['label' => 'Speichern'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Host::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Character;
use App\Entity\Element;
use App\Entity\Region;
use App\Entity\WeaponCategory;
use App\Enum\Genre;
use App\Enum\Size;
use App\Form\Base\AbstractEntityType;
use App\Form\Trait\WithName;
use App\Form\Trait\WithSubmitButton;
use App\Form\Trait\WithTimestamps;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CharacterType extends AbstractEntityType {

    use WithName, WithTimestamps, WithSubmitButton;

    protected function doBuildForm(FormBuilderInterface $builder, array $options): void {
        $builder
            ->add('rare')
            ->add('element', EntityType::class, [
                'class' => Element::class,
                'choice_label' => 'id',
            ])
            ->add('weaponCategory', EntityType::class, [
                'class' => WeaponCategory::class,
                'choice_label' => 'name',
            ])
            ->add('region', EntityType::class, [
                'class' => Region::class,
                'choice_label' => 'name',
            ])
            ->add('genre', EnumType::class, [
                'class' => Genre::class,
            ])
            ->add('size', EnumType::class, [
                'class' => Size::class,
            ])
            ->add('releaseDate', null, [
                'widget' => 'single_text',
            ])
            ->add('version');
    }

    protected function doConfigureOptions(OptionsResolver $resolver): void {
        $resolver->setDefault('data_class', Character::class);
    }

}

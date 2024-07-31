<?php

namespace App\Form;

use App\Entity\Pokemon;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PokemonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('image')
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'vol' => 'vol' ,
                    'electrik' => 'electrik',
                    'feu' => 'feu',
                    'poison' => 'poison',
                    'eau' => 'eau',
                    'normal' => 'normal',
                    'fee' => 'fee',
                    'psy' => 'psy',
                    'roche' => 'roche'
//                첫번째꺼는 보이는 대로 => 두번째꺼는 bdd에 stoquer되는 대로
                ]
            ])
            ->add('valider', SubmitType::class)
//           아하~ 마지막줄은 valider버튼임
//        이거 안쓰면 {{ form_widget(form) }}
//    <button type="submit">Save</button> 이래하면 됨
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pokemon::class,
        ]);
    }
}

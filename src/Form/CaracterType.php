<?php

namespace App\Form;

use App\Entity\Caracter;
use App\Entity\Power;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CaracterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom de votre héro ou héroïne :'
            ])
            ->add('age', null, [
                'label' => 'Age :'
            ])
            ->add('sex', ChoiceType::class, [
                'label' => 'Sexe',
                'choices' => $this->getChoices()
            ])
            ->add('powers', EntityType::class, [
                'label' => 'Pouvoirs',
                'class' => Power::class,
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('imageFile', FileType::class, [
                'required' => true,
                'label' => 'Image'

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Caracter::class,
        ]);
    }

    private function getChoices()
    {
        $choices = Caracter::SEX;
        $output = [];
        foreach ($choices as $k => $v){
            $output[$v] = $k;

        }
        return $output;

    }
}

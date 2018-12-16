<?php

namespace App\Form;

use App\Entity\Caracters;
use App\Entity\Powers;
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
            ->add('caractersPowers', EntityType::class, [
                'label' => 'Pouvoirs',
                'class' => 'App\Entity\Powers',
                'multiple' => true,

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
            'data_class' => Caracters::class,
        ]);
    }

    private function getChoices()
    {
        $choices = Caracters::SEX;
        $output = [];
        foreach ($choices as $k => $v){
            $output[$v] = $k;

        }
        return $output;

    }
}

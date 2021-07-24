<?php

namespace App\Form;

use App\Entity\Demandeur;
use Doctrine\DBAL\Types\DateIntervalType;
use Doctrine\DBAL\Types\DateType as TypesDateType;
use Doctrine\DBAL\Types\TextType as TypesTextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\DateTime;

class DemandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('annee', TextType::class,[
                "attr" => [
                        "class" => "form-control"
                ]
            ])
            ->add('numeroRegistre', TextType::class,[
                "attr" => [
                        "class" => "form-control"
                ]
            ])
            ->add('anneeNaissance', TextType::class,[
                "attr" => [
                        "class" => "form-control"
                ]
            ])
            ->add('sexe', CheckboxType::class)
            ->add('nom', TextType::class,[
                "attr" => [
                        "class" => "form-control"
                ]
            ])
            ->add('prenom', TextType::class,[
                "attr" => [
                        "class" => "form-control"
                ]
            ])
            ->add('nomPere', TextType::class,[
                "attr" => [
                        "class" => "form-control"
                ]
            ])
            ->add('prenomPere', TextType::class,[
                "attr" => [
                        "class" => "form-control"
                ]
            ])
            ->add('nomMere', TextType::class,[
                "attr" => [
                        "class" => "form-control"
                ]
            ])
            ->add('prenomMere', TextType::class,[
                "attr" => [
                        "class" => "form-control"
                ]
            ])
            ->add('tel', TextType::class,[
                "attr" => [
                        "class" => "form-control"
                ]
            ])
            ->add('createdAt', DateType::class,[
                "attr" => [
                        "class" => "form-control"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Demandeur::class,
        ]);
    }
}

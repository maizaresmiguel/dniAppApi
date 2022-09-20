<?php

namespace App\Form\Type;


use App\Form\Model\DestinoDto;
use Doctrine\DBAL\Types\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class DestinoFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('oficina', IntegerType::class)
            ->add('nombre', TextType::class)
            ->add('descripcion', TextType::class)
            ->add('fechaMovimiento',  DateType::class, ['widget' => 'single_text', 'format' => 'yyyy-MM-dd', 'html5' => false])
            ->add('usuario', TextType::class)
           ;
    }

    /**
     * aqui le decimos a que clase esta asociado el formulario
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DestinoDto::class,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }

    public function getName()
    {
        return '';
    }

}
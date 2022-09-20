<?php
namespace App\Form\Type;

use App\Form\Model\DniDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class DniFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idTramite', IntegerType::class)
            ->add('apellido', TextType::class)
            ->add('nombre', TextType::class)
            ->add('sexo', TextType::class)
            ->add('dni', IntegerType::class)
            ->add('estado', NumberType::class)
            ->add('fechaNacimiento', DateType::class, ['widget' => 'single_text', 'format' => 'yyyy-MM-dd', 'html5' => false])
            ->add('fechaTramite', DateType::class, ['widget' => 'single_text', 'format' => 'yyyy-MM-dd', 'html5' => false])
            ->add('codigo', IntegerType::class)
            ->add('destinos', CollectionType::class,[
                'allow_add' => true,
                'allow_delete' => true,
                'entry_type' => DestinoFormType::class,
            ]);
    }

    /**
     * aqui le decimos a que clase esta asociado el formulario
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DniDto::class,
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
    public function getName(){
        return '';
    }

}
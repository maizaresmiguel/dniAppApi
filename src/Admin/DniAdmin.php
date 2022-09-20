<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class DniAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('idTramite')
            ->add('apellido')
            ->add('nombre')
            ->add('sexo')
            ->add('dni')
            ->add('fechaNacimiento')
            ->add('fechaTramite')
            ->add('codigo')
            ->add('fechaAlta')
            ->add('usuario')
            ->add('estado')
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id')
            ->add('idTramite')
            ->add('apellido')
            ->add('nombre')
            ->add('sexo')
            ->add('dni')
            ->add('fechaNacimiento')
            ->add('fechaTramite')
            ->add('codigo')
            ->add('fechaAlta')
            ->add('usuario')
            ->add('estado')
            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('id', null,['disabled' => true])
            ->add('idTramite')
            ->add('apellido')
            ->add('nombre')
            ->add('sexo')
            ->add('dni')
            ->add('fechaNacimiento')
            ->add('fechaTramite')
            ->add('codigo')
            ->add('fechaAlta')
            ->add('usuario')
            ->add('estado')
            ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('idTramite')
            ->add('apellido')
            ->add('nombre')
            ->add('sexo')
            ->add('dni')
            ->add('fechaNacimiento')
            ->add('fechaTramite')
            ->add('codigo')
            ->add('fechaAlta')
            ->add('usuario')
            ->add('estado')
            ->add('destinos')

            ;
    }
}

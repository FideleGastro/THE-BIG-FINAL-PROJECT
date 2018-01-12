<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Projet;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ProjetAdmin extends AbstractAdmin
{
    public function toString($object)
    {
        return $object instanceof Projet
            ? $object->getName()
            : 'Projet'; // shown in the breadcrumb on the create view
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('user', 'text');
        $formMapper->add('name', 'text');
        $formMapper->add('current', 'text');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name');
        $listMapper->addIdentifier('user');
        $listMapper->addIdentifier('current');
    }
}
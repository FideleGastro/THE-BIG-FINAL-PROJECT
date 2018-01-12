<?php

namespace AppBundle\Admin;

use AppBundle\Entity\UserAdmin;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class UserAdminAdmin extends AbstractAdmin
{
    public function toString($object)
    {
        return $object instanceof UserAdmin
            ? $object->getName()
            : 'User'; // shown in the breadcrumb on the create view
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('username', 'text');
        $formMapper->add('username_canonical', 'text');
        $formMapper->add('email', 'text');
        $formMapper->add('email_canonical', 'text');
        $formMapper->add('enabled');
        $formMapper->add('password', 'text');

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('username');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('username');
    }
}
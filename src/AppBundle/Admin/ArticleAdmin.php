<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Article;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ArticleAdmin extends AbstractAdmin
{
    public function toString($object)
    {
        return $object instanceof Article
            ? $object->getTitle()
            : 'Article'; // shown in the breadcrumb on the create view
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('title', 'text');
        $formMapper->add('content', 'text');
        $formMapper->add('pmid', 'text');
        $formMapper->add('link', 'text');
        $formMapper->add('author', 'text');
        $formMapper->add('date', 'text');
        $formMapper->add('journal', 'text');
        $formMapper->add('projet', 'text');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('pmid');
        $listMapper->addIdentifier('title');
        $listMapper->addIdentifier('author');
        $listMapper->addIdentifier('date');
        $listMapper->addIdentifier('projet');
        $listMapper->addIdentifier('journal');

    }
}
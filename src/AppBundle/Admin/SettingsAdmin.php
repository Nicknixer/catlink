<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class SettingsAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text')
            ->add('value', 'text');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('id');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->addIdentifier('name')
            ->add('value');
    }
    protected function configureRoutes(RouteCollection $collection)
    {
        /* Removing the edit route will disable editing entities. It will also
         * use the 'show' view as default link on the identifier columns in the list view.
         */
        $collection->remove('delete');

        /* Removing the create route will disable creating new entities. It will also
         * remove the 'Add new' button in the list view.
         */
        $collection->remove('create');
    }
}
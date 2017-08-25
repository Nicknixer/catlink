<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class SiteAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', 'text')
            ->add('url', 'text')
            ->add('category', 'entity', [
                'class' => 'AppBundle\Entity\Category',
                'choice_label' => 'name',
            ])
            ->add('email', 'text')
            ->add('short_description', 'textarea')
            ->add('description', 'textarea')
            ->add('keywords', 'text')
            ->add('is_moderated', 'checkbox');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('id');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->addIdentifier('title')
            ->add('url')
            ->add('category.name')
            ->add('email')
            ->add('short_description')
            ->add('is_moderated');
    }
}
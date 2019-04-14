<?php

namespace AdminBundle\Admin;

use CoreBundle\Entity\Provider;
use CoreBundle\Form\Type\ActionsType;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class ProviderAdmin extends AbstractAdmin
{
    protected $datagridValues = [

        // display the first page (default = 1)
        '_page' => 1,

        // reverse order (default = 'ASC')
        '_sort_order' => 'DESC',

        // name of the ordered field (default = the model's id field, if any)
        '_sort_by' => 'name',

        '_per_page' => 500,
    ];

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $translator = $this->getContainer()->get('translator');



        $listMapper
//            ->add('id')

            ->add('name')
            ->add('paid', 'string', array(
//                'sortable' => true,
//                'sort_field_mapping' => array('fieldName' => 'paid'),
//                'sort_parent_association_mappings' => array(array('fieldName' => 'paid')),
                'template' => '@Admin/Admin/Provider/List/paid.html.twig',
                'sortable' => true,
                'sort_field_mapping' => array('fieldName' => 'total'),
                'sort_parent_association_mappings' => array(array('fieldName' => 'expenditures'))
            ))
            ->add('pending', 'string', array(
                'label' => ucfirst($translator->trans('pending')),
                'template' => '@Admin/Admin/Provider/List/left.html.twig',
            ))
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        /** @var Provider $entity */
        $entity = $this->getSubject();
        $translator = $this->getContainer()->get('translator');

        $formMapper
            ->add('name')
        ;

        $formMapper
            ->add('irpf')
        ;

        $formMapper->add('graph',
        ActionsType::class,
        [
            'mapped' => false,
            'label' => false,
            'attr' => [
                'template' => 'AdminBundle::Admin/Provider/Edit/graph.html.twig',
            ],
        ]
    );
        $formMapper->add('summary',
        ActionsType::class,
        [
            'mapped' => false,
            'label' => false,
            'attr' => [
                'template' => 'AdminBundle::Admin/Provider/Edit/summary.html.twig',
            ],
        ]
    );

        $formMapper
            ->add('expenditures',
                ActionsType::class,
                [
                    'mapped' => false,
                    'label' => false,
                    'attr' => [
                        'template' => 'AdminBundle::Admin/Provider/Edit/expenditures.html.twig',
                    ],
                ]
            )

//            ->add(
//            'expenditures',
//            'sonata_type_collection',
//            [
//                'label' => ' ',
//                'type_options' => array('delete' => false),
//                'required' => false,
//                'by_reference' => false,
//            ],
//            [
//                'allow_add' => true,
//                'allow_delete' => false,
//                'delete' => false,
//                'admin_code' => 'core.admin.expenditure',
//                'edit' => 'inline',
//                'inline' => 'table',
//            ]
//        )





            ->add(
                'scripts',
                ActionsType::class,
                [
                    'mapped' => false,
                    'label' => false,
                    'attr' => [
                        'template' => 'AdminBundle::Admin/Provider/Edit/scripts.html.twig',
                    ],
                ]
            )
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('name')
        ;
    }

    /**
     * @param Provider $object
     */
    public function preUpdate($object)
    {
        $em = $this->getManager();
        $accounts =$em->getRepository('CoreBundle:Account')->findAll();
        foreach ($accounts as $account)
        {
                $balance = $this->getContainer()->get('account.handler')->calculateBalance($account);
                $account->setBalance($balance);
                $em->persist($account);
        }
        $em->flush();
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('return_list_providers', $this->getRouterIdParameter().'/return_list_providers');
        $collection->add('graph_providers', $this->getRouterIdParameter().'/graph_providers');
    }


}

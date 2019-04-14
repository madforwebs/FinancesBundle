<?php

namespace AdminBundle\Admin;

use CoreBundle\Entity\Expenditure;
use CoreBundle\Form\Type\ActionsType;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ExpenditureAdmin extends AbstractAdmin
{

    private $parameters = array();

    protected $datagridValues = [

        // display the first page (default = 1)
        '_page' => 1,

        // reverse order (default = 'ASC')
        '_sort_order' => 'DESC',

        // name of the ordered field (default = the model's id field, if any)
        '_sort_by' => 'dateBuy',
    ];


    public function getFilterParameters()
    {
        $session = $this->getContainer()->get('session');
        $yearId = $session->get('selected_year.id', null);
        if($yearId != null){
            $this->datagridValues = array_merge(array(
                'year' => array('type' => 1, 'value' => $yearId),
            ), $this->datagridValues);

        }
        return parent::getFilterParameters();
    }

    public function getNewInstance()
    {
        $em = $this->getManager();
        $request = $this->getRequest();
        $item = new Expenditure();
        $objectId = $request->get('objectId', null);
        if (!is_null($objectId)) {
            $code = $request->get('code', null);
            if ('core.admin.provider' == $code) {
                $provider = $em->getRepository('CoreBundle:Provider')->find($objectId);
                $item->setProvider($provider);
            }elseif ('core.admin.account' == $code) {
                $account = $em->getRepository('CoreBundle:Account')->find($objectId);
                $item->setAccount($account);
            }
        }

        $accountId = $request->get('account', null);
        if(null != $accountId){
            $account = $em->getRepository('CoreBundle:Account')->find($accountId);
            $item->setAccount($account);
        }

        $item->setQuantity(0);
        $item->setVat(0);
        $item->setTotal(0);


        $session = $this->getContainer()->get('session');
        $yearId = $session->get('selected_year.id', null);

        $entityYear = $em->getRepository('CoreBundle:Year')->find(
            $yearId
        );

        $item->setYear($entityYear);

        $accountResi =$em->getRepository('CoreBundle:Account')->findOneBy(['name'=>'CAJA RESIDENCIA']);
        if($accountResi){
            $item->setAccount($accountResi);
        }


        return $item;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('year')
            ->add('quantity')
            ->add('provider')
            ->add('status')
            ->add('dateBuy')
            ->add('account')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('concept')
            ->add('total', 'string', array(
                'template' => 'AdminBundle::Admin/Generic/List/itemMoney.html.twig',
            ))
            ->add('status','trans')
            ->add('wayToPay','trans')
            ->add('account')
            ->add('provider')
            ->add('dateBuy', 'string', array(
                'template' => 'AdminBundle::Admin/Expenditure/List/itemDate.html.twig',
            ))
            ->add('datePaid', 'string', array(
                'template' => 'AdminBundle::Admin/Expenditure/List/itemPay.html.twig',
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
        $entity = $this->getSubject();
        $translator = $this->getContainer()->get('translator');

        $statusOptions = array();
        $statusOptions[$translator->trans('pending')] = 'pending';
        $statusOptions[$translator->trans('paid')] = 'paid';

        $wayToPayOptions = array();
        $wayToPayOptions['(sin definir)'] = ' ';
        $wayToPayOptions[$translator->trans('card')] = 'card';
        $wayToPayOptions[$translator->trans('transfer')] = 'transfer';
        $wayToPayOptions[$translator->trans('cash')] = 'cash';
        $wayToPayOptions[$translator->trans('bank')] = 'bank';
        $wayToPayOptions[$translator->trans('gratification')] = 'gratification';

        $formMapper
            ->with(ucfirst($translator->trans('order information')), ['class' => 'col-md-6', 'box_class' => ''])
                ->add('concept', null, array('attr'=> ['placeholder' => ucfirst($translator->trans('placeholder.concept'))]))
                ->add('dateBuy',DateTimeType::class,
                [
                    'label' => 'dateBuy',
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                    'html5' => false,
                    'attr' => [
                        'class' => 'datepicker',
                    ],
                    'required' => true,
                ])
                ->add('quantity')
                ->add('vat')

//                ->with(ucfirst($translator->trans('irpf information')), ['class' => 'col-md-6', 'box_class' => ''])
                    ->add('irpf',null,array(
                        'attr'=> ['class'=>'col-md-6 lala' , 'box_class' => 'col-md-6'],
//                        'label_attr' => ['class' => 'col-md-6'],
                        'horizontal_input_wrapper_class' => ['class' => 'col-md-6'],

                    ))
                    ->add('irpf-calculation',
                        ActionsType::class,
                        [
                            'mapped' => false,
                            'label' => false,
//                            'label_attr' => ['class' => 'col-md-6'],
                            'horizontal_label_class' => ['class' => 'col-md-6'],
                            'attr' => [
                                'class'=>'col-md-6' , 'box_class' => 'col-md-6',
                                'template' => 'AdminBundle::Admin/Expenditure/Edit/irpf_calculation.html.twig',
                            ],
                        ]
                    )
//                ->end()
                ->add('total',null,array(
                    'attr'=> ['class'=>'col-md-1']
                ))
                ->add('wayToPay', 'choice', array(
                    'label' =>  'wayToPay',
                    'choices' => $wayToPayOptions
                ))



            ->end()

            ->with(ucfirst($translator->trans('payment information')), ['class' => 'col-md-6', 'box_class' => '']);

                if ('admin_core_provider_edit' == $this->getRequest()->get('_route')
                    || 'sonata_admin_append_form_element' == $this->getRequest()->get('_route')
                    || 'admin_core_account_edit' == $this->getRequest()->get('_route')
                ) {
                     $formMapper->add('status',
                         ActionsType::class,
                         [
                             'mapped' => false,
                             'label' => false,
                             'attr' => [
                                 'template' => 'AdminBundle::Admin/Expenditure/Edit/status.html.twig',
                             ],
                         ]
                     );
                 }else{
                     $formMapper->add('status', 'choice', array(
                        'choices' => $statusOptions
                        ));
                 }

//                 if ((!$this->isNew() || ('admin_core_expenditure_create' == $this->getRequest()->get('_route')))&& $entity->getStatus() == 'paid') {
                     $formMapper->add('datePaid',DateTimeType::class,
                         [
                             'label' => 'datePaid',
                             'widget' => 'single_text',
                             'format' => 'dd/MM/yyyy',
                             'html5' => false,
                             'attr' => [
                                 'class' => (((!$this->isNew() || ('admin_core_expenditure_create' == $this->getRequest()->get('_route')))&& $entity->getStatus() == 'paid')) ? 'datepicker': 'hidden',
                             ],
                             'required' => false,
                         ]);
//                 }


                if ('admin_core_provider_edit' == $this->getRequest()->get('_route')
                    || 'sonata_admin_append_form_element' == $this->getRequest()->get('_route')
                    || 'admin_core_account_edit' == $this->getRequest()->get('_route')
                ) {
                    $formMapper->add('btns',
                        ActionsType::class,
                        [
                            'mapped' => false,
                            'label' => false,
                            'attr' => [
                                'template' => 'AdminBundle::Admin/Provider/Edit/expenditures_btns.html.twig',
                            ],
                        ]
                    );
                }



//        $state = $this->getRequest()->get('_route');

            if ('admin_core_provider_edit' == $this->getRequest()->get('_route') || 'sonata_admin_append_form_element' == $this->getRequest()->get('_route')) {
                $formMapper->add('provider',null,
                    [
                        'label' => '',
                        'required' => false,
                        'attr' => ['hidden' => true, 'class' => 'sonata-autocomplete-hidden'],
                        'label_attr' => ['class' => 'sonata-autocomplete-hidden'],
                    ]
                );

                $formMapper->add('scripts',
                    ActionsType::class,
                    [
                        'mapped' => false,
                        'label' => false,
                        'attr' => [
                            'template' => 'AdminBundle::Admin/Expenditure/Edit/scripts.html.twig',
                        ],
                    ]
                );

            }else{
                $formMapper->add('provider');

                $formMapper->add('scripts',
                    ActionsType::class,
                    [
                        'mapped' => false,
                        'label' => false,
                        'attr' => [
                            'template' => 'AdminBundle::Admin/Expenditure/Edit/scripts.html.twig',
                        ],
                    ]
                );
            }

//            $formMapper->add('account');
        $session = $this->getContainer()->get('session');
        $yearId = $session->get('selected_year.id', null);

        $this->parameters = ['year'=> $yearId];
        $formMapper->add($formMapper->create(
            'account',
            null,
            array(
                'class' => 'CoreBundle\Entity\Account',
                'attr' => array('class' => ' form-control', 'id' => 'room'),
                'placeholder' => ucfirst($translator->trans('select one account')),
                'empty_data' => null,
                'label' => ucfirst($translator->trans('account')),
                'required' => true,
                'query_builder' => function ($repository) {
                    return $repository->findByParameters($this->parameters);
                },
                'multiple' => false,
            )
        ));


            $formMapper->end()
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('quantity')
            ->add('status')
            ->add('provider')
            ->add('date')
        ;
    }



    public function prePersist($object)
    {
        $this->preUpdate($object);
    }

    /**
     * @param Expenditure $object
     */
    public function preUpdate($object)
    {

        $em = $this->getManager();
        if($object->getVat() == null){
            $object->setVat(0);
            $object->setTotal($object->getQuantity());
            $em->persist($object);
        }else{

            $irpfValue = ($object->getIrpf()*$object->getQuantity())/100;
//            $object->setTotal((($object->getQuantity()*$object->getVat())/100)+$object->getQuantity());
            $object->setTotal($object->getQuantity()+$object->getVat()-$irpfValue);
            $em->persist($object);
        }


        $em->flush();

        if($object->getAccount() != null){
            $balance = $this->getContainer()->get('account.handler')->calculateBalance($object->getAccount());
            $object->getAccount()->setBalance($balance);
        }

    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('return_list_providers', $this->getRouterIdParameter() . '/return_list_providers');
        $collection->add('return_edit_provider', $this->getRouterIdParameter() . '/return_edit_provider');

    }
}

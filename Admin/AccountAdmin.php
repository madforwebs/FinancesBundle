<?php

namespace AdminBundle\Admin;

use CoreBundle\Entity\Account;
use CoreBundle\Entity\Income;
use CoreBundle\Form\Type\ActionsType;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class AccountAdmin extends AbstractAdmin
{

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


    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('name')
            ->add('balance')
            ->add('year');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
//            ->add('id')
            ->add('name')
            ->add('balance', 'string', array(
                'template' => 'AdminBundle::Admin/Account/List/balance.html.twig',
            ))
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper)
    {

        $em = $this->getManager();
        $accountResi =$em->getRepository('CoreBundle:Account')->findOneBy(['name'=>'CAJA RESIDENCIA']);
        $accountCertera =$em->getRepository('CoreBundle:Account')->findOneBy(['name'=>'CARTERA']);

        $translator = $this->getContainer()->get('translator');

        $formMapper
//            ->add('id')
            ->add('name')
            ->add('balance', null, array('attr' => array('fraction_digits' => 2)));

        if($this->getSubject()->getName() == 'CAJA'){
            $formMapper->add('total_accounts',
                ActionsType::class,
                [
                    'mapped' => false,
                    'label' => false,
                    'attr' => [
                        'template' => 'AdminBundle::Admin/Account/Edit/total_accounts.html.twig',
                        'accounts' => [$accountResi,$this->getSubject(),$accountCertera ]
                    ],
                ]
            );
        }


        $formMapper->add('movements',
                ActionsType::class,
                [
                    'mapped' => false,
                    'label' => false,
                    'attr' => [
                        'template' => 'AdminBundle::Admin/Account/Edit/movements.html.twig',
                    ],
                ]
            );
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('name')
            ->add('balance');
    }


    public function prePersist($object)
    {
        $this->preUpdate($object);
    }

    /**
     * @param Account $object
     */
    public function preUpdate($object)
    {
        /* Movimientos entre cuentas */
        $em = $this->getManager();
        $movements = $object->getEarnings();

        if(count($movements)>0){
            /** @var Income $movement */
            foreach ($movements as $movement) if($movement->getAccountDestiny() != null ){
                if (null == $movement->getId()) {
                    // Create movement in destiny account
                    $response = $this->getContainer()->get('account.handler')->createMovementAccountDestiny($movement);
                }
            }
        }

        $account = $object;
        $balance = $this->getContainer()->get('account.handler')->calculateBalance($account);
        $account->setBalance($balance);
        $em->persist($account);
        $em->flush();
    }
}
